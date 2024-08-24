<?php

namespace App\Http\Controllers;

use App\Models\Employeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeurController extends Controller
{

    public static function validationRules($id)
    {
        return [
            'raison_social' => ['required'],
            'num_registre_commerce' => ['required', Rule::unique('employeurs')->ignore($id)],
            'nom_responsable' => ['required'],
            'matricule_cnps' => ['required', Rule::unique('employeurs')->ignore($id)],
            'domaine_activite' => ['required'],
            'effectifs' => ['required', 'numeric'],
            'pays' => ['required'],
            'id_commune' => ['required'],
            'situation_geographique' => ['required'],
            'photo' => ['required']
        ];
    }
    
    public static function getinfo($id)
    {
            return Employeur::leftJoin('users', 'users.id', 'employeurs.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'employeurs.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('employeurs.id_user', $id)
            ->orderBy('employeurs.id')
            ->first();
    }

    public static function updateinfo($id_user, $data)
    {
        try {
            $id = Employeur::where('id_user', $id_user)->first()->id;
            $validator = Validator::make($data, map_data_rule($data, static::validationRules($id)));

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }
            $update = Employeur::where('id_user', $id_user)->update($data);

            if ($update) {
                return response()->json(['success' => true, 'message' => 'modification reussie', 'data' => UserController::profil($id_user)]);
            }
           
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
