<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table        = 'branch';
    protected $primaryKey   = 'id_branch';
    public    $incrementing = false;

    protected $fillable     = [
        'id_seller',
        'name_branch',
        'street',
        'address',
        'city',
        'state',
        'postal_code',
        'delete',
        'id_service',
        'span',
        'description',
        'rang',
        'image',
        'id_like',
        'maps',
        'rfc',
        'run_on',
        'off',
    ];

    protected $casts = [
        'id_seller'  => 'integer',
        'delete'     => 'integer',
        'id_service' => 'integer',
        'rang'       => 'integer',
        'id_like'    => 'integer',
    ];
    public function postBranches()
    {
        return $this->hasMany(PostBranch::class, 'id_branch', 'id_branch');
    }
}
