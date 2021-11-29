<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;
use App\Admin;
use App\Category;
use App\SubCategory;
use App\Influencers;
use App\InfluencersGallery;
use App\Gallery;
use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;



Class GalleryController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }

public function index(Request $request){

    $method = $request->method();

    $data = [];


    if($method == 'post' || $method == 'POST'){

        $rules = [];
        $rules['image'] = 'required';

        $this->validate($request,$rules);

        if($request->hasFile('image')) {

            $image_result = $this->saveImageMultiple($request);
            if($image_result){
                return back()->with('alert-success', 'Image uploaded successfully.');

            }
        }


    }

    $galleries = Gallery::get();
   
    $data['galleries'] = $galleries;

    return view('admin.galleries.index',$data);


}

private function saveImageMultiple($request){

    $files = $request->file('image');
    $path = 'galleries/';
    $thumb_path = 'galleries/thumb/';
    $storage = Storage::disk('public');
            //prd($storage);
    $IMG_WIDTH = 768;
    $IMG_HEIGHT = 768;
    $THUMB_WIDTH = 336;
    $THUMB_HEIGHT = 336;
    $dbArray = [];

    if (!empty($files)) {

        foreach($files as $file){
            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
            if($uploaded_data['success']){
                $image = $uploaded_data['file_name'];
                $dbArray['image'] = $image;
               
                $dbArray['status'] = 1;
                $success = Gallery::create($dbArray);
            }
        }
        return true;
    }else{
        return false;
    }
}


public function delete(Request $request){
    $id = isset($request->id) ? $request->id :'';

    $getgallery = Gallery::where('id',$id)->first();
    $path = 'galleries/';
    $thumb_path = 'galleries/thumb/';
    $storage = Storage::disk('public');

    if(!empty($getgallery->image)){
        $image = $getgallery->image;
        if($storage->exists($path.$image)){
            $isImgDeleted = $storage->delete($path.$image);
        }
        if($storage->exists($thumb_path.$image)){
            $isImgDeleted = $storage->delete($thumb_path.$image);
        }

    }

    if($isImgDeleted){
        $success = Gallery::where('id',$id)->delete();
        if($success){
            return back()->with('alert-success', 'Image Deleted successfully.');

        }else{
            return back()->with('alert-danger', 'Image Not delete');

        }
    }



}








}
