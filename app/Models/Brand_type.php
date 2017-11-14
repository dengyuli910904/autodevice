<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand_type extends Model
{
    protected $table = 'tb_brand_type';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
