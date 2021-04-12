<?php

namespace App\Http\Controllers\API;

use App\Orders;
use App\mail\SendMail;
use Illuminate\Http\Request;
use App\Pizzas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Mail;

class APIOrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::with('pizzas', 'users')->orderBy('user_id')->get();
        return $this->sendResponse($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'pizza_id' => 'required'
        ]);
        DB::transaction(function () use ($request) {
            Orders::create($request->all());
        });
        Mail::to('teste@teste.com.br')->send(new SendMail('Pedido efetuado com sucesso!'));
        return $this->sendResponse('Pedido cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $check = Orders::find($id);
        if ($check != null) {
            $order = Orders::select('orders.id', 'orders.status', 'users.address', 'users.photo', 'users.name', 'users.cpf', 'pizzas.flavour', 'pizzas.price')
                ->join('pizzas', 'pizzas.id', '=', 'orders.pizza_id')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->where('orders.id', '=', $id)
                ->orderBy('users.name')
                ->get();
            $order = $order[0]->getAttributes();
        } else {
            return $this->sendError("id inexistente");
        }

        return $this->sendResponse($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'pizza_id' => 'required'
        ]);
        $order = Orders::find($id);
        if ($order != null) {
            $order->fill($request->all())->save();
        } else {
            return $this->sendError("id inexistente");
        }

        return $this->sendResponse(Orders::find($id), "Pedido atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::find($id);
        if ($order != null) {
            Orders::destroy($order->id);
        } else {
            return $this->sendError("id inexistente");
        }

        return $this->sendResponse("Pedido deletado com sucesso!");
    }
}
