<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class SubCategory extends Model
{
    use HasFactory;
    protected $table      = 'sub_category';
    protected $primaryKey = 'id_sub';
    public    $timestamps = false;
    protected $fillable   = ['id_sub', 'sub_name', 'sub_status', 'id_category'];
    public function category() : BelongsTo{
        return $this->belongsTo(Category::class,'cat_id','id_category');
    }
}

