<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempImage;
class TempImageController extends Controller
{
    public function category_image_upload(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('admin_assets/images/temp_path'), $imageName);
        }
        $model = new TempImage();
        $model->name = $imageName;
        $result = $model->save();
        if($result){
            return response()->json([
                'success' => true,
                'image_id' => $model->id,
                'message' => 'Image Uploaded Successfully',
            ]);
        }
    }
}
