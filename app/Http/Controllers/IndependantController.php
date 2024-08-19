<?php

namespace App\Http\Controllers;

use App\Models\Independant;
use Illuminate\Http\Request;

class IndependantController extends Controller
{
    public static function getinfo($id)
    {
        return Independant::leftJoin('users', 'users.id', 'independants.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'independants.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('independants.id_user', $id)
            ->orderBy('independants.id')
            ->first();
    }
}
