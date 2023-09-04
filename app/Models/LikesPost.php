<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesPost extends Model
{
    public $timestamps  = false;
    protected $table    = 'likes'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'id_user',
        'id_seller',
        'id_post',
        'time',
    ];
}
