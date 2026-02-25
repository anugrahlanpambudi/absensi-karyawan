<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasFactory, Notifiable;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'office_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function office()
    {
        return $this->belongsTo(\App\Models\Office::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}

