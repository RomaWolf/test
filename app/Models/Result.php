<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int   a
 * @property int   b
 * @property int   c
 * @property float x1
 * @property float x2
 */
class Result extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'a',
        'b',
        'c',
        'x1',
        'x2',
    ];
}
