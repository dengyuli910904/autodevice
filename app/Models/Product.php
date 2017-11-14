<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
