<?php

namespace App\Http\Controllers;

use App\Models\Retraite;
use Illuminate\Http\Request;

class RetraiteController extends Controller
{
    public static function getinfo($id)
    {
        return Retraite::leftJoin('users', 'users.id', 'retraites.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'retraites.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('retraites.id_user', $id)
            ->orderBy('retraites.id')
            ->first();
    }
}
