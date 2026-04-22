<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    public function esAdmin(): bool
    {
        return $this->rol === 'Admin';
    }

    public function esCocinero(): bool
    {
        return $this->rol === 'Cocinero';
    }

    public function esAsistente(): bool
    {
        return $this->rol === 'Asistente';
    }
}
