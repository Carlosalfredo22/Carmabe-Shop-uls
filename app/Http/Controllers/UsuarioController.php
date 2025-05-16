<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        return User::select('id', 'name', 'email')->get();
    }
}
