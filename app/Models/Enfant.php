<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'fullname',
        'date_naissance',
        'niveau_etude',
        'second_parent',
    ];
}
