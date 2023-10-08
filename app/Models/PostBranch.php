<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBranch extends Model
{
    use HasFactory;
    protected $table        = 'post_branch';
    protected $primaryKey   = 'id_post';
    public    $incrementing = true;
    public $timestamps      = false;

    protected $fillable     = [
        'id_post',
        'contenido',
        'id_user',
        'likes',
        'img_1',
        'img_2',
        'img_3',
        'fecha',
        'id_branch',
        'Tittle',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch', 'id_branch');
    }

}
