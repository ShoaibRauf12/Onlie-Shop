<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TempImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware'=>'admin.guest'],function(){

        Route::get('/',[AdminController::class,'index'])->name('admin.login');
        Route::post('auth',[AdminController::class,'authenticator'])->name('admin.authenticator');

    });

    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('dahboard',[HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('logout',[HomeController::class, 'logout'])->name('admin.logout');
        
        // Categories

        Route::get('category',[CategoryController::class,'index'])->name('admin.category');
        Route::get('category-form',[CategoryController::class,'category_form'])->name('admin.category.form');
        Route::post('category/create',[CategoryController::class,'create_category'])->name('admin.category.add');
        Route::get('category-edit/{id}',[CategoryController::class,'category_edit'])->name('admin.category-edit-form');
        Route::post('category/update/{id}',[CategoryController::class,'update_category'])->name('admin.category.edit');
        Route::post('category-image-upload',[TempImageController::class,'category_image_upload'])->name('admin.category.image.upload');
        Route::delete('category/delete/{id}',[CategoryController::class,'delete_category'])->name('admin.category.delete');

        // Sub Categories
        Route::get('sub-category',[SubCategoryController::class,'index'])->name('admin.sub-category');
        Route::get('subcategory-form',[SubCategoryController::class,'sub_category_form'])->name('admin.sub-category.form');
        Route::post('sub-category/create',[SubCategoryController::class,'create_sub_category'])->name('admin.sub-category.add');
        Route::get('sub-category-edit/{id}',[SubCategoryController::class,'sub_category_edit'])->name('admin.sub-category-edit-form');
        Route::post('sub-category/update/{id}',[SubCategoryController::class,'update_sub_category'])->name('admin.sub-category.update');
        Route::delete('sub-category/delete/{id}',[SubCategoryController::class,'delete_sub_category'])->name('admin.sub-category.delete');


        // Brands
        Route::get('brand',[BrandController::class,'index'])->name('admin.brand');
        Route::get('brand-form',[BrandController::class,'brand_form'])->name('admin.brand.form');
        Route::post('brand/create',[BrandController::class,'create_brand'])->name('admin.brand.add');
        Route::get('brand-edit/{id}',[BrandController::class,'brand_edit'])->name('admin.brand-edit-form');
        Route::post('brand/update/{id}',[BrandController::class,'update_brand'])->name('admin.brand.update');
        Route::delete('brand/delete/{id}',[BrandController::class,'delete_brand'])->name('admin.brand.delete');

        // Products
        Route::post('product/image-upload',[TempImageController::class,'product_image_upload'])->name('admin.product.image.upload');
        Route::controller(ProductController::class)->group(function(){
            Route::get('product','index')->name('admin.product');
            Route::get('product-form','product_form')->name('admin.product.form');
            Route::post('product-sub-category','product_sub_category')->name('admin.product.subcategory');
            Route::post('product/create','create_product')->name('admin.product.add');
            Route::get('product-edit/{id}','product_edit_form')->name('admin.product-edit-form');
        });

        Route::get('getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return Response::json([
                'success' => true,
                'slug' => $slug
            ]);
            die;
        })->name('admin.getSlug');
        
    });
});
