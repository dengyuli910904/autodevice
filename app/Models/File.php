<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'tb_file';
    public $timestamp = true;
    protected $casts = [
        'id' => 'string'
    ];
}
