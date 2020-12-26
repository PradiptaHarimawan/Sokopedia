<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Order;
use App\OrderDetail;
use Session;
use File;
use DB;

class ProductController extends Controller
{
    //function store akan terpanggil apabila admin menambahkan product
    public function store(Request $request){
        //di sini akan terjadi validasi terlebih dahulu dan apabila product sudah sesuai 
        //barulah di masukan ke database
        $this->validate($request, [
            'name' => 'required|unique:App\Product,product_name',
            'category' => 'required',
            'desc' => 'required',
            'price' => 'required|gt:100',
            'image' => 'required|image|max:10000'
        ]);


        $product = new Product;

        $product->product_name = $request->name;
        $product->category_id = $request->category;
        $product->desc = $request->desc;
        $product->price = $request->price;
        
        //disini akan dicek apabila ada image maka akan dimasukan ke dalam folder public/storage/images
        //karena kami menggunakan php artisan storage:link maka kemungkinan besar tidak akan berhasil saat
        //dijalankan dikomputer lain
        //solusinya adalah kami menambahkan move() untuk langsung di pindahkan ke folder yang sesuai.
        if($request->hasFile('image')){
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();

            $filePath = $request->file('image')->move('storage/images', $fileName);

            $product->image = $fileName;

        }

        $product->save();

        return redirect('admin');
    }

    //fungsi ini akan terpanggil apabila admin menghapus barang
    //gambar yang ada di storage juga akan terhapus
    public function destroy($id){
        $products = Product::findorFail($id);
        File::delete('storage/images/'. $products->image);
        $products->delete();
        return redirect()->back();
    }

    //fungsi ini dipanggil saat user masuk ke halaman /home 
    //berfungsi untuk mengembalikan product dengan paginate(3) ke view home
    public function show(){
        $products = Product::all();
        $auth = Auth::check();

        $products = Product::paginate(3);

        return view('home', ['products' => $products, 'auth'=> $auth]);
    }

    //fungsi ini dipanggil apabila user ingin melihat product detail
    public function detail($id){
        $products = Product::findorFail($id);
        $auth = Auth::check();
        return view('productDetail', ['products' => $products, 'auth' => $auth]);
    }

    //fungsi ini dipanggil apabila user ingin memasukan product ke dalam cart
    //fungsi ini mengembalikan view ke user agar dapat menginput quantity
    public function cart($id){
        $products = Product::findorFail($id);
        $auth = Auth::check();
        return view('addToCart', ['products' => $products, 'auth' => $auth]);
    }

    //fungsi ini dipanggil apabila user ingin mencari product sesuai dengan nama productnya
    //fungsi ini akan mengembalikan view ke home
    //dan mengembalikan product yang mengandung inputan user dengan paginate(3)
    public function search(Request $request){
        $search = $request->input('search');
        $auth = Auth::check();

        $products = Product::where('product_name', 'like', "%$search%")->paginate(3);
        return view('home', ['products' => $products, 'auth' => $auth]);
    }

    //fungsi ini dipanggil apabila user ingin melihat halaman cart
    //fungsi ini berguna agar user dapat melihat halaman cart
    public function viewCart(){
        $auth = Auth::check();

        return view('cart', ['auth' => $auth]);
    }


    //fungsi ini dipanggil ketika user menambahkan product ke cart
    //kami menggunakan session maka apabila user logout, barang yang ada di dalam cart akan hilang
    public function addToCart(Request $req){
        $products = Product::find($req->productid);
        $id = $req->productid;

        if($req->qty <= 0){
            return redirect()->back(); 
        }

        if($products){
            $cart = session()->get('cart');

            if(!$cart){
                $cart = [
                    $id => [
                        "idprod" => $products->id,
                        "name" => $products->product_name,
                        "quantity" => $req->qty,
                        "price" => $products->price,
                        "desc" => $products->desc,
                        "photo" => $products->image
                    ]
            ];

            session()->put('cart', $cart);
            return redirect('home')->with('success', 'Product added to cart successfully!');
            }

            if(isset($cart[$id])){
                $cart[$id]['quantity'] += $req->qty;
                session()->put('cart', $cart);
                return redirect('home')->with('success', 'Product added to cart successfully!');
            }
            
            $cart[$id] = [
                "idprod" => $products->id,
                "name" => $products->product_name,
                "quantity" => $req->qty,
                "price" => $products->price,
                "desc" => $products->desc,
                "photo" => $products->image
            ];
            session()->put('cart', $cart);
            return redirect('home')->with('success', 'Product added to cart successfully!');
        }
    }    

    //fungsi ini dipanggil ketika user ingin melihat history mereka
    public function history(){
        $auth = Auth::check();
        $userid = Auth::user()->id;

        $order = order::where('user_id', 'like', "$userid")->get();

        //echo $order->user_id;

        return view('history', ['auth' => $auth, 'order' => $order]);
    }


    //fungsi ini akan dipanggil ketika user  ingin melihat history detail
    public function historyDetail($id){
        $auth = Auth::check();
        $detail = orderdetail::where('order_id', 'like', "$id")->get();
        return view('historyDetail', ['auth' => $auth, 'detail' => $detail]);
    }


    //fungsi ini akan dipanggil apabila user ingin menghapus product yang ada di dalam cart
    public function deleteCart($id){
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect('cart');
    }

    //fungsi ini akan dipanggil apabila user ingin mengedit quantity di halaman cart
    public function editCart($id, Request $req){
        $cart = session()->get('cart');
        if($req->qty == 0){
            unset($cart[$id]);
        }
        else if($req->qty < 0){
            return redirect('cart');    
        }
        else{
            $cart[$id]['quantity'] = $req->qty;
        }
        session()->put('cart', $cart);
        return redirect('cart');
    }


    //fungsi ini akan dipanggil apabila user melakukan checkout
    public function Checkout(){

        $cart = Session::get('cart');
        //$total = 0;
        $new = new Order();
        $new->user_id = Auth::user()->id;
        $new->save();

        $order_id = DB::getPdo()->lastInsertId();

        foreach ($cart as $data) {
            $total_harga = $data['price'] * $data['quantity'];
            $qty = $data['quantity'];
            $Orderdet = new OrderDetail();
            $Orderdet->order_id = $order_id;
            $Orderdet->product_id = $data['idprod'];
            $Orderdet->qty = $qty;
            $Orderdet->total_price = $total_harga;
            $Orderdet->save();
        }
        Session::forget('cart');
        return redirect()->route('home');
    }
















}

