<?php

namespace App\Http\Controllers;

use App\Models\Employeur;
use App\Models\Independant;
use App\Models\Retraite;
use App\Models\Salarie;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                'password' => ['required', 'min:8'],
                'name' => ['required']
            ]);

            // Gestion des erreurs de validation
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            // Création de l'utilisateur
            $user = User::create($map_data = map_data($apiData, ['telephone', 'id_regime', 'email', 'password']));

            if ($user) {
                $data =  ['id_user' => $user->id, 'full_name' => $apiData['name'], 'sexe' => $apiData['sexe']];
                switch ($user->id_regime) {
                    case 1:
                        $data_ = ['id_user' => $user->id, 'raison_social' => $apiData['name']];
                        Employeur::insert($data_);
                        break;

                    case 2:
                        Salarie::insert($data);
                        break;

                    case 3:
                        Independant::insert($data);
                        break;

                    case 4:
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


    public static function profil($id)
    {

        try {
            if ($user = User::find($id)) {
                $id_regime = $user->id_regime;
                switch ($id_regime) {
                    case 1:
                        return EmployeurController::getinfo($id);
                        break;

                    case 2:
                        $salarie = SalarieController::getinfo($id);
                        $salarie->data_employeur = reverse_unset_obj_data(EmployeurController::getinfo($salarie->id_employeur), [
                            'raison_social', 'nom_responsable', 'situation_geographique', 'photo', 'commune', 'agence'
                        ]);
                        return $salarie;
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
            throw new Exception("Profile inconnu", 1);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            if ($user = User::find($id)) {

                $apiData = $request->json()->all();
                if (count($data_user = map_data($apiData, ['telephone', 'email'])) > 0) {
                    $validator = Validator::make($data_user, map_data_rule($data_user, [
                        'telephone' => ['required', 'numeric', 'digits:10', Rule::unique('users')->ignore($id)],
                        'email' => ['required', 'email', Rule::unique('users')->ignore($id)]
                    ]));

                    // Gestion des erreurs de validation
                    if ($validator->fails()) {
                        return response()->json(['success' => false, 'message' => $validator->errors()], 422);
                    }

                    User::where('id', $id)->update($data_user);
                }

                $id_regime = $user->id_regime;
                switch ($id_regime) {
                    case 1:
                        $data = map_data($apiData, [
                            'raison_social',
                            'num_registre_commerce',
                            'nom_responsable',
                            'matricule_cnps',
                            'id_domaine_activite',
                            'effectifs',
                            'pays',
                            'id_commune',
                            'situation_geographique',
                            'photo'
                        ]);
                        return EmployeurController::updateinfo($id, $data);
                        break;

                    case 2:
                        $data = map_data($apiData, [
                            'full_name',
                            'date_naissance',
                            'sexe',
                            'matricule_cnps',
                            'employeur',
                            'id_employeur',
                            'date_embauche',
                            'date_immatriculation',
                            'poste',
                            'salaire',
                            'pays',
                            'id_commune',
                            'lieux_activite',
                            'lieux_residence',
                            'photo'
                        ]);
                        return SalarieController::updateinfo($id, $data);
                        break;

                    case 3:
                        $data = map_data($apiData, [
                            'full_name',
                            'date_naissance',
                            'sexe',
                            'matricule_cnps',
                            'activite',
                            'id_categorie',
                            'revenue_soumis',
                            'pays',
                            'id_commune',
                            'lieux_activite',
                            'lieux_residence',
                            'photo'
                        ]);
                        return IndependantController::updateinfo($id, $data);
                        break;

                    case 4:
                        $data = map_data($apiData, [
                            'full_name',
                            'date_naissance',
                            'sexe',
                            'matricule_cnps',
                            'pays',
                            'id_commune',
                            'lieux_residence',
                            'photo'
                        ]);
                        return  RetraiteController::updateinfo($id, $data);
                        break;

                    default:
                        throw new Exception("Profile inconnu", 1);
                        break;
                }
            }
            throw new Exception("Profile inconnu", 1);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
