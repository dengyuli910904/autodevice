<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'tb_type';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
