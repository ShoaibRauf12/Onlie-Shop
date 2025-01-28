<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request){
        $category = Category::latest();

        if(!empty($request->get('keyword'))){
            $category = $category->where('name','like','%'.$request->get('keyword').'%');
        }

        $category = $category->paginate(5);
        return view('admin.category.category')->with('categories',$category);
    }
    
    public function category_form(){
        return view('admin.category.category-create');
    }

    public function create_category(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'status' => 'required',
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $result = $category->save();
            if($result){
                session()->flash('success','Created Successfully.');
                return Response::json(['status'=>true,'message'=>'Created Successfully.','redirect_url'=> route('admin.category')]);
            }
        }else{
            return Response::json(['status'=>false,'errors'=> $validator->errors()]);
        }

        
    }
    
    public function update_category(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $result = $category->update();
        if($result){
            session()->flash('success','Update Successfully.');
            return redirect()->route('admin.category');
        }else{
            session()->flash('error','record Not Updated.');
            return redirect()->route('admin.category');
        }
    }
    public function delete_category($id){
        $category = Category::findOrFail($id);
        $result = $category->delete();
        if($result){
            session()->flash('success','Deleted Successfully.');
            return redirect()->route('admin.category');
        }else{
            session()->flash('error','record Not Deleted.');
            return redirect()->route('admin.category');
        }
    }
}
