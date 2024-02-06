<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relación muchos a muchos
    public function catalogues()
    {
        return $this->belongsToMany(Catalogue::class);
    }

    //Relación uno a uno polimórfica
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
