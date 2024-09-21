<?php

namespace App\Http\Controllers;

use App\Models\Contrats_package;
use App\Models\Contrats_service;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function getContratService($id_user)
    {
        return Contrats_service::select('services.titre as service', 'contrat', 'a_payer')
        ->join('demandes', 'demandes.id', 'contrats_services.id_demande')
        ->join('services', 'services.id', 'demandes.id_service')
        ->where('demandes.id_user', $id_user)
        ->orderBy('contrats_services.id', 'DESC')
        ->get();
    }

    public function getContratPackage($id_user)
    {
        return Contrats_package::select('groupe_service as package', 'contrat', 'a_payer', 'date_debut', 'date_fin', 'contrats_packages.etat')
        ->join('souscrire_packages', 'souscrire_packages.id', 'contrats_packages.id_demande_package')
        ->join('groupes_services', 'groupes_services.id', 'souscrire_packages.id_groupe_service')
        ->where('souscrire_packages.id_user', $id_user)
        ->orderBy('contrats_packages.id', 'DESC')
        ->get();
    }
}
