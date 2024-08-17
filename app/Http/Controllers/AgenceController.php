<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function allAgences()
    {
        return Agence::all();
    }

    public function agence($id)
    {
        return Agence::find($id);
    }
}
