<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand_product extends Model
{
    protected $table = 'tb_brand_product';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
