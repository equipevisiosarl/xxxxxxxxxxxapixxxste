<?php

namespace App\Http\Controllers;

use App\Models\Documents_service;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;

class Document_serviceController extends Controller
{
    public static function show(int $id_regime)
    {
       return Documents_service::where('id_service', $id_regime)->get();
    }
}
