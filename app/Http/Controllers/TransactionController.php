<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::all();

        return view('pages.transactions.index', compact(
            
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ORM didalam details terdapat relasi product
        $item = Transaction::with(['details.product'])->findOrFail($id);

        return view('pages.transactions.show', compact(
            
            'item'

        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.transactions.edit',compact(
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
    public function update(Request $request, $id)
    {
         // Mengambil semua data yang ada pada form
         $data = $request->all();
         // Mencocokan dengan data sesuai dengan idnya
         $item = Transaction::findOrFail($id);
         // Mengubah data yang sesuai dengan idnya
         $item->update($data);   
         // Redirect ke halaman product index ketika sukses tersimpan
         return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStatus(Request $request, $id){

        //  Validasi hanya menerima data yang bernama pending, success dan failed
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);

        $item->transaction_status = $request->status;
        
        // Melakukan update data mengubah status
        $item->save();

        return redirect()->route('transactions.index');
    }
}
