<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::orderBy('id','desc')->paginate(5);
        return view('admin.category.category')->with('categories',$category);
    }

    public function create_category(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $result = $category->save();
        if($result){
            session()->flash('success','Created Successfully.');
            return redirect()->route('admin.category');
        }else{
            session()->flash('error','record Not insert.');
            return redirect()->route('admin.category');
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
