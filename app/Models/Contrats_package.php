<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrats_package extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande_package',
        'contrat',
        'a_payer',
        'date_debut',
        'date_fin'
    ];
}
