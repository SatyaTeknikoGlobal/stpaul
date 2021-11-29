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
use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;



Class InfluencersController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

        $routeName = CustomHelper::getAdminRouteName();
    }



    public function index(Request $request){
      $influencers = Influencers::paginate(10);
      $data['influencers'] = $influencers;
      return view('admin.influencer.index',$data);
  }


  public function get_influencer(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $datas = Influencers::orderBy('id','desc')->where('is_delete',0)->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Influencers $data) {

        return  $data->id;
    })
    ->editColumn('name', function(Influencers $data) {
        return  $data->name;
    })
    ->editColumn('image', function(Influencers $data) {
       $storage = Storage::disk('public');
       $path = 'influencer/thumb/';
       $image = $data->image;

       if(!empty($image)){
        if($storage->exists($path.$image))
        { 
            $image = url('public/storage/'.$path.'/'.$image);
        }
    }else{
        $image = url('public/assets/img/noimage.png');

    }
     return $image;


})
    ->editColumn('location', function(Influencers $data) {
        return  $data->location;
    })
    ->editColumn('description', function(Influencers $data) {

        $description = mb_strlen(strip_tags($data->description),'utf-8') > 50 ? mb_substr(strip_tags($data->description),0,50,'utf-8').'...' : strip_tags($data->description);

        return  $description;


    })
    ->editColumn('status', function(Influencers $data) {

        $sta = '';
        $sta1 ='';
        if($data->status == 1){
            $sta1 = 'selected';
        }else{
            $sta = 'selected';
        }

        $html = "<select id='change_user_status$data->id' onchange='change_user_status($data->id)'>
        <option value='1' ".$sta1.">Active</option>
        <option value='0' ".$sta.">InActive</option>
        </select>";




        
        return  $html;
    })
    ->editColumn('created_at', function(Influencers $data) {
        return  $data->created_at;
    })

    ->addColumn('action', function(Influencers $data) {
          $BackUrl = 'admin/influencers';
        return '<a href="' . route('admin.influencers.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a  href="' . route('admin.influencers.delete',$data->id.'?back_url='.$BackUrl) . '"  id="delete_item"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp   <a href="'. route('admin.influencers.gallery', $data->id.'?back_url='.$BackUrl).'"><i class="fa fa-picture-o" aria-hidden="true"></i></a> ';
    })

    ->rawColumns(['name', 'status', 'action'])
    ->toJson();
}




public function change_user_status(Request $request){

    $userid = isset($request->userid) ? $request->userid :'';
    $status = isset($request->status) ? $request->status :'';

    $user = Influencers::where('id',$userid)->first();
    if(!empty($user)){

        Influencers::where('id',$userid)->update(['status'=>$status]);
        $response['success'] = true;
        $response['message'] = 'Status updated';


        return response()->json($response);
    }else{
        $response['success'] = false;
       $response['message'] = 'No User FOund';
       return response()->json($response);
   }


   

}

public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $influencers = '';
    if(is_numeric($id) && $id > 0){
        $influencers = Influencers::find($id);
        if(empty($influencers)){
            return redirect($this->ADMIN_ROUTE_NAME.'/influencers');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/influencers';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['name'] = 'required';



        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Influencers has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Influencers has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Influencers';

    if(isset($influencers->name)){
        $influencers_name = $influencers->name;
        $page_heading = 'Update Influencers - '.$influencers_name;
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['influencer'] = $influencers;

    return view('admin.influencer.form', $data);

}
public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());

    if(!empty($request->password)){
        $data['password'] = bcrypt($request->password);
    }

    $oldImg = '';

    $influencer = new Influencers;

    if(is_numeric($id) && $id > 0){
        $exist = Influencers::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $influencer = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $influencer->$key = $val;
    }

    $isSaved = $influencer->save();

    if($isSaved){
        $this->saveImage($request, $influencer, $oldImg);
    }

    return $isSaved;
}


private function saveImage($request, $influencer, $oldImg=''){

    $file = $request->file('image');
    if ($file) {
        $path = 'influencer/';
        $thumb_path = 'influencer/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

           // prd($uploaded_data);
        if($uploaded_data['success']){

            if(!empty($oldImg)){
                if($storage->exists($path.$oldImg)){
                    $storage->delete($path.$oldImg);
                }
                if($storage->exists($thumb_path.$oldImg)){
                    $storage->delete($thumb_path.$oldImg);
                }
            }

            $image = $uploaded_data['file_name'];

            $influencer->image = $image;
            $influencer->save();         
        }

        if(!empty($uploaded_data)){   
            return $uploaded_data;
        }  

    }

}




public function delete(Request $request){

        //prd($request->toArray());

    $id = (isset($request->id))?$request->id:0;

    $is_delete = '';

    if(is_numeric($id) && $id > 0){
        $is_delete = Influencers::where('id', $id)->update(array('is_delete'=>1));
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'Influencers has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}



/* ajax_delete_image */
public function ajax_delete_image(Request $request){

        // prd($request->toArray());

    $response['success'] = false;

    $id = ($request->has('id'))?$request->id:0;

    if (is_numeric($id) && $id > 0) {
        $testimonial = Influencers::find($id);

        if(isset($testimonial->id) && $testimonial->id == $id){

            $path = 'category/';
            $thumb_path = 'category/thumb/';
            $storage = Storage::disk('public');

            $image = $testimonial->image;

            $isImgDeleted = false;

            if(!empty($image)){
                if($storage->exists($path.$image)){
                    $isImgDeleted = $storage->delete($path.$image);
                }
                if($storage->exists($thumb_path.$image)){
                    $isImgDeleted = $storage->delete($thumb_path.$image);
                }
            }

            if($isImgDeleted){
                $response['success'] = true;
            }
        }

    }

    return response()->json($response);
}



public function gallery(Request $request){

    $method = $request->method();

    $influencer_id = isset($request->id) ? $request->id :'';

    $data = [];


    if($method == 'post' || $method == 'POST'){

        $rules = [];
        $rules['image'] = 'required';

        $this->validate($request,$rules);

        if($request->hasFile('image')) {

            $image_result = $this->saveImageMultiple($request,$influencer_id);
            if($image_result){
                return back()->with('alert-success', 'Image uploaded successfully.');

            }
        }


    }

    $influencer = Influencers::where('id',$influencer_id)->first();
    $influencer_gallery = InfluencersGallery::where('influencer_id',$influencer_id)->get();
    $data['influencer'] = $influencer;
    $data['influencer_gallery'] = $influencer_gallery;

    return view('admin.influencer.gallery',$data);


}




private function saveImageMultiple($request,$influencer_id){

    $files = $request->file('image');
    $path = 'influencer_gallery/';
    $thumb_path = 'influencer_gallery/thumb/';
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
                $dbArray['influencer_id'] = $influencer_id;
                $dbArray['status'] = 1;
                $success = InfluencersGallery::create($dbArray);
            }
        }
        return true;
    }else{
        return false;
    }
}



public function gallerydelete(Request $request){
    $id = isset($request->id) ? $request->id :'';

    $getgallery = InfluencersGallery::where('id',$id)->first();
    $path = 'influencer_gallery/';
    $thumb_path = 'influencer_gallery/thumb/';
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
        $success = InfluencersGallery::where('id',$id)->delete();
        if($success){
            return back()->with('alert-success', 'Image Deleted successfully.');

        }else{
            return back()->with('alert-danger', 'Image Not delete');

        }
    }



}





}