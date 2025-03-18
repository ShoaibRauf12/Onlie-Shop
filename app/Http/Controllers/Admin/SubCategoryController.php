<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index(){
        return view('admin.sub_category.sub-category');
    }

    public function sub_category_form(){
        $categories = Category::all();
        return view('admin.sub_category.sub-category-create',['categories'=>$categories]);
    }
    public function create_sub_category(Request $request){
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $sub_category = new SubCategory();
            $sub_category->category_id = $request->category;
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $result = $sub_category->save();

            if ($result) {
                session()->flash('success', 'Created Successfully.');
                return Response::json(['status' => true, 'message' => 'Created Successfully.', 'redirect_url' => route('admin.sub-category')]);
            }
        }else {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }

    }

}
