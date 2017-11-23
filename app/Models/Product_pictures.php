<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_pictures extends Model
{
    protected $table = 'tb_product_pictures';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
