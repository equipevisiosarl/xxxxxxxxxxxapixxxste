<?php

namespace App\Http\Controllers;

use App\Models\Groupes_service;
use App\Models\Package;
use App\Models\Service;
use App\Models\Souscrire_package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function packages($id_regime)
    {
        // Récupérer les groupes de services avec une pagination
        $packages = Package::select('packages.id as id_package', 'id_groupe_service', 'groupe_service')
        ->leftJoin('groupes_services', 'groupes_services.id', 'packages.id_groupe_service')
        ->where('packages.id_regime', $id_regime)
        ->get();

        // Parcourir chaque groupe de services pour récupérer ses tranches de paiement
        foreach ($packages as $package) {
            // Assigner les tranches de paiement pour chaque groupe de services
            $package->services = Service::orderBy('id', 'asc')->where('id_regime', $id_regime)->get();
        }

        // Retourner la vue avec les groupes de services et leurs tranches de paiement
        return $packages;
    }

    public function demande($id_groupe_service, $id_user)
    {
        try {

            // Créer ou mettre à jour la demande en tant que brouillon
            Souscrire_package::updateOrCreate(
                [
                    'id_user' => $id_user,
                    'id_groupe_service' => $id_groupe_service,
                    'status' => 'demande', //pour demande
                ],
            );

            return response()->json(['success' => true, 'message' => "Votre demande de souscription à un package a été prise en compte. Nous vous contacterons plus tard pour vous fournir plus d'informations."], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la création de la demande: " . $th->getMessage()], 500);
        }
    
    }

   
}
