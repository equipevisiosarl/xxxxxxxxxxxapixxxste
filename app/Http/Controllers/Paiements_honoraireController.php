<?php

namespace App\Http\Controllers;

use App\Models\Contrats_package;
use App\Models\Contrats_service;
use App\Models\Groupes_service;
use App\Models\Paiements_honoraire;
use Illuminate\Http\Request;

class Paiements_honoraireController extends Controller
{
    public function allpaiements($id_user)
    {

        $paiements = Paiements_honoraire::select('date_paiement', 'montant_payer', 'mode_paiement', 'capture', 'type_contrat', 'id_contrat')
            ->where('id_user', $id_user)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($paiements as $key => $paiement) {

            if ($paiement->type_contrat == 'package') {
                $motif = Contrats_package::select('groupe_service')
                    ->join('souscrire_packages', 'souscrire_packages.id', 'contrats_packages.id_demande_package')
                    ->join('groupes_services', 'groupes_services.id', 'souscrire_packages.id_groupe_service')
                    ->where('contrats_packages.id', $paiement->id_contrat)
                    ->first()
                    ->groupe_service;
            } else {
                $motif = Contrats_service::select('titre')
                    ->join('demandes', 'demandes.id', 'contrats_services.id_demande')
                    ->join('services', 'services.id', 'demandes.id_service')
                    ->where('contrats_services.id', $paiement->id_contrat)
                    ->first()
                    ->titre;
            }

            $paiements[$key]['motif_paiement'] = $motif;
        }

        return $paiements;
    }
}
