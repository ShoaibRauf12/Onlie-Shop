<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\TempImage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_images')->latest();

        if (!empty(request()->get('keyword'))) {
            $products = $products->where('name', 'like', '%' . request()->get('keyword') . '%');
        }

        $products = $products->paginate(5);
        return view('admin.product.product', [
            'products' => $products,
        ]);
    }

    public function product_form()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();


        return view('admin.product.product-form', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
    public function product_sub_category(Request $request)
    {
        $sub_categories = SubCategory::where('category_id', $request->category_id)->latest()->get();
        return Response::json([
            'status' => true,
            'sub_categories' => $sub_categories,
        ]);
    }
    public function create_product(Request $request)
    {

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:products',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'category' => 'required',
            'is_featured' => 'required',
            'track_qty' => 'required',
            'status' => 'required',
        ];
        if (!empty($request->track_qty) &&  $request->track_qty == 'on') {
            $rules['track_quantity'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            if ($request->sub_category) {
                $product->sub_category_id = $request->sub_category;
            }
            if ($request->brand) {
                $product->brand_id = $request->brand;
            }
            if ($request->is_featured == 1) {
                $product->is_featured = 'yes';
            } else {
                $product->is_featured = 'no';
            }
            if ($request->track_qty == 'on') {
                $product->track_qty = 'yes';
                $product->qty = $request->track_quantity;
            } else {
                $product->track_qty = 'no';
            }

            $product->status = $request->status;
            $product->save();

            if (!empty($request->media_id)) {

                foreach ($request->media_id as $item) {

                    $media = TempImage::find($item);
                    $expArray = explode('.', $media->name);
                    $ext = end($expArray);


                    $productMedia = new ProductImage();
                    $productMedia->product_id = $product->id;
                    $productMedia->image = 'NULL';
                    $productMedia->save();

                    $productMedia->image = $media->name;
                    $productMedia->save();
                }
            }

            session()->flash('success', 'Product Created Successfully');
            return Response::json([
                'status' => true,
                'message' => 'Product Created Successfully',
                'redirect_url' => route('admin.product'),
            ]);
        } else {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function product_edit_form($id)
    {
        $product = Product::with('product_images')->find($id);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        return view('admin.product.product-edit-form', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'sub_categories' => $sub_categories,
        ]);
    }
    public function update_product(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $id,
            'sku' => 'required|unique:products,sku,' . $id,
            'price' => 'required|numeric',
            'category' => 'required',
            'is_featured' => 'required',
            'track_qty' => 'required',
            'status' => 'required',
        ];
        if (!empty($request->track_qty) &&  $request->track_qty == 'on') {
            $rules['track_quantity'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            if ($request->sub_category) {
                $product->sub_category_id = $request->sub_category;
            }
            if ($request->brand) {
                $product->brand_id = $request->brand;
            }

            if ($request->is_featured == 1) {
                $product->is_featured = 'yes';
            } else {
                $product->is_featured = 'no';
            }

            if ($request->track_qty == 'on') {
                $product->track_qty = 'yes';
                $product->qty = $request->track_quantity;
            } else {
                $product->track_qty = 'no';
                if (!empty($product)) {
                    unset($product['qty']);
                }
            }
            $product->status = $request->status;
            $product->save();

            
            if (!empty($request->media_id)) {

                $productImages = ProductImage::where('product_id', $product->id)->get();
                foreach ($productImages as $img) {
                    $imagePath = public_path('admin_assets/images/product_images/' . $img->image);
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                    $productImage = ProductImage::find($img->id);
                    $productImage->delete();
                  
                }

                foreach ($request->media_id as $item) {

                    $media = TempImage::find($item);
                    $expArray = explode('.', $media->name);
                    $ext = end($expArray);


                    $productMedia = new ProductImage();
                    $productMedia->product_id = $product->id;
                    $productMedia->image = 'NULL';
                    $productMedia->save();

                    $productMedia->image = $media->name;
                    $productMedia->save();
                }
            }

            session()->flash('success', 'Product Updated Successfully');
            return Response::json([
                'status' => true,
                'message' => 'Product Updated Successfully',
                'redirect_url' => route('admin.product'),
            ]);
        } else {
            return Response::json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
}
