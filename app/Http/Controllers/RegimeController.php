<?php

namespace App\Http\Controllers;

use App\Models\Regime;
use Illuminate\Http\Request;

class RegimeController extends Controller
{
    public function allRegimes()
    {
        return Regime::all();
    }

    public function regime($id)
    {
        return Regime::find($id);
    }

}
