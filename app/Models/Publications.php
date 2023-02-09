<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publications extends Model
{
    use HasFactory;
    protected $table = 'publications';
    protected $primaryKey = 'publications_id';
    public $timestamps = false;
    protected $fillable = ['publications_id', 'status', 'content', 'reactions','id_user','date','uuid'];
}
