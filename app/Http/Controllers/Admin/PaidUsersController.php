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
use App\PaidUser;
use App\Exam;
use App\InfluencersGallery;
use Yajra\DataTables\DataTables;
use App\Exports\UserExport;

use Maatwebsite\Excel\Facades\Excel;

use Storage;
use DB;
use Hash;



Class PaidUsersController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

        $routeName = CustomHelper::getAdminRouteName();
    }



    public function index(Request $request){
      $data = [];
      $method = $request->method();
      if($method == 'post' || $method == 'POST'){
        $rules = [];
        $rules['exam_id'] = 'required';
        $rules['user_ids'] = 'required';

        $this->validate($request, $rules);
        $user_ids = $request->user_ids;

        $exam = Exam::where('id',$request->exam_id)->first();
        if(!empty($user_ids)){
            foreach ($user_ids as $key => $value) {
                $dbArray = [] ;
                $dbArray['exam_id'] = $request->exam_id;
                $dbArray['amount'] = $exam->amount;
                $dbArray['transaction_id'] = 'admin_added';
                $dbArray['exam_id'] = $request->exam_id;
                $dbArray['user_id'] = $value;
                $dbArray['status'] = 1;
                PaidUser::create($dbArray);
            }

        }




      }





      $data['exams'] = Exam::get();

      $users = User::select('id','name','email','phone')->where('status',1)->get();
      $data['users'] = $users;



      return view('admin.paid_users.index',$data);
  }


  public function get_paid_users(Request $request){
    $exam_id = isset($request->exam_id) ? $request->exam_id :0;
    $routeName = CustomHelper::getAdminRouteName();
    $datas = PaidUser::orderBy('id','desc');


    if($exam_id != 0){
        $datas->where('exam_id',$exam_id);
    }



    $datas = $datas->get();

    return Datatables::of($datas)


    ->editColumn('id', function(PaidUser $data) {

        return  $data->id;
    })
    ->editColumn('name', function(PaidUser $data) {

        $user = User::where('id',$data->user_id)->first();

        return  $user->name ??'';
    })

     ->editColumn('exam_name', function(PaidUser $data) {
        $exam = Exam::where('id',$data->exam_id)->first();
        
        return  $exam->title ??'';
    })


    ->editColumn('email', function(PaidUser $data) {
        $user = User::where('id',$data->user_id)->first();

        return  $user->email ??'';
    })
    ->editColumn('phone', function(PaidUser $data) {
        $user = User::where('id',$data->user_id)->first();

        return  $user->phone ??'';
    })
    ->editColumn('created_at', function(PaidUser $data) {
        return  date('d F Y',strtotime($data->created_at));
    })

    ->rawColumns(['name', 'status', 'action'])
    ->toJson();
}


public function change_status(Request $request){

    $userid = isset($request->userid) ? $request->userid :'';
    $status = isset($request->status) ? $request->status :'';

    $user = User::where('id',$userid)->first();
    if(!empty($user)){

        User::where('id',$userid)->update(['status'=>$status]);
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

    $users = '';
    if(is_numeric($id) && $id > 0){
        $users = User::find($id);
        if(empty($users)){
            return redirect($this->ADMIN_ROUTE_NAME.'/users');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/users';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['name'] = 'required';
        $rules['email'] = 'required|email|unique:users,email';
        $rules['phone'] = 'required|unique:users,phone';
        $rules['password'] = 'required';
        $rules['status'] = 'required';
     



        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'users has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'users has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add User';

    if(isset($users->name)){
        $users_name = $users->name;
        $page_heading = 'Update User - '.$users_name;
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['user'] = $users;

    return view('admin.users.form', $data);

}


 public function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());


    if(!empty($request->password)){
        $data['password'] = bcrypt($request->password);
    }

    $data['referral_code'] = $this->generateRandomString();


    $oldImg = '';

    $influencer = new User;

    if(is_numeric($id) && $id > 0){
        $exist = User::find($id);

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
        $path = 'users/';
        $thumb_path = 'users/thumb/';
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
        $is_delete = User::where('id', $id)->update(array('is_delete'=>1));
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'User has been deleted successfully.');
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
        $testimonial = User::find($id);

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

public function export(Request $request){

    $paidusers = PaidUser::get();
     if(!empty($paidusers) && $paidusers->count() > 0){
            foreach($paidusers as $user){

                $users = User::where('id',$user->user_id)->first();
                $exam = Exam::where('id',$user->exam_id)->first();

                $userArr = [];

                $userArr['id'] = $user->id;
                $userArr['Exam Name'] = $exam->title;
                $userArr['User Name'] = $users->name;
                $userArr['Email'] = $users->email;
                $userArr['Phone'] = $users->phone;
                $userArr['Amount'] = $user->amount;
                $userArr['Transaction Id'] = $user->transaction_id;
                $userArr['Created At'] = $user->created_at->toDateTimeString();
                $userArr['Updated At'] = $user->updated_at->toDateTimeString();

                // for($i=0; $i<=9; $i++){
                //     $productArr['attribute_'.($i+1)] = (isset($productAttributes[$i]->value))?$productAttributes[$i]->value:'';
                // }

                $exportArr[] = $userArr;
            }
        }

          $filedNames = array_keys($exportArr[0]);

        //prd($filedNames);

        $fileName = 'users_'.date('Y-m-d-H-i-s').'.xlsx';

        return Excel::download(new UserExport($exportArr, $filedNames), $fileName);




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