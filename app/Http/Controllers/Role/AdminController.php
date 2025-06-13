<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(){
        //mengambil data n juga menghitung total
        $data = User::select('id', 'name', 'email', 'role','created_at')->paginate(3);
        $dataProduct = Product::select('id', 'nama_product', 'harga', 'stok', 'kategori','image', 'description')->orderBy('id', 'asc')->get();
        $dataTransaction = Pembelian::with('product:id,nama_product')->select('nama_pembeli','stok_beli','harga_beli','product_id', 'total_bayar')->get();
        $totalUser = $data->total();
        $totalProduct = $dataProduct->count();
        $totalTransaction = $dataTransaction->count();
        return view('halaman.admin.admin', ['data' => $data, 'totalProduct' => $totalProduct, 'totalUser' => $totalUser, 'totalTransaction' => $totalTransaction]);
    }

    public function index2(){
        //ambil data biasa
        $data = Product::select('id', 'nama_product', 'harga', 'stok', 'kategori','image', 'description')->orderBy('id', 'asc')->get();
        return view('halaman.admin.admincreate', ['data' => $data]);
    }

    public function index3(Request $request){
        //mengambil untuk edit
        $data = Product::where('id', $request->id)->select([
            'id',
            'nama_product',
            'harga',
            'stok',
            'kategori',
            'description',
            'image'
        ])->get();
        $data2 = Product::select('id', 'nama_product', 'harga', 'stok', 'kategori','image', 'description')->orderBy('id', 'asc')->get();
        return view('halaman.admin.adminedit', ['data' => $data, 'data2' => $data2]);
    }

    public function index4(){
        $data = Pembelian::with('product:id,nama_product')->select('nama_pembeli', 'stok_beli', 'harga_beli','product_id', 'total_bayar')->orderBy('id', 'asc')->paginate(5);
        return view('halaman.admin.adminhistory', ['data' => $data]);
    }

    public function createData(Request $request){
        $path = null;
        if($request->has('image')){
            $image = $request->file('image');
            $path = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $path);
        }
        $cekImage = Product::where('nama_product', $request->nama_product)->exists();
        if($cekImage){
            return redirect('/admin')->withErrors(['error'=>'Nama Product sudah ada!']);
        }else{
            Product::insert([
            'nama_product'=> $request->nama_product,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'kategori'=> $request->kategori,
            'image' => $path,
            'description' => $request->description
        ]);
        }
        return redirect('/create');
    }

    public function deleteData(Request $request){
        Product::where('id', $request->id)->delete();
        return redirect('/create');
    }

    public function updateData(Request $request){
        $product = Product::find($request->id);
        $path = $product->image;
        if($request->has('image')){
            $image = $request->file('image');
            $path = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $path);
        }
        Product::where('id', $request->id)->update([
            'nama_product'=> $request->nama_product,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'kategori'=> $request->kategori,
            'image' => $path,
            'description' => $request->description
        ]);
        return redirect('/create');
    }
}
