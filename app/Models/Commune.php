<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'commune_name',
        'commune_code',
        'status'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
    
}
