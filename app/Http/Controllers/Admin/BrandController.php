<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {

        $brand = Brand::latest();
        if (!empty($request->get('keyword'))) {
            $brand = $brand->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $brand = $brand->paginate(5);
        return view('admin.brand.brand')->with('brands', $brand);
    }
    public function brand_form()
    {
        return view('admin.brand.brand-form');
    }
    public function create_brand(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $result = $brand->save();
            if($result){
                session()->flash('success', 'Created Successfully.');
                return  Response::json([
                    'status' => true,
                    'message' => 'Brand Created Successfully',
                    'redirect_url' => route('admin.brand')
                ]);
            }
        }else{
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }
    public function brand_edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brand-edit',compact('brand'));
    }

    public function update_brand(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$id,
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $result = $brand->save();
            if($result){
                session()->flash('success', 'Updated Successfully.');
                return  Response::json([
                    'status' => true,
                    'message' => 'Brand Updated Successfully',
                    'redirect_url' => route('admin.brand')
                ]);
            }
        }else{
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }
    public function delete_brand($id)
    {
        $brand = Brand::findOrFail($id);
        $result = $brand->delete();
        if($result){
            session()->flash('success', 'deleted Successfully.');
            return Response::json([
                'status' => true,
                'message' => 'Brand Deleted Successfully',
                'redirect_url' => route('admin.brand')
                ]);
        }else{
            session()->flash('error', 'record Not Deleted.');
            return Response::json(['status' => false, 'message' => 'Brand Not Deleted']);
        }
    }
}
