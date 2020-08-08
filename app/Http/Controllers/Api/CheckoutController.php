<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request){
        
        $data = $request->except('transaction_details');
        
        $data['uuid'] = 'TRX' . mt_rand(10000,99999) . mt_rand(100,999);
        
        $transaction = Transaction::create($data);
        
        foreach($request->transaction_details as $product){
            
            $details[] = new TransactionDetail([

                'transactions_id' => $transaction->id,
                'products_id' => $product,

            ]);
           

            // Mengupdate data dengan mengurangi stok barang
            Product::find($product)->decrement('quantity');
            
        }

        // Menyimpan data kedalan transaction details
        $transaction->details()->saveMany($details);

        return ResponseFormatter::success($transaction); 

    }
}
