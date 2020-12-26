<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    //
    public function addcategory(){
        $auth = Auth::check();
        return view('admin.addCategory', ['auth'=>true]);
    }
    public function product(){
        $categories = category::all();

        return view('admin.listProduct', ['categories' => $categories]);
    }
    public function category($id=null){
        $categories = category::all();
        $products = category::find($id);
        //echo $id;
        return view('admin.listcategory', ['categories' => $categories, 'products' => $products]);
    }
    public function addprod(){
        $categories = category::all();

        return view('admin.addproduct', ['categories' => $categories]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:App\Category,name'
        ]);


        $category = new Category;

        $category->name = $request->name;

        $category->save();

        return redirect('admin');
    }

}
