<?php

namespace App\Http\Controllers;
use App\Models\Product;


class ProductController extends Controller{
	
	function index(){
		$user = request()->user();
		$data['list_product'] = $user->product;
		return view('product.index',$data);
	}
	function create(){
		return view('product.create');

	}
	function store(){
		$product = new product;
		$product->id_user = request()->user()->id;
		$product->nama = request('nama');
		$product->harga = request('harga');
		$product->berat = request('berat');
		$product->deskripsi = request('deskripsi');
		$product->stok = request('stok');
		$product->save();

		return redirect('product')->with('success', 'Data Berhasil Ditambahkan');
	}
	function show($product){
		$data['product'] = product::find($product);
		return view('product.show', $data);
	}
	function edit($product){
		$data['product'] = product::find($product);
		return view('product.edit', $data);
	}
	function update(product $product){
		$product->nama = request('nama');
		$product->harga = request('harga');
		$product->berat = request('berat');
		$product->deskripsi = request('deskripsi');
		$product->stok = request('stok');
		$product->save();

		return redirect('product')->with('warning', 'Data Berhasil Diupdate');
	}
	function destroy(product $product){
		$product->delete();

		return redirect('product')->with('danger', 'Data Berhasil Dihapus');

	}
	function filter(){
		$nama = request('nama');
		$data['list_product'] = product::where('nama', 'like', "%$nama%")->get();
		$data['nama'] = $nama;
		
		return view('product.index',$data);
	}
}
