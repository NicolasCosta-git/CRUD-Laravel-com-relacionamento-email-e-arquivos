<?php

namespace App\Http\Controllers\API;

use App\Clients;
use App\mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use PDOException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class APIClientsController extends BaseController
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(Clients::all());
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
                return $this->sendError('Este cpf já está cadastrado');
            }
        }

        return $this->sendResponse('Cliente cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Clients::find($id);
        return $this->sendResponse($client);
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
            $client = Clients::find($id);
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
                return $this->sendError('Este cpf já está cadastrado');
            }
        }

        return $this->sendResponse(Clients::find($id),'Dados atualizados com successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Clients::find($id);
        Storage::disk('public')->delete($client->photo);
        Clients::destroy($client->id);
        return $this->sendResponse("Cliente deletado com sucesso!");
    }
}
