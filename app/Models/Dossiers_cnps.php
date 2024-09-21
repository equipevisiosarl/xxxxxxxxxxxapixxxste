<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossiers_cnps extends Model
{
    use HasFactory;
    protected $table = 'dossiers_cnps';

    /*protected $fillable = [
        'id_demande',
        'numero_dossier',
        'etat',
    ];*/
}
