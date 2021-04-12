<?php

namespace App\Http\Controllers;

use App\User;
use App\mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Mail;
use PDOException;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', '1')->get();
        return view('pizzeria.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pizzeria.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->id == 1) {
            return redirect()->route('pizzeria');
        }
        $user = User::findOrFail(auth()->user()->id);
        return view('pizzeria.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
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
                $User = User::findOrFail($id);
                $inputs = $request->except('photo');
                if ($request->hasFile('photo')) {
                    if ($User->photo != null) {
                        Storage::disk('public')->delete($User->id);
                    }
                    $upload = $request->photo->store('user', 'public');
                    $inputs['photo'] = $upload;
                }
                $User->fill($inputs)->save();
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return redirect()->back()->withError('Já existe um usuário com este cpf cadastrado!!');
                }
            }

            return redirect()->back();
        }
        return redirect()->back();
    }
}
