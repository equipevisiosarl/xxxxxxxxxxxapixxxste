<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller
{
    public static function upload($typeFile, $action, $prefix, $id_user, Request $request, $api = false)
    {
        try {
            $regime = removeAccents(UserController::getRegimeUser($id_user));
            $racine = 'documents';
            switch ($typeFile) {
                case 'image':
                    $mimes = 'mimes:jpeg,png,jpg,gif';
                    $maxFile = 'max:5120';
                    $racine = 'images';
                    break;

                case 'doc':
                    $mimes = 'mimes:pdf,doc,docx';
                    $maxFile = 'max:12288';
                    break;

                case 'img-doc':
                    $mimes = 'mimes:jpeg,png,jpg,gif,pdf,doc,docx';
                    $maxFile = 'max:12288';
                    break;

                default:
                    return response()->json(['success' => false, 'message' => "type de fichier non autorisé accept image/doc/img-doc"], 500);
                    die();
                    break;
            }

            // Validation de base pour le fichier et le chemin
            $validator = Validator::make($request->all(), [
                'file' => ['required', 'file', $mimes, $maxFile],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
                die();
            }

            if ($request->hasFile('file')) {

                $oldFile = $request->input('oldFile');
                // Supprimer l'ancienne photo si nécessaire
                if ($oldFile) {
                    // Vérifier si le chemin commence par 'storage', ce qui pourrait être un URL public
                    if (strpos($oldFile, 'storage') !== false) {
                        // Convertir l'URL publique en chemin relatif pour Storage
                        $oldFile = str_replace(asset('storage'), 'public', $oldFile);
                    }
                    
                    // Supprimer le fichier en utilisant le chemin correct
                    Storage::delete($oldFile);
                }

                // Récupérer le fichier et son extension
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension(); // Obtenir l'extension originale du fichier

                // Générer un nouveau nom pour le fichier (par exemple : nom unique avec timestamp)
                $prefix = "{$prefix}_user_{$id_user}_";
                $newFileName = uniqid($prefix) . '.' . $extension;

                //definition du chemin d'upload
                $path = "{$racine}/{$action}/{$regime}s";

                // Enregistrer le fichier dans le chemin spécifié avec le nouveau nom
                $filePath = Storage::putFileAs("public/{$path}", $file, $newFileName);

                if ($filePath) {
                    $finalFilePath = asset("storage/{$path}/{$newFileName}");
                  
                    if ($api) {
                        return response()->json(['message' => 'Fichier est téléversé avec succès', 'path' => $finalFilePath], 201);
                    }
                   //return ['success'=>true, 'path'=> $finalFilePath]; 
                   return $finalFilePath;
                }

                return response()->json(['message' => 'Erreur lors du téléversement'], 500);
                die();
            }

            return response()->json(['error' => 'Aucune image fournie'], 400);
            die();
            //$path = $request->file('file')->store('file/photos-profil', 'public');

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            die();
        }
    }
}
