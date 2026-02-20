<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'radius',
        'start_time',
        'end_time'
    ];
}
