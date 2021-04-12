<?php

namespace App\Http\Controllers;

use App\Pizzas;
use Illuminate\Http\Request;
use PDOException;
use Validator;
use Illuminate\Support\Facades\DB;

class PizzasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizzas::orderBy('flavour')->get();
        return view('pizzeria.pizzas.index', compact('pizzas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pizzeria.pizzas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'flavour' => 'required',
                'price' => 'required',
                'ingredients' => 'required'
            ]);
            DB::transaction(function () use ($request) {
                Pizzas::create($request->all());
            });
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withError('Já existe uma pizza com este sabor!!');
            }
        }
        return redirect()->route('pizzas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizzas::findOrFail($id);
        return view('pizzeria.pizzas.show', compact('pizza'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizza = Pizzas::findOrFail($id);
        return view('pizzeria.pizzas.edit', compact('pizza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'flavour' => 'required',
                'price' => 'required',
                'ingredients' => 'required'
            ]);
            $pizza = Pizzas::findOrFail($id);
            $pizza->fill($request->all())->save();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withError('Já existe uma pizza com este sabor!!');
            }
        }

        return redirect()->route('pizzas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizzas = Pizzas::findOrFail($id);
        Pizzas::destroy($pizzas->id);
        return redirect()->route('pizzas.index');
    }
}
