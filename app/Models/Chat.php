<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'consulta',
        'tipo',
        'status',
        'client_id',
    ];

    //chat belongs to a client
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'client_id');
    }
}
