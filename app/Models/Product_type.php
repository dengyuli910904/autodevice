<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{
    protected $table = 'tb_product_type';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
