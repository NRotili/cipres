<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function productosPublicados()
    {
        //Only return productos with estado = 1
        return $this->hasMany(Product::class)->where('estado', 1);
    }

    public function productos()
    {
        //Only return productos with estado = 1
        return $this->hasMany(Product::class);
    }

    public function catalogues()
    {
        return $this->belongsToMany(Catalogue::class);
    }
}
