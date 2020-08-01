<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
      // Menggunakan softdeletes
      use SoftDeletes;

      // Menghubungkan dengan database product
      protected $fillable = [
         'products_id', 'photo', 'is_default'
      ];
  
      // Menyembunyikan field yang tidak ingin ditampilkan
      protected $hidden = [
  
      ];
  
      // Menghubungkan relasi product dengan table ProductGallery [1]
      public function product(){
  
          return $this->belongsTo(Product::class,'products_id','id');
          
      }

    // Accessor digunakan mengambil gambar diikut sertakan dengan http
    // Agar pada saat API digunakan frontend dapat memunculkan bambar
    // getPhotoAttribute = Photo (disesuaikan dengan field name yang diinginkan serta menggunakan Camel Case) 
    public function getPhotoAtrribute($value){
        
        // Disimpan pada folder storage karena menggunakan penyimpanan storage link
        return url('storage/' . $value);

    }
}
