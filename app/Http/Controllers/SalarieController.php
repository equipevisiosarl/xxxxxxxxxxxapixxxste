<?php

namespace App\Http\Controllers;

use App\Models\Salarie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SalarieController extends Controller
{
    public static function validationRules($id)
    {
        return [
            'full_name' => ['required'],
            'date_naissance' => ['required'],
            'sexe' => ['required'],
            'matricule_cnps'  => ['required', Rule::unique('salaires')->ignore($id)],
            'employeur'=> ['required'],
            'id_employeur'=> ['required', 'integer'],
            'date_embauche'=> ['required'],
            'date_immatriculation'=> ['required'],
            'poste'=> ['required'],
            'salaire'=> ['required', 'numeric'],
            'pays' => ['required'],
            'id_commune' => ['required', 'numeric'],
            'lieux_residence' => ['required'],
            'photo' => ['required']
        ];
    }

    public static function getinfo($id)
    {
        return Salarie::leftJoin('users', 'users.id', 'salaries.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'salaries.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('salaries.id_user', $id)
            ->orderBy('salaries.id')
            ->first();
    }

    public static function updateinfo($id_user, $data)
    {
        try {
            $id = Salarie::where('id_user', $id_user)->first()->id;
            $validator = Validator::make($data, map_data_rule($data, static::validationRules($id)));

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }
            $update = Salarie::where('id_user', $id_user)->update($data);

            if ($update) {
                return response()->json(['success' => true, 'message' => 'modification reussie', 'data' => UserController::profil($id_user)]);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
