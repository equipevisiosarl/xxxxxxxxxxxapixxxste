<?php

namespace App\Http\Controllers;

use App\Models\Carriere;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarriereController extends Controller
{
    public function create($id_user, Request $request)
    {

        try {
            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'employeur' => ['required'],
                'date_embauche' => ['required', 'date'],
                'date_depart' => ['nullable', 'date'],
                'rang' => ['nullable', 'string'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $user = User::where('id', $id_user)->first();
            if ($user->id_regime == 1 || $user->id_regime == 3) {
                return response()->json(['success' => false, 'message' => 'operation impossible vous etes un employeur ou un independant'], 422);
            }

            if (isset($apiData['rang']) && $apiData['rang'] == 'dernier') {

                $ifdernierEmployeur = Carriere::where('id_user', $id_user)
                    ->where('rang', 'dernier')
                    ->first();
                if ($ifdernierEmployeur) {
                    return response()->json(['success' => false, 'message' => 'operation impossible dernier employeur existant '], 422);
                }
            }


            if (isset($apiData['date_depart']) && $apiData['date_depart'] != null) {
                $date_depart = strtotime($apiData['date_depart']);
                $date_embauche = strtotime($apiData['date_embauche']);

                if ($date_embauche >= $date_depart) {
                    return response()->json(['success' => false, 'message' => 'operation impossible la date d\'embauche est superieure ou égale a la date de depart '], 422);
                }
            }

            $data = map_data($apiData, ['employeur', 'date_embauche', 'date_depart', 'rang']);
            $data = insert_table($data, ['id_user' => $id_user]);
            Carriere::create($data);

            return response()->json(['success' => true, 'message' => "Carriere enregistrée avec success"]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de l'enregistrement de la carriere " . $th->getMessage()], 500);
        }
    }


    public function update($id_carriere, Request $request)
    {

        try {
            $carriere = Carriere::where('id', $id_carriere)->first();
            if (!$carriere) {
                return response()->json(['success' => false, 'message' => "carriere introuvable"], 422);
            }

            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'employeur' => ['required'],
                'date_embauche' => ['required', 'date'],
                'date_depart' => ['nullable', 'date'],
                'rang' => ['nullable', 'string'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }


            if (isset($apiData['rang']) && $apiData['rang'] == 'dernier') {

                $ifdernierEmployeur = Carriere::where('id_user', $carriere->id_user)
                    ->where('rang', 'dernier')
                    ->first();
                if ($ifdernierEmployeur) {
                    return response()->json(['success' => false, 'message' => 'operation impossible dernier employeur existant '], 422);
                }
            }


            if (isset($apiData['date_depart']) && $apiData['date_depart'] != null) {
                $date_depart = strtotime($apiData['date_depart']);
                $date_embauche = strtotime($apiData['date_embauche']);

                if ($date_embauche >= $date_depart) {
                    return response()->json(['success' => false, 'message' => 'operation impossible la date d\'embauche est superieure ou égale a la date de depart '], 422);
                }
            }

            $data = map_data($apiData, ['employeur', 'date_embauche', 'date_depart', 'rang']);

            Carriere::where('id', $id_carriere)->update($data);

            return response()->json(['success' => true, 'message' => "Carriere modifiée avec success"]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de l'enregistrement de la carriere " . $th->getMessage()], 500);
        }
    }


    public function getCarriere($id_user)
    {
        return Carriere::where('id_user', $id_user)->get();
    }


    public function delete($id_carriere)
    {
        $carriere = Carriere::where('id', $id_carriere)->first();
        if (!$carriere) {
            return response()->json(['success' => false, 'message' => "carriere introuvable"], 422);
        }

        Carriere::where('id', $id_carriere)->delete();

        return response()->json(['success' => true, 'message' => "carriere supprimée"]);
    }
}
