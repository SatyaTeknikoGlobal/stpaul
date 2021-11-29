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
use App\EventGallery;
use App\Event;
use App\Banner;



use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;



Class BannerController extends Controller
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
        $rules['type'] = 'required';

        $this->validate($request,$rules);

        if($request->hasFile('image')) {

            $image_result = $this->saveImageMultiple($request);
            if($image_result){
                return back()->with('alert-success', 'Image uploaded successfully.');

            }
        }


    }

    $banner = Banner::get();
   
    $data['banners'] = $banner;

    return view('admin.banner.index',$data);


}

private function saveImageMultiple($request){

    $files = $request->file('image');
    $path = 'banner/';
    $thumb_path = 'banner/thumb/';
    $storage = Storage::disk('public');
            //prd($storage);
    $IMG_WIDTH = 2000;
    $IMG_HEIGHT = 1333;
    $THUMB_WIDTH = 1000;
    $THUMB_HEIGHT = 700;
    $dbArray = [];

    if (!empty($files)) {

        foreach($files as $file){
            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
            if($uploaded_data['success']){
                $image = $uploaded_data['file_name'];
                $dbArray['banner'] = $image;
                $dbArray['type'] = $request->type;
               
                $dbArray['status'] = 1;
                $success = Banner::create($dbArray);
            }
        }
        return true;
    }else{
        return false;
    }
}


public function delete(Request $request){
    $id = isset($request->id) ? $request->id :'';

    $getgallery = Banner::where('id',$id)->first();
    $path = 'banner/';
    $thumb_path = 'banner/thumb/';
    $storage = Storage::disk('public');
    $isImgDeleted =true;
    if(!empty($getgallery->banner)){
        $image = $getgallery->banner;
        if($storage->exists($path.$image)){
            $isImgDeleted = $storage->delete($path.$image);
        }
        if($storage->exists($thumb_path.$image)){
            $isImgDeleted = $storage->delete($thumb_path.$image);
        }

    }
    if($isImgDeleted){
        $success = Banner::where('id',$id)->delete();
        if($success){
            return back()->with('alert-success', 'Image Deleted successfully.');

        }else{
            return back()->with('alert-danger', 'Image Not delete');

        }
    }



}




}