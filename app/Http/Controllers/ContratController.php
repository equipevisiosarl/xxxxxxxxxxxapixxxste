<?php

namespace App\Http\Controllers;

use App\Models\Contrats_package;
use App\Models\Contrats_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function honoraires($id_user){

        $honoraire_services = Contrats_service::select(
            'services.titre as motif_contrat',
            'contrats_services.contrat',
            'contrats_services.a_payer as montant',
            DB::raw('(contrats_services.a_payer - COALESCE((SELECT SUM(montant_payer) 
                FROM paiements_honoraires 
                WHERE paiements_honoraires.id_contrat = contrats_services.id AND type_contrat = "demande"), 0)) as reste_a_payer')
        )
        ->join('demandes', 'demandes.id', '=', 'contrats_services.id_demande')
        ->join('services', 'services.id', '=', 'demandes.id_service')
        ->where('demandes.id_user', $id_user)
        ->orderBy('contrats_services.id', 'DESC');
        


        $honoraire_packages = Contrats_package::select(
            'groupe_service as motif_contrat',
            'contrat',
            'a_payer as montant',
            DB::raw('(a_payer - COALESCE((SELECT SUM(montant_payer) 
                FROM paiements_honoraires 
                WHERE paiements_honoraires.id_contrat = contrats_packages.id AND type_contrat = "package"), 0)) as reste_a_payer')
        )
         ->join('souscrire_packages', 'souscrire_packages.id', 'contrats_packages.id_demande_package')
        ->join('groupes_services', 'groupes_services.id', 'souscrire_packages.id_groupe_service')
        ->where('souscrire_packages.id_user', $id_user)
        ->orderBy('contrats_packages.id', 'DESC');
       
        return $honoraire_services->union($honoraire_packages)->get();
    }
}
