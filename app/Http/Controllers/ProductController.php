<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGallery;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $items = Product::all();
        return view('pages.products.index', compact(
            'items'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // Mengambil semua data yang ada pada form
        $data = $request->all();
        // Mengambil data name dan diubah menjadi slug name
        $data['slug'] = Str::slug($request->name);
        // Insert data
        Product::create($data);
        // Redirect ke halaman product index ketika sukses tersimpan
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('pages.products.edit', compact(
            'item'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // Mengambil semua data yang ada pada form
        $data = $request->all();
        // Mengambil data name dan diubah menjadi slug name
        $data['slug'] = Str::slug($request->name);
        // Mencocokan dengan data sesuai dengan idnya
        $item = Product::findOrFail($id);
        // Mengubah data yang sesuai dengan idnya
        $item->update($data);   
        // Redirect ke halaman product index ketika sukses tersimpan
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        $item->delete();

        return redirect()->route('products.index');

    }

    public function gallery(Request $request, $id){

        $product = Product::findOrFail($id);

        $items = ProductGallery::with(['product'])
        ->where('products_id', $id)
        ->get();

        return view('pages.products.gallery', compact(
            'product' , 'items'
        ));

    }
}
