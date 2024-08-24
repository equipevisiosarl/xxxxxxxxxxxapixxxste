<?php

namespace App\Http\Controllers;

use App\Models\Retraite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RetraiteController extends Controller
{
    public static function validationRules($id)
    {
        return [
            'full_name' => ['required'],
            'date_naissance' => ['required'],
            'sexe' => ['required'],
            'matricule_cnps'  => ['required', Rule::unique('retraites')->ignore($id)],
            'pays' => ['required'],
            'id_commune' => ['required'],
            'lieux_residence' => ['required'],
            'photo' => ['required']
        ];
    }

    public static function getinfo($id)
    {
        return Retraite::leftJoin('users', 'users.id', 'retraites.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'retraites.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->where('retraites.id_user', $id)
            ->orderBy('retraites.id')
            ->first();
    }


    public static function updateinfo($id_user, $data)
    {
        try {
            $id = Retraite::where('id_user', $id_user)->first()->id;
            $validator = Validator::make($data, map_data_rule($data, static::validationRules($id)));

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }
            $update = Retraite::where('id_user', $id_user)->update($data);

            if ($update) {
                return response()->json(['success' => true, 'message' => 'modification reussie', 'data' => UserController::profil($id_user)]);
            }
           
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
