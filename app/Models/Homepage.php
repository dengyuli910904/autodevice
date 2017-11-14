<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $table = 'tb_homepage';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
