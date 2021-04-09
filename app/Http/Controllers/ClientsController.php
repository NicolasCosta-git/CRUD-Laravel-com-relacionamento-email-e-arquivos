<?php

namespace App\Http\Controllers;

use App\Clients;
use App\mail\SendMail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Mail;
use PDOException;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::all();
        return view('pizzeria.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pizzeria.clients.create');
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
                'name' => 'required',
                'cpf' => 'required',
                'photo' => 'required'
            ]);
            $inputs = $request->except('photo');
            if ($request->hasFile('photo')) {
                $upload = $request->photo->store('clients', 'public');
                $inputs['photo'] = $upload;
            }
            DB::transaction(function() use ($inputs) {
                $client = Clients::create($inputs);
                Mail::to('teste@teste.com.br')->send(new SendMail($client->name));
            });
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withError('Já existe um cliente com este cpf cadastrado!!');
            }
        }

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Clients::findOrFail($id);
        return view('pizzeria.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Clients::findOrFail($id);
        return view('pizzeria.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'cpf' => 'required',
            ]);
            $client = Clients::findOrFail($id);
            $inputs = $request->except('photo');
            if ($request->hasFile('photo')) {
                if ($client->photo != null) {
                    Storage::disk('public')->delete($client->id);
                }
                $upload = $request->photo->store('clients', 'public');
                $inputs['photo'] = $upload;
            }
            $client->fill($inputs)->save();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withError('Já existe um cliente com este cpf cadastrado!!');
            }
        }

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Clients::findOrFail($id);
        Storage::disk('public')->delete($client->photo);
        Clients::destroy($client->id);
        return redirect()->route('clients.index');
    }
}
