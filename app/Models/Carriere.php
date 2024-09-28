<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carriere extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'employeur',
        'date_embauche',
        'date_depart',
        'rang'
    ];
}
