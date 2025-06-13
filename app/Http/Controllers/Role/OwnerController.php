<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Product;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:owner');
    }
    public function index(){
        //owner cuma ngambil data yang gak 0
        $data = Product::select('id','nama_product', 'harga', 'stok', 'kategori','image', 'description')->where('stok','>',0)->orderBy('id', 'asc')->get();
        return view('halaman.owner.owner', ['data' => $data]);
    }

    public function index2(){
        //mengambil data transaksi dari relasi product juga coo
        $data2 = Pembelian::with('product:id,nama_product')->select('nama_pembeli','stok_beli','harga_beli','product_id', 'total_bayar')->get();
        return view('halaman.owner.ownerhistory', ['data2' => $data2]);
    }

    public function index3(){
        //owner cuma ngambil data yang gak 0
        $data = Product::select('id','nama_product', 'harga', 'stok', 'kategori','image', 'description')->where('stok','>',0)->orderBy('id', 'asc')->get();
        return view('halaman.owner.ownercashier', ['data' => $data]);
    }

    public function createPembelian(Request $request){
        $product = Product::find($request->product_id);
        $totalbayar = $request->stok_beli * $product->harga;
        if($request->harga_beli < $totalbayar){
            return redirect('/cashier')->withErrors(['errors'=>'Harga Bayar Kurang!']);
        }
        if($request->stok_beli > $product->stok){
            return redirect('/cashier')->withErrors(['errors'=>'Stok yang dibeli lebih!']);
        }
        Pembelian::insert([
            'nama_pembeli'=> $request->nama_pembeli,
            'stok_beli'=> $request->stok_beli,
            'harga_beli'=> $request->harga_beli,
            'product_id'=> $request->product_id,
            'total_bayar'=> $totalbayar,
        ]);
        $product->stok = $product->stok - $request->stok_beli;
        $product->save();
        if($product->stok <= 0){
            $product->stok = 0;
            $product->save();
        }
        return redirect('/cashier');
    }

    public function createProduct(Request $request){
        $path = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $path);
        }
        $cekImage = Product::where('nama_product', $request->nama_product)->exists();
        if($cekImage){
            return redirect('/owner')->withErrors(['error' => 'Nama Product sudah ada!']);
        }else{
            Product::insert([
                "nama_product" => $request->nama_product,
                "harga" => $request->harga,
                "stok" => $request->stok,
                "kategori" => $request->kategori,
                "description" => $request->description,
                "image" => $path
            ]);
        }
        return redirect('/owner');
    }
}
