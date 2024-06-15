<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at', 'updated_at'];


    //categorias
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

}
