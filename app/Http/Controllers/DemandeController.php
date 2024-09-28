<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Documents_demande;
use App\Models\Documents_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{

    public function create(Request $request, $id_user)
    {
        try {
            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'id_service' => ['required', 'integer', 'exists:services,id'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $id_service = $apiData['id_service'];

            // Créer ou mettre à jour la demande en tant que brouillon
            $demande = Demande::updateOrCreate(
                [
                    'id_user' => $id_user,
                    'id_service' => $id_service,
                    'status' => 'draft', //pour brouillon
                ],
                [
                    'date_demande' => now(), // Tu peux mettre à jour la date ici
                ]
            );

            if ($demande) {
                $ifdoc = Documents_service::where('id_service', $id_service)->get();
                $demande->id_demande = $demande->id;
                if (!count($ifdoc) > 0) {
                    return response()->json(['success' => true, 'message' => 'demande sauvegardé avec succès, cet service n\'exige aucun document vous pouvez finaliser votre demande en appuyant sur le bouton Finaliser la demande', 'demande' => $demande], 200);
                }

                return response()->json(['success' => true, 'message' => 'demande sauvegardé avec succès, cet service exige des documents pour finaliser votre demande uploder les différent document démandé', 'demande' => $demande], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la création de la demande: " . $th->getMessage()], 500);
        }
    }

    public function getDemandeUser($id_user, $status = 'all')
    {
        $demandes = Demande::select(
            'demandes.id as id_demande',
            'id_user',
            'id_service',
            'date_demande',
            'demandes.status',
            'services.titre as service',
            'services.description',
            'services.id_regime'
        )
            ->leftJoin('services', 'services.id', 'demandes.id_service')
            ->orderBy('demandes.id')
            ->where('id_user', $id_user);
        if ($status != 'all') {
            if (!in_array($status, ['submitted', 'draft', 'approuver'])) {
                return response()->json(['success' => false, 'message' => "erreur status non pris en charge a utiliser ['submitted', 'draft', 'valider']"], 422);
            }
            $demandes->where('status', $status);
        }
        return $demandes->get();
    }


    public function getDemande($id_demande)
    {
        $demande = Demande::select(
            'demandes.id as id_demande',
            'id_user',
            'id_service',
            'date_demande',
            'demandes.status',
            'services.titre as service',
            'services.description',
            'services.id_regime'
        )
            ->leftJoin('services', 'services.id', 'demandes.id_service')
            ->orderBy('demandes.id')
            ->where('demandes.id', $id_demande)
            ->first();

        if (!$demande) {
            return response()->json(['success' => false, 'message' => "demande inconnue"], 422);
        }

        $demande->documents = Documents_demande::where('id_demande', $id_demande)->get();
        return $demande;
    }

    public function delete($id_demande)
    {
        try {
            $demande = $this->getDemande($id_demande);

            if (!$demande) {
                return response()->json(['success' => false, 'message' => "demande inconnue"], 422);
            }

            if ($demande->status == 'approuver') {
                return response()->json(['success' => false, 'message' => "une demande approuvée ne peut être supprimé"], 422);
            }

            if (count($demande->documents) > 0) {
                Documents_demande::where("id_demande", $id_demande)->delete();
            }

            if (Demande::where("id", $id_demande)->delete()) {
                return response()->json(['success' => true, 'message' => 'Demande et les documents liés supprimés']);
            }

            return response()->json(['success' => false, 'message' => "erreur demande non supprimé"], 422);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la suppression de la demande: " . $th->getMessage()], 500);
        }
    }



    public function submitDemande($id_demande)
    {
        $demande = Demande::where('id', $id_demande)->where('status', 'draft')->firstOrFail();

        try {
            $countDocService = Documents_service::where('id_service', $demande->id_service)->count();
            $countDocDemande = Documents_demande::where('id_demande', $id_demande)->count();

            if ($countDocService == $countDocDemande) {

                // Mettre à jour le statut de la demande
                $demande->update([
                    'status' => 'submitted',
                    'date_demande' => now(),
                ]);

                NotificationController::ajout($demande->id_user, 'Super vous avez finalisé votre demande, rester à l\'écoute');

                return response()->json(['success' => true, 'message' => 'Demande finalisée avec succès', 'demande' => $demande], 200);
            }

            return response()->json(['success' => false, 'message' => "erreur tout les documents exigés par ce service ne sont uploadées il reste {$countDocDemande} documents sur  $countDocService exigés"], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => true, 'message' => 'echec lors de la finalisation de la demande, aucune demande en suspend trouvée'], 404);
        }
    }
}
