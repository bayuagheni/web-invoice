<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('form_invoice');
});

Route::post('/invoice/generate', function (Request $request) {
    $nama_pelanggan = $request->input('nama_pelanggan');
    $no_whatsapp = $request->input('no_whatsapp');
    $produk_1 = $request->input('produk_1');
    $harga_1 = (int) $request->input('harga_1');
    $produk_2 = $request->input('produk_2');
    $harga_2 = (int) $request->input('harga_2', 0);
    $ongkir = (int) $request->input('ongkir', 0);
    $dp = (int) $request->input('dp', 0);
    
    // TANGKAP INPUTAN DETAIL ORDER BARU
    $size = $request->input('size', 'L');
    $request_tambahan = $request->input('request_tambahan');

    // PROSES SIMPAN FOTO KE LAPTOP (Temporary)
    $foto_kain_url = null;
    $foto_model_url = null;

    if ($request->hasFile('foto_kain')) {
        $path = $request->file('foto_kain')->move(public_path('uploads'), time().'_kain.png');
        $foto_kain_url = asset('uploads/'.time().'_kain.png');
    }
    if ($request->hasFile('foto_model')) {
        $path = $request->file('foto_model')->move(public_path('uploads'), time().'_model.png');
        $foto_model_url = asset('uploads/'.time().'_model.png');
    }

    // HITUNG MATEMATIKA
    $subtotal = $harga_1 + $harga_2;
    $total_pesanan = $subtotal + $ongkir;
    $sisa_pelunasan = $total_pesanan - $dp;
    $no_invoice = '01/INV/' . date('dmy') . '/' . rand(10, 99);

    return view('cetak_invoice', compact(
        'no_invoice', 'nama_pelanggan', 'no_whatsapp', 'produk_1', 
        'harga_1', 'produk_2', 'harga_2', 'subtotal', 'ongkir', 
        'total_pesanan', 'dp', 'sisa_pelunasan', 
        'size', 'request_tambahan', 'foto_kain_url', 'foto_model_url'
    ));
})->name('invoice.generate');