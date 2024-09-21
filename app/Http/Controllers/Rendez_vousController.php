<?php

namespace App\Http\Controllers;

use App\Models\Rendez_vous;
use Illuminate\Http\Request;

class Rendez_vousController extends Controller
{
    public function get_rdv($id_user)
    {
        return Rendez_vous::select('date_rdv', 'lieu', 'commune', 'rendez_vous.id as id_rdv')
        ->leftJoin('communes', 'communes.id', 'rendez_vous.id_commune')
        ->where('id_user', $id_user)
        ->orderBy('date_rdv', 'desc')
        ->get();
    }
}
