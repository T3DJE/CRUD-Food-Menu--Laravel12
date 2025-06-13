<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = Product::select('id','nama_product', 'harga', 'stok', 'kategori', 'image', 'description')->where('stok', '>', 0)->orderBy('id', 'asc')->get();
        return view('halaman.user.user', ['data' => $data]);
    }

    public function search(Request $request){
        $search = $request->search;
        $data = Product::select('id', 'nama_product', 'harga', 'stok', 'kategori', 'image', 'description')->where('nama_product', $search)->where('stok', '>', 0)->get();
        if($data->isEmpty()){
            $data = Product::select('id','nama_product', 'harga', 'stok', 'kategori', 'image', 'description')->where('stok', '>', 0)->orderBy('id', 'asc')->get();
            return redirect('/')->with(['data' => $data]);
        }else{
            return view('halaman.user.user', ['data' => $data]);
        }
    }
}
