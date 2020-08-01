<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
      // Menggunakan softdeletes
      use SoftDeletes;

      // Menghubungkan dengan database product
    protected $fillable = [
        'uuid', 'name', 'email', 'number', 'address', 'transaction_total', 'transaction_status'
    ];

    // Menyembunyikan field yang tidak ingin ditampilkan
    protected $hidden = [

    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class,'transactions_id');
    }
}
