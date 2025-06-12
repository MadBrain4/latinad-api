<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Display extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'resolution_height',
        'resolution_width',
        'type',
        'user_id',
    ];

    // Relación: Una pantalla pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
