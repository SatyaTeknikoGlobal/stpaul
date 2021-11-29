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
// use App\SubCategory;
// use App\Influencers;
// use App\InfluencersGallery;
// use App\EventGallery;
// use App\EventQuestion;
// use App\EventQuestionAnswer;
// use App\Event;
// use App\EventSubscription;
// use App\EventUser;
// use App\EventChat;
use App\Course;
use Yajra\DataTables\DataTables;


use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;




use Storage;
use DB;
use Hash;



Class CourseController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }



    public function index(Request $request){
     $data = [];
     return view('admin.course.index',$data);
 }


 public function get_course(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $datas = Course::where('is_delete',0)->orderBy('id','desc')->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Course $data) {

        return  $data->id;
    })
    ->editColumn('title', function(Course $data) {
        return  $data->name;
    })
    ->editColumn('image', function(Course $data) {
     $storage = Storage::disk('public');
     $path = 'course/thumb/';
     $image = $data->image;
        $imageUrl = url('public/assets/img/noimage.png');

     if(!empty($image)){
        if($storage->exists($path.$image))
        { 
            //$imageUrl = url('public/storage/'.$path.'/'.$image);
            $imageUrl = url('storage/app/public/'.$path.'/'.$image);

        }else{
        $imageUrl = url('public/assets/img/noimage.png');

    }
    }else{
        $imageUrl = url('public/assets/img/noimage.png');
        
    }

    return '<img src='.$imageUrl.' height="50px" width="50px">';


})

    ->editColumn('status', function(Course $data) {
       $sta = '';
       $sta1 ='';
       if($data->status == 1){
        $sta1 = 'selected';
    }else{
        $sta = 'selected';
    }

    $html = "<select id='change_status$data->id' onchange='change_status($data->id)'>
    <option value='1' ".$sta1.">Active</option>
    <option value='0' ".$sta.">InActive</option>
    </select>";





    return  $html;
})
    ->editColumn('created_at', function(Course $data) {
        return  date('d M Y',strtotime($data->created_at));
    })

    ->addColumn('action', function(Course $data) {

      $routeName = CustomHelper::getAdminRouteName();

        $BackUrl = $routeName.'/course';


      return '<a title="Edit" href="' . route($routeName.'.course.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp;&nbsp;<a title="Delete" href="' . route($routeName.'.course.delete',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit">Delete</i></a>&nbsp;&nbsp;&nbsp;';
  })

    ->rawColumns(['name', 'status', 'action','image'])
    ->toJson();
}





public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $course = '';
    if(is_numeric($id) && $id > 0){
        $course = Course::find($id);
        if(empty($course)){
            return redirect($this->ADMIN_ROUTE_NAME.'/course');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/course';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['name'] = 'required';
        


        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Course has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Course has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Course';

    if(isset($course->name)){
        $course_name = $course->name;
        $page_heading = 'Update Course - '.$course_name;
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['courses'] = $course;
    return view('admin.course.form', $data);

}




public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());

    $oldImg = '';

    $course = new Course;

    if(is_numeric($id) && $id > 0){
        $exist = Course::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $course = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $course->$key = $val;
    }

    $isSaved = $course->save();

    if($isSaved){
        $this->saveImage($request, $course, $oldImg);
    }

    return $isSaved;
}


private function saveImage($request, $course, $oldImg=''){

    $file = $request->file('image');
    if ($file) {
        $path = 'course/';
        $thumb_path = 'course/thumb/';
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

            $course->image = $image;
            $course->save();         
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
        $is_delete = Course::where('id', $id)->update(['is_delete'=>1]);
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'events has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}


public function change_status(Request $request){
  $course_id = isset($request->course_id) ? $request->course_id :'';
  $status = isset($request->status) ? $request->status :'';
  $users = Course::where('id',$course_id)->first();
  if(!empty($users)){
   Course::where('id',$course_id)->update(['status'=>$status]);
   $response['success'] = true;
   $response['message'] = 'Status updated';
   return response()->json($response);
}else{
   $response['success'] = false;
   $response['message'] = 'Not Found';
   return response()->json($response);
}
}





/* ajax_delete_image */
public function ajax_delete_image(Request $request){

        // prd($request->toArray());

    $response['success'] = false;

    $id = ($request->has('id'))?$request->id:0;

    if (is_numeric($id) && $id > 0) {
        $testimonial = Event::find($id);

        if(isset($testimonial->id) && $testimonial->id == $id){

            $path = 'events/';
            $thumb_path = 'events/thumb/';
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






}