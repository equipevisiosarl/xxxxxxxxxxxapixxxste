<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Situation_matrimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnfantController extends Controller
{
    public function create_enfant($id_user, Request $request)
    {
        try {
            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'fullname' => ['required'],
                'date_naissance' => ['required'],
                'niveau_etude' => ['required'],
                'second_parent' => ['required'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }
            $user = User::where('id', $id_user)->first();
            if ($user->id_regime == 1) {
                return response()->json(['success' => false, 'message' => 'operation impossible vous etes une entreprise'], 422);
            }

            $nombre_enfant_inscrit = Enfant::where('id_user', $id_user)->count() ?? 0;
            $nombre_enfant = Situation_matrimonial::where('id_user', $id_user)->first()->nombre_enfant ?? 0;
            if ($nombre_enfant_inscrit >= $nombre_enfant) {
                return response()->json(['success' => false, 'message' => "operation impossible nombre d'enfant déclaré $nombre_enfant, nombre d'enfant inscrit $nombre_enfant_inscrit "], 422);
            }

            $apiData = insert_table($apiData, ['id_user' => $id_user]);
            $enfant = Enfant::create(map_data($apiData, [
                'fullname',
                'date_naissance',
                'niveau_etude',
                'second_parent',
                'id_user'
            ]));

            return response()->json(['success' => true, 'message' => 'Enfant enregistré', 'enfant' => $enfant]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de l'enregitrement de votre enfant: " . $th->getMessage()], 500);
        }
    }

    public function get_enfants($id_user)
    {
        $enfants = Enfant::where('id_user', $id_user)->get();
        if ($enfants) {
            return $enfants;
        }
        return [];
    }

    public function enfant($id_enfant)
    {
        $enfant = Enfant::where('id', $id_enfant)->first();
        if ($enfant) {
            return $enfant;
        }
        return [];
    }


    public function update_enfant($id_enfant, Request $request)
    {
        try {
            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'fullname' => ['required'],
                'date_naissance' => ['required'],
                'niveau_etude' => ['required'],
                'second_parent' => ['required'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $enfant = Enfant::where('id', $id_enfant)->first();
            if (!$enfant) {
                return response()->json(['success' => false, 'message' => 'enfant inconnu'], 422);
            }
            $enfant = Enfant::where('id', $id_enfant)->update(map_data($apiData, [
                'fullname',
                'date_naissance',
                'niveau_etude',
                'second_parent'
            ]));
            return response()->json(['success' => true, 'message' => "niveau d'etude modifié avec success"],);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la modification du niveau d'etude: " . $th->getMessage()], 500);
        }
    }
}
