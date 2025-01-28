<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
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
        Route::post('category/update/{id}',[CategoryController::class,'update_category'])->name('admin.category.edit');
        Route::get('category/delete/{id}',[CategoryController::class,'delete_category'])->name('admin.category.delete');

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
