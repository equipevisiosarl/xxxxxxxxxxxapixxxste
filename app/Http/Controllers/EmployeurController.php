<?php

namespace App\Http\Controllers;

use App\Models\Employeur;
use Illuminate\Http\Request;

class EmployeurController extends Controller
{
    public static function getinfo($id)
    {
        return Employeur::leftJoin('users', 'users.id', 'employeurs.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'employeurs.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('employeurs.id_user', $id)
            ->orderBy('employeurs.id')
            ->first();
    }
}
