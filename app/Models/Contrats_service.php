<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrats_service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande',
        'contrat',
        'a_payer'
    ];
}
