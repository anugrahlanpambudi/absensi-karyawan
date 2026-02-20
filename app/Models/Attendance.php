<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'office_id', 'check_in', 'check_out', 'photo', 'latitude', 'longitude'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function office() {
        return $this->belongsTo(Office::class);
    }
}
