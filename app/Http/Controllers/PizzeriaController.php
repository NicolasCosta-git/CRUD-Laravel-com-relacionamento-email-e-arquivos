<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzeriaController extends Controller
{
    public function index()
    {
        return view('pizzeria.index');
    }
}
