<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Documents_demande;
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
                'id_service' => ['required', 'integer'],
                //'date_demande' => ['required'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $apiDatas = insert_table($apiData, [
                'id_user' => $id_user,
                'date_demande' => date('Y-m-d H:i:s'),
                'status' => "non approuvé"
            ]);


            if ($demande = Demande::create($apiDatas)) {
                if (isset($apiDatas['documents'])) {
                    foreach ($apiDatas['documents'] as $document) {
                        $dataDoc = [];
                        $dataDoc = insert_table($dataDoc, [
                            'id_demande' => $demande->id,
                            'id_user' => $demande->id_user,
                            'document' => $document
                        ]);
                        Documents_demande::create($dataDoc);
                    }
                }
                return response()->json(['success' => true, 'message' => 'Demandes enrégistré', 'id_demande' => $demande->id]);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de l'enrégistrement de la demande: " . $th->getMessage()], 500);
        }
    }

    public function getDemandeUser($id_user)
    {
        return Demande::leftJoin('services', 'services.id', 'demandes.id_service')
            ->orderBy('demandes.id')
            ->where('id_user', $id_user)->get();
    }


    public function getDemande($id_demande)
    {
        $demande = Demande::leftJoin('services', 'services.id', 'demandes.id_service')
            ->orderBy('demandes.id')
            ->where('demandes.id', $id_demande)
            ->first();

        if (!$demande) {
            return response()->json(['success' => false, 'message' =>"demande inconnue"], 422);
        }

        $demande->documents = Documents_demande::where('id_demande', $id_demande)->get();
        return $demande;
    }

    public function delete($id_demande)
    {
        try {
           $demande = $this->getDemande($id_demande);

           if ($demande->status == 'approuvé') {
            return response()->json(['success' => false, 'message' =>"une demande approuvée ne peut être supprimé"], 422);
           }

           if (count($demande->documents) > 0) { 
            Documents_demande::where("id_demande", $id_demande)->delete();
           }

          if ( Demande::where("id", $id_demande)->delete()) {
            return response()->json(['success' => true, 'message' => 'Demande et les documents liés supprimés']);
          }

          return response()->json(['success' => false, 'message' =>"erreur demande non supprimé"], 422);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la suppression de la demande: " . $th->getMessage()], 500);
        }
    }
}
