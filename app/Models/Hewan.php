<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table = 'hewans';

    protected $fillable = [
        'nama',
        'jenis',
    ];
}
