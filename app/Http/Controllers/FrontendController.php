<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
class FrontendController extends Controller
{
    public function index(){

       $featuredProduct =  Product::where('is_featured','yes')->where('status',1)->get();
       $products = Product::orderBy('id','desc')->where('status',1)->get();
       $brands = Brand::orderBy('id','desc')->where('status',1)->get();
        return view('frontend.home',[
            'featured_products' => $featuredProduct,
            'products' => $products,
            'brands' => $brands
        ]);

    }

    public function shop(Request $request){
            
        $categories = Category::orderBy('name','asc')->where('status',1)->get();
        $brands = Brand::orderBy('name','asc')->where('status',1)->get();
        $products = Product::orderBy('id','DESC')->where('status',1);
        if(!empty($request->categories)){
            $products = $products->whereIn('category_id',$request->categories);
        }
        $products = $products->paginate(9);
        
        return view('frontend.shop',[
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }
}
