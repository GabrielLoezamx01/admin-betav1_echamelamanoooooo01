<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Sucursales extends Model
{
    use HasFactory;
    protected $table      = 'branch';
    protected $primaryKey = 'id_branch';
    public    $timestamps = false;
    protected $fillable   = ['id_branch', 'name_branch', 'street', 'address','city','state','postal_code','delete','id_client'];
}
