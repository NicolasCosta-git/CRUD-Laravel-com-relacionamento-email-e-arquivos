<?php

namespace App\Http\Controllers\API;

use App\User;
use App\mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use PDOException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class APIUsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(User::where('id', '!=', '1')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != 1) {
            $client = User::find($id);
            if ($client != null) {
                return $this->sendResponse($client);
            } else {
                return $this->sendError("id inexistente");
            }
        }
        return $this->sendResponse([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id != 1) {
            try {
                $this->validate($request, [
                    'name' => 'required',
                    'cpf' => 'required',
                    'address' => 'required',
                ]);
                $client = User::find($id);
                if ($client != null) {
                    $inputs = $request->except('photo');
                    if ($request->hasFile('photo')) {
                        if ($client->photo != null) {
                            Storage::disk('public')->delete($client->id);
                        }
                        $upload = $request->photo->store('clients', 'public');
                        $inputs['photo'] = $upload;
                    }
                    $client->fill($inputs)->save();
                } else {
                    return $this->sendError("id inexistente");
                }
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return $this->sendError('Este cpf já está cadastrado');
                }
            }

            return $this->sendResponse(User::find($id), 'Dados atualizados com successo');
        }
        return $this->sendResponse([]);
    }
}
