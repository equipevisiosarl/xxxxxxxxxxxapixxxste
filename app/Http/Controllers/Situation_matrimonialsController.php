<?php

namespace App\Http\Controllers;

use App\Models\Situation_matrimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Situation_matrimonialsController extends Controller
{
    public static function validationRule()
    {
        return [
            'id_user' => ['required', 'numeric'],
            'situation' => ['required', 'min:1'],
            'lieu_mariage' => ['required'],
            'date_mariage' => ['required'],
            'nombre_enfant' => ['required'],
            'nom_conjoint' => ['required'],
        ];
    }

    public function create(Request $request, $id_user)
    {
        try {
            $apiData = $request->json()->all();
            $apiData['id_user'] = $id_user;
            // Validation des données
            $validator = Validator::make($apiData, [
               'id_user' => ['required', 'numeric', "unique:situation_matrimonials"],
                'situation' => ['required', 'min:1'],
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            if (Situation_matrimonial::insert(map_data($apiData, [
                'id_user',
                'situation',
                'lieu_mariage',
                'date_mariage',
                'nombre_enfant',
                'nom_conjoint'
            ]))) {
                return response()->json(['success' => true, 'message' => 'Situation matrimoniale ajoutée', 'data' => $this->getMatrimonial($apiData['id_user'])]);
            }

            return response()->json(['success' => false, 'message' => ' echec lors de l\'ajout de la Situation matrimoniale']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message' => "echec lors de l'ajout de la Situation matrimoniale: " . $th->getMessage()], 500);
        }
    }

    public function update($id_user, Request $request)
    {
        try {
            $apiData = $request->json()->all();
           $data = map_data($apiData, [
                'situation',
                'lieu_mariage',
                'date_mariage',
                'nombre_enfant',
                'nom_conjoint'
           ]);
            $validator = Validator::make($data, map_data_rule($data, static::validationRule()));

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }
            $update = Situation_matrimonial::where('id_user', $id_user)->update($data);

            if ($update) {
                return response()->json(['success' => true, 'message' => 'modification reussie', 'data' => $this->getMatrimonial($id_user)]);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }


    public function getMatrimonial($id_user)
    {
        $sm = Situation_matrimonial::where('id_user', $id_user)->first();
        if ($sm) {
           return $sm;
        }

        return [
            'id_user' => $id_user,
            'situation' => null,
            'lieu_mariage'  => null,
            'date_mariage'  => null,
            'nombre_enfant'  => null,
            'nom_conjoint'  => null
        ];

    }
}
