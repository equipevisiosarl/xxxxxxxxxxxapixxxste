<?php

namespace App\Http\Controllers;

use App\Models\Categories_independants;
use App\Models\Independant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IndependantController extends Controller
{
    public static function validationRules($id)
    {
        return [
            'full_name' => ['required'],
            'date_naissance' => ['required'],
            'sexe' => ['required'],
            'matricule_cnps'  => ['required', Rule::unique('independants')->ignore($id)],
            'activite' => ['required'],
            'id_categorie' => ['required'],
            'revenue_soumis' => ['required', 'numeric'],
            'pays' => ['required'],
            'id_commune' => ['required', 'numeric'],
            'lieux_activite' => ['required'],
            'lieux_residence' => ['required'],
            'photo' => ['required']
        ];
    }

    public static function getinfo($id)
    {
        return Independant::leftJoin('users', 'users.id', 'independants.id_user')
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->leftJoin('communes', 'communes.id', 'independants.id_commune')
            ->leftJoin('agences', 'agences.id', 'communes.id_agence')
            ->leftJoin('categories_independants', 'categories_independants.id', 'independants.id_categorie')
            ->where('independants.id_user', $id)
            ->orderBy('independants.id')
            ->first();
    }

    public static function updateinfo($id_user, $data)
    {
        try {
            $id = Independant::where('id_user', $id_user)->first()->id;
            $validator = Validator::make($data, map_data_rule($data, static::validationRules($id)));

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $update = Independant::where('id_user', $id_user)->update($data);
            $independant =  UserController::profil($id_user);

            if ($independant->revenue_soumis != null && $independant->revenue_planche > 0) 
             {
                $independant->montant_cnps = static::montants_cnps($independant->revenue_planche, $independant->revenue_soumis);
            }

            if ($update) {
                return response()->json(['success' => true, 'message' => 'modification reussie', 'data' => $independant]);
            }
           
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }


    public static function montants_cnps($revenue_planche, $revenue_soumis)
    {
       if ($revenue_soumis >= $revenue_planche) {

        if ($revenue_soumis > 180000) {

            $montant_risque = (12 * 180000) / 100;
            $montant_retraite = (9 * ($revenue_soumis - 180000)) / 100;
            $montant_a_payer = $montant_risque + $montant_retraite;
        } else {

            $montant_risque = (12 * $revenue_soumis) / 100;
            $montant_retraite = 0;
            $montant_a_payer = $montant_risque + $montant_retraite;
        }
       
        return ['montant_a_payer' => $montant_a_payer, 'message' => "le montant à payer ($montant_a_payer Fcfa) = au montant de risque ($montant_risque  Fcfa) + le montant de retraitre ($montant_retraite  Fcfa)"];
       }
       return ['montant_a_payer' => null, 'message' => "votre revenue soumis doit être superieure à $revenue_planche Fcfa veillez modifier votre revenue soumis"];
    }

    public function allCategorie()
    {
        return Categories_independants::all();
    }
}
