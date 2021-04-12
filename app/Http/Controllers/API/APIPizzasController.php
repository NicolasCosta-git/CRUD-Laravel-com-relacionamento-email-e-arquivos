<?php

namespace App\Http\Controllers\API;

use App\Pizzas;
use Illuminate\Http\Request;
use PDOException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class APIPizzasController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizzas::orderBy('flavour')->get();
        return $this->sendResponse($pizzas);
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
                return $this->sendError("Já existe uma pizza com este sabor!");
            }
        }
        return $this->sendResponse("Pizza cadastrada com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizzas::find($id);
        if ($pizza != null) {
            return $this->sendResponse($pizza);
        } else {
            return $this->sendError("id inexistente");
        }
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
            $pizza = Pizzas::find($id);
            if ($pizza != null) {
                $pizza->fill($request->all())->save();
            } else {
                return $this->sendError("id inexistente");
            }
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return $this->sendError("Já existe uma pizza com este sabor!");
            }
        }

        return $this->sendResponse(Pizzas::find($id), "Pizza alterada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pizzas  $pizzas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizzas::find($id);
        if ($pizza != null) {
            Pizzas::destroy($pizza->id);
        } else {
            return $this->sendError("id inexistente");
        }

        return $this->sendResponse("Pizza deletada com sucesso!");
    }
}
