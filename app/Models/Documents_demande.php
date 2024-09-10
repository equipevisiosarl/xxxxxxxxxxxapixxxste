<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents_demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_demande',
        'id_user',
        'document',
        'id_document_service'
    ];
}
