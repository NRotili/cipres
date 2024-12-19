<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'localidad',
        'telefono',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'client_id');
    }
}
