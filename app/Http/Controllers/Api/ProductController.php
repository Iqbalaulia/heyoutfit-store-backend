<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request){

        // API
        
        // Menampilkan data pada url dengan contoh product/api/product?id=1
        $id = $request->input('id');
        
        // Membatasi data request sebanyak 6 data
        $limit = $request->input('limit' , 6);
        
        // Search berdasarkan nama
        $name = $request->input('name');
        
        // Search berdasarkan slug
        $slug = $request->input('slug');
        
        // Search berdasarkan type
        $type = $request->input('type');
        
        // Search berdasarkan harga
        $price_form = $request->input('price_form');
        $price_to = $request->input('price_to');


        // Memanggil data dengan API JSON
        // Memanggil data berdasarkan id
        if($id){
            
            $product = Product::with(['galleries'])->find($id);
            
            if($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasi Diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk Kosong',404);
                        
        }
        // Memanggil data berdasarkan slug
        if($slug){
            
            $product = Product::with(['galleries'])->where('slug',$slug)->first();
            
            if($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasi Diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk Kosong',404);
                        
        }

        
        $product = Product::with(['galleries']);
        // Memanggil data beradasarkan nama
        if($name)
         
            $product->where('name', 'like', '%' . $name . '%');

        // Memanggil data beradasarkan tipe
        if($type)
         
            $product->where('type', 'like', '%' . $type . '%');

        // Memanggil data price 
        if($price_form)
         
            $product->where('price_form', '>=', $price_form);
        
        if($price_to)
         
            $product->where('price_to', '<=', $price_to);

        
        return ResponseFormatter::success(
                
                $product->paginate($limit), 'Data list produk berhasil diambil'

            );

    }
}
