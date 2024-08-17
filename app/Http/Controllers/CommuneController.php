<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function allCommunes()
    {
        return Commune::all();
    }

    public function commune($id)
    {
        return Commune::find($id);
    }
}
