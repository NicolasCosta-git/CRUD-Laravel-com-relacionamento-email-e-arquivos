<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use App\Pizzas;
use App\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\mail\SendMail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->id == 1) {
            $orders = Orders::with('pizzas', 'users')->orderBy('user_id')->get();
        } else {
            $orders = Orders::with('pizzas', 'users')->where('user_id', auth()->user()->id)->orderBy('user_id')->get();
        }

        return view('pizzeria.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pizzas = Pizzas::orderBy('flavour')->get();
        return view('pizzeria.orders.create', compact('pizzas'));
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
            'pizza_id' => 'required'
        ]);
        $request['user_id'] = auth()->user()->id;
        $request['status'] = 'Em andamento';
        DB::transaction(function () use ($request) {
            Orders::create($request->all());
        });
        Mail::to('teste@teste.com.br')->send(new SendMail('Pedido cadastrado com sucesso!'));
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Orders::select('orders.id', 'orders.status', 'users.address', 'users.photo', 'users.name', 'users.cpf', 'pizzas.flavour', 'pizzas.price')
            ->join('pizzas', 'pizzas.id', '=', 'orders.pizza_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.id', '=', $id)
            ->orderBy('users.name')
            ->get();
        $order = $order[0]->getAttributes();
        return view('pizzeria.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizzas = Pizzas::orderBy('flavour')->get();
        $order = Orders::find($id);
        return view('pizzeria.orders.edit', compact('pizzas', 'order'));
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
        $order = Orders::find($id);
        $request['user_id'] = $order->user_id;
        $this->validate($request, [
            'user_id' => 'required',
            'pizza_id' => 'required'
        ]);
        $order->fill($request->all())->save();
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        Orders::destroy($order->id);
        return redirect()->route('orders.index');
    }
}
