<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ingredientes',
        'pasos',
        'user_id',
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
