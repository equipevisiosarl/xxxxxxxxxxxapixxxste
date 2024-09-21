<?php

namespace App\Http\Controllers;

use App\Models\Contrats_service;
use App\Models\Dossiers_cnps;
use Illuminate\Http\Request;

class Dossier_cnpsController extends Controller
{
    public function getDossier($id_user)
    {
      $dossiers =  Dossiers_cnps::select('services.titre as service', 'dossiers_cnps.etat',
       'dossiers_cnps.motif', 'contrat', 'demandes.id as id_demande', 'dossiers_cnps.id as id_dossier_cnps' )
        ->join('demandes', 'demandes.id', 'dossiers_cnps.id_demande')
        ->join('services', 'services.id', 'demandes.id_service')
        ->join('contrats_services', 'contrats_services.id_demande', 'demandes.id')
        ->where('demandes.id_user', $id_user)
        ->orderBy('dossiers_cnps.id', 'DESC')
        ->get();

        foreach ($dossiers as $key => $value) {
            $dossiers[$key]['documents'] = Documents_demandeController::getDocumentDemande($value->id_demande);
         }
 
         return $dossiers;

    }
}
