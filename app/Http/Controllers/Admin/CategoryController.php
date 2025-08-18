<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::latest();

        if (!empty($request->get('keyword'))) {
            $category = $category->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $category = $category->paginate(5);
        return view('admin.category.category')->with('categories', $category);
    }

    public function category_form()
    {
        return view('admin.category.category-create');
    }

    public function create_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            //// Imge save 
            if (!empty($request->image_id)) {
                $tempImage = TempImage::findOrFail($request->image_id);
                $file_ext = explode('.', $tempImage->name);
                $ext = $file_ext[1];

                $newFileName = $category->id . '.' . $ext;
                $spath = public_path() . '/admin_assets/images/temp_path/' . $tempImage->name;
                $dpath = public_path() . '/admin_assets/images/category_images/' . $newFileName;

                if (File::exists($spath)) {

                    File::copy($spath, $dpath);
                }

                /////////// Generate Image Thumbnail
                $dpath = public_path() . '/admin_assets/images/category_images/thumb/' . $newFileName;
                $image_resize = ImageManager::imagick()->read($spath);
                $image_resize->cover(200, 200);
                $image_resize->save($dpath);
            }
            $category->image = $newFileName;
            $result = $category->save();

            if ($result) {
                session()->flash('success', 'Created Successfully.');
                return Response::json(['status' => true, 'message' => 'Created Successfully.', 'redirect_url' => route('admin.category')]);
            }
        } else {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category-edit', ['category' => $category]);
    }
    public function update_category(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
            'status' => 'required',
        ]);


        if ($validator->passes()) {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $result = $category->update();

            //// Imge save 
            if (!empty($request->image_id)) {
                $tempImage = TempImage::findOrFail($request->image_id);
                $file_ext = explode('.', $tempImage->name);
                $ext = $file_ext[1];

                $newFileName = $category->id .'-'. time() .  '.' . $ext;
                $spath = public_path() . '/admin_assets/images/temp_path/' . $tempImage->name;
                $dpath = public_path() . '/admin_assets/images/category_images/' . $newFileName;

                if (File::exists($spath)) {

                    File::copy($spath, $dpath);
                }

                /////////// Generate Image Thumbnail
                $dpath = public_path() . '/admin_assets/images/category_images/thumb/' . $newFileName;
                $image_resize = ImageManager::imagick()->read($spath);
                $image_resize->cover(200, 200);
                $image_resize->save($dpath);
            }

            if(!empty($category->image)){
                File::delete(public_path() . '/admin_assets/images/category_images/thumb/'. $category->image);
                File::delete(public_path() . '/admin_assets/images/category_images/'. $category->image);
            }

            $category->image = $newFileName;
            $result = $category->save();

            if ($result) {
                session()->flash('success', 'Update Successfully.');
                return Response::json([
                    'status' =>  true,
                    'message' => 'Update Successfully',
                    'redirect_url' => route('admin.category')
                ]);
            }
        } else {
            return Response::json(['status' => false, 'errors' => $validator->errors()]);
        }
    }
    public function delete_category($id)
    {
        $category = Category::findOrFail($id);

        File::delete(public_path() . '/admin_assets/images/category_images/thumb/'. $category->image);
        File::delete(public_path() . '/admin_assets/images/category_images/'. $category->image);

        $result = $category->delete();
        if ($result) {
            session()->flash('success', 'deleted Successfully.');
            return Response::json([
                'status' =>  true,
                'message' => 'Deleted Successfully',
                'redirect_url' => route('admin.category')
            ]);
        } else {
            session()->flash('error', 'record Not Deleted.');
            return Response::json(['status' => false, 'errors' => 'Record Not deleted.']);
        }
    }
}
