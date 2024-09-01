<?php

namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(int $id_regime)
    {
       $services = Service::where('id_regime', $id_regime)->get();
       $result = [];
       foreach ($services as $key => $value)
       {
        $result[$key] = $value;
       $result[$key]['document'] = Document_serviceController::show($value->id);
       }
       return $services;
    }
}
