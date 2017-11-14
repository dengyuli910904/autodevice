<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'tb_news';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
