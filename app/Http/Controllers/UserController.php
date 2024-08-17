<?php
namespace App\Http\Controllers;

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
            // Validation des données
            $validator = Validator::make($request->json()->all(), [
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
            $user = User::create($request->json()->all());
        
            if ($user) {
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
    $validator = Validator::make($request->json()->all(), [
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
        return response()->json(['success' => true, 'message' => 'connexion réussie']);
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
            $user = User::select()
            ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
           // ->leftJoin('regimes', 'regimes.id', 'users.id_regime')
            ->orderBy('users.id')
            ->first();

            return $user;
        }
        throw new Exception("Profile inconnu", 1);
        
    } catch (\Throwable $th) {
        return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
    }

   }


   public function update()
   {
    
   }
}
