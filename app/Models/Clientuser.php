<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientuser extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['uuid', 'id', 'email', 'phone','andress','description','validate','id_category','photo','rang','active','name','last_name','suscription','password','postal','estado','ciudad'];
}
