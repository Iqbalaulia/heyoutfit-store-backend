<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
     // Menggunakan softdeletes
     use SoftDeletes;

     // Menghubungkan dengan database product
   protected $fillable = [
       'products_id', 'transactions_id'
   ];

   // Menyembunyikan field yang tidak ingin ditampilkan
   protected $hidden = [

   ];

   public function transaction(){
       return $this->belongsTo(Transaction::class,'transactions_id','id');
   }

   public function product(){
    return $this->belongsTo(Product::class,'products_id','id');
}
}
