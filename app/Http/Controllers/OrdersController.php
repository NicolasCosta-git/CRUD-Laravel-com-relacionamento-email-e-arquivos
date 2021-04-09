<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use App\Clients;
use App\Pizzas;
use Validator;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::with('pizzas', 'clients')->orderBy('client_id')->get();
        return view('pizzeria.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Clients::orderBy('name')->get();
        $pizzas = Pizzas::orderBy('flavour')->get();
        return view('pizzeria.orders.create', compact('clients', 'pizzas'));
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
        $order = Orders::select('orders.id', 'clients.name', 'clients.cpf', 'pizzas.flavour', 'pizzas.price')->join('pizzas', 'pizzas.id', '=', 'orders.pizza_id')->join('clients', 'clients.id', '=', 'orders.client_id')->where('orders.id', '=', $id)->orderBy('clients.name')->get();
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
        $clients = Clients::orderBy('name')->get();
        $pizzas = Pizzas::orderBy('flavour')->get();
        $order = Orders::findOrFail($id);
        return view('pizzeria.orders.edit', compact('clients', 'pizzas', 'order'));
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
        $order = Orders::findOrFail($id);
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
