<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_file extends Model
{
    protected $table = 'tb_product_file';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
