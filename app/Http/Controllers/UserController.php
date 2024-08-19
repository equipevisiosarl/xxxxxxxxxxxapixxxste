<?php

namespace App\Http\Controllers;

use App\Models\Employeur;
use App\Models\Independant;
use App\Models\Retraite;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function create(Request $request)
    {
        try {
            $apiData = $request->json()->all();
            // Validation des données
            $validator = Validator::make($apiData, [
                'telephone' => ['required', 'unique:users', 'numeric', 'digits:10'],
                'id_regime' => ['required'],
                'email' => ['required', 'unique:users', 'email'],
                'password' => ['required', 'min:8']
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            // Création de l'utilisateur
            $user = User::create($map_data = map_data($apiData, ['telephone', 'id_regime', 'email', 'password']));

            if ($user) {
                $data = [];

                switch ($user->id_regime) {
                    case 1:
                        $data = insert_table($data, ['id_user' => $user->id, 'raison_social' => $apiData['name']]);
                        Employeur::insert($data);
                        break;

                    case 2:
                        return 'salarie';
                        break;

                    case 3:
                        $data = insert_table($data, ['id_user' => $user->id, 'full_name' => $apiData['name'], 'sexe' => $apiData['sexe']]);
                        Independant::insert($data);
                        break;

                    case 4:
                        $data = insert_table($data, ['id_user' => $user->id, 'full_name' => $apiData['name'], 'sexe' => $apiData['sexe']]);
                        Retraite::insert($data);
                        break;

                    default:
                        # supprime l'enregistrement et renvoie inscription echoue

                        $user->delete();
                        return response()->json(['success' => false, 'message' => "Erreur lors de l'inscription : regime inconnu"], 500);
                        break;
                }
                return response()->json(['success' => true, 'message' => 'Inscription réussie']);
            }

            return response()->json(['success' => false, 'message' => "Erreur lors de l'inscription"], 500);
        } catch (\Throwable $th) {
            // Gérer les erreurs potentielles
            return response()->json(['success' => false, 'message' => "Erreur lors de l'inscription: " . $th->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        try {
            $credentials = $request->only('telephone', 'password');

            // Validation des données
            $validator = Validator::make($credentials, [
                'telephone' => ['required', 'numeric', 'digits:10'],
                'password' => ['required', 'min:8']
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                //$token = $user->createToken('API Token')->plainTextToken;

                //return response()->json(['token' => $token]);
                return response()->json([
                    'success' => true,
                    'message' => 'connexion réussie',
                    'id' => $user->id
                ]);
            }

            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => "Erreur lors de la connexion: " . $th->getMessage()], 500);
        }
    }


    public function profil($id)
    {

        try {
            if ($user = User::find($id)) {
                $id_regime = $user->id_regime;
                switch ($id_regime) {
                    case 1:
                        return EmployeurController::getinfo($id);
                        break;

                    case 2:
                        return 'salarie';
                        break;

                    case 3:
                        return IndependantController::getinfo($id);
                        break;

                    case 4:
                        return  RetraiteController::getinfo($id);
                        break;

                    default:
                        throw new Exception("Profile inconnu", 1);
                        break;
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }


    public function update() {}
}
