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
    public function index(Request $request)
    {
        $sub_category = SubCategory::with('category')->latest('id');

        if (!empty($request->get('keyword'))) {
            $sub_category = $sub_category->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $sub_category = $sub_category->paginate(5);
        return view('admin.sub_category.sub-category')->with('sub_categories', $sub_category);
    }

    public function sub_category_form()
    {
        $categories = Category::all();
        return view('admin.sub_category.sub-category-create', ['categories' => $categories]);
    }
    public function create_sub_category(Request $request)
    {
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
            $sub_category->showHome = $request->showHome;
            $result = $sub_category->save();

            if ($result) {
                session()->flash('success', 'Created Successfully.');
                return Response::json(['status' => true, 'message' => 'Created Successfully.', 'redirect_url' => route('admin.sub-category')]);
            }
        } else {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }
    public function sub_category_edit($id)
    {
        $categories = Category::all();
        $sub_category = SubCategory::findOrFail($id);
        return view(
            'admin.sub_category.sub-category-edit',
            [
                'categories' => $categories,
                'sub_category' => $sub_category,
            ]
        );
    }
    public function update_sub_category(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $id,
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $sub_category = SubCategory::findOrFail($id);
            $sub_category->category_id = $request->category;
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $sub_category->showHome = $request->showHome;
            $result = $sub_category->save();

            if ($result) {
                session()->flash('success', 'Updated Successfully.');
                return Response::json(['status' => true, 'message' => 'Updated Successfully.', 'redirect_url' => route('admin.sub-category')]);
            }
        } else {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }
    public function delete_sub_category($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $result = $sub_category->delete();
        if ($result) {
            session()->flash('success', 'Deleted Successfully.');
            return Response::json(['status' => true, 'message' => 'Deleted Successfully.','redirect_url' => route('admin.sub-category')]);
        }
    }
}
