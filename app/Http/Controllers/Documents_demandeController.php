<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Documents_demande;
use App\Models\Documents_service;
use Illuminate\Http\Request;

class Documents_demandeController extends Controller
{
    public static function upload($prefix, $id_demande, Request $request)
    {
        $docexige = Documents_service::where('prefix', $prefix)->first();
        if (!$docexige) {
            return response()->json(['success' => false, 'message' => "prefix du document non reconnu"], 422);
        }
        $id_document_service = $docexige->id; 
        $id_user = Demande::find($id_demande)->id_user;
        $path = UploadFileController::upload('img-doc', 'demandes', $prefix, $id_user, $request);

        if(!is_string($path)){
            return $path;
        }
        
        Documents_demande::updateOrCreate(
            [
                'id_demande' => $id_demande,
                'id_user' => $id_user,
                'id_document_service' => $id_document_service,
            ],
            [
                'document' => $path ,
            ]
        );
        return response()->json(['succes'=> true ,'message' => 'Document sauvegardé avec succès', 'documentPath' => $path], 200);
    }

    public static function getDocumentDemande($id_demande, $prefix = 'all')
    {
        $document = Documents_demande::where(['id_demande' => $id_demande]);
        if($prefix == 'all'){
            return $document->get();
        }
        $docexige = Documents_service::where('prefix', $prefix)->first();
        if (!$docexige) {
            return response()->json(['success' => false, 'message' => "prefix du document non reconnu"], 422);
        }
        $id_document_service = $docexige->id;
        return $document->where('id_document_service', $id_document_service)->first();
    }

   
}
