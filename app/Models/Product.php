<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // Menggunakan softdeletes
    use SoftDeletes;

    // Menghubungkan dengan database product
    protected $fillable = [
        'name', 'type', 'description', 'price', 'slug', 'quantity'
    ];

    // Menyembunyikan field yang tidak ingin ditampilkan
    protected $hidden = [

    ];

    // Menghubungkan relasi product dengan table ProductGallery [0]
    
    // [1] terdapat pada model ProductGallery
    public function galleries(){

        return $this->hasMany(ProductGallery::class,'products_id');

    }

}
