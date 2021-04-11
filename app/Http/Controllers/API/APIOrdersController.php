<?php

namespace App\Http\Controllers\API;

use App\Orders;
use Illuminate\Http\Request;
use App\Clients;
use App\Pizzas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class APIOrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::with('pizzas', 'clients')->orderBy('client_id')->get();
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
            'client_id' => 'required',
            'pizza_id' => 'required'
        ]);
        DB::transaction(function() use ($request) {
            Orders::create($request->all());
        });
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
        $order = Orders::select('orders.id', 'clients.name', 'clients.cpf', 'pizzas.flavour', 'pizzas.price')
        ->join('pizzas', 'pizzas.id', '=', 'orders.pizza_id')
        ->join('clients', 'clients.id', '=', 'orders.client_id')
        ->where('orders.id', '=', $id)
        ->orderBy('clients.name')->get();
        $order = $order[0]->getAttributes();
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
            'client_id' => 'required',
            'pizza_id' => 'required'
        ]);
        $order = Orders::find($id);
        $order->fill($request->all())->save();
        return $this->sendResponse(Orders::find($id),"Pedido atualizado com sucesso");
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
        Orders::destroy($order->id);
        return $this->sendResponse("Pedido deletado com sucesso!");
    }
}
