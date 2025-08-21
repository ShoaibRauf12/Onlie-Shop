<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class FrontendController extends Controller
{
    public function index(){

       $featuredProduct =  Product::where('is_featured','yes')->where('status',1)->get();
        return view('frontend.home',[
            'featured_products' => $featuredProduct,
        ]);
    }
}
