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
use App\Course;
use App\Exam;
use App\PaidUser;

use App\SubCategory;
use Storage;
use DB;
use Hash;



Class HomeController extends Controller
{

	public function index(Request $request){
		$data = [];
		$data['breadcum'] = 'Dashboard';
        $data['title'] = 'Admin Dashboard';



        $data['users'] = User::select('id')->count();
        $data['course'] = Course::select('id')->count();
        $data['exam'] = Exam::select('id')->count();
        $data['paid_user'] = PaidUser::select('id')->count();

       
        
        return view('admin.home.index',$data);
    }

    

    public function profile(Request $request){

      $data = [];
      $method = $request->method();
      $user = Auth::guard('admin')->user();

      if($method == 'post' || $method == 'POST'){
         $request->validate([
            //'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'username' => 'required',
        ]);

     
         $email = isset($request->email) ? $request->email : '';
         $address = isset($request->address) ? $request->address : '';
         $phone = isset($request->phone) ? $request->phone : '';
         $username = isset($request->username) ? $request->username : '';
         $dbArray = [];
        
         $dbArray['email'] = $email; 
         $dbArray['address'] = $address; 
         $dbArray['phone'] = $phone; 
         $dbArray['username'] = $username; 




         $result = Admin::where('id',$user->id)->update($dbArray);



         if($result){

           if($request->hasFile('file')) {
            $file = $request->file('file');
            $image_result = $this->saveImage($file,$user->id,'file');
            if($image_result['success'] == false){     
                session()->flash('alert-danger', 'Image could not be added');
            }
        }


        return back()->with('alert-success','Profile Updated Successfully');
    }else{
        return back()->with('alert-danger','Something Went Wrong');

    }
}

$data['user'] = $user;
return view('admin.profile.index',$data);
}




public function upload(Request $request){
     $data = [];
      $method = $request->method();
      $user = Auth::guard('admin')->user();

      if($method == 'post' || $method == 'POST'){
         $request->validate([
            'file' => 'required',
        ]);
       
           if($request->hasFile('file')) {
            $file = $request->file('file');
            $image_result = $this->saveImage($file,$user->id,'file');
            if($image_result['success'] == false){     
                session()->flash('alert-danger', 'Image could not be added');
            }
        }
        return back()->with('alert-success','Profile Updated Successfully');
    }
}




public function get_sub_cat(Request $request){
      $cat_id = isset($request->cat_id) ? $request->cat_id : '';
         $html = '<option value="" selected disabled>Select Sub Category</option>';
         if(!empty($cat_id)){
            $subcategories = SubCategory::where('cat_id',$cat_id)->get();
            if(!empty($subcategories)){
                foreach($subcategories as $sub_cat){
                    $html.='<option value='.$sub_cat->id.' >'.$sub_cat->name.'</option>';
                }
            }
         }


        echo $html;

}



private function saveImage($file, $id,$type){
        // prd($file); 
        //echo $type; die;

    $result['org_name'] = '';
    $result['file_name'] = '';

    if ($file) 
    {
        $path = 'users/';
        $thumb_path = 'users/thumb/';
        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
        if($uploaded_data['success']){
            $new_image = $uploaded_data['file_name'];

            if(is_numeric($id) && $id > 0){
                $user = Admin::find($id);

                if(!empty($user) && $user->id > 0){

                    $storage = Storage::disk('public');

                    if($type == 'file'){
                        $old_image = $user->image;
                        $user->image = $new_image;
                    }

                    $isUpdated = $user->save();

                    if($isUpdated){

                        if(!empty($old_image) && $storage->exists($path.$old_image)){
                            $storage->delete($path.$old_image);
                        }

                        if(!empty($old_image) && $storage->exists($thumb_path.$old_image)){
                            $storage->delete($thumb_path.$old_image);
                        }
                    }
                }


            }
        }

        if(!empty($uploaded_data))
        {   
            return $uploaded_data;
        }
    }
}


public function setting(Request $request){
    $data =[];  

    $method = $request->method();

    if($method == 'POST' || $method =="post"){

        $dbArray = [];
        $dbArray['refer'] = isset($request->refer) ? $request->refer:'';
        $dbArray['radius'] = isset($request->radius) ? $request->radius:'';
        $dbArray['privacy'] = isset($request->privacy) ? $request->privacy:'';
        $dbArray['terms'] = isset($request->terms) ? $request->terms:'';
        $dbArray['max_count_coupon_redeem'] = isset($request->max_count_coupon_redeem) ? $request->max_count_coupon_redeem:'';

        DB::table('setting')->where('id',1)->update($dbArray);
        $data['settings'] = DB::table('setting')->where('id',1)->first();
        return back()->with('alert-success','Updated Successfully');


    }

    $data['settings'] = DB::table('setting')->where('id',1)->first();

    return view('admin.home.settings',$data);

}















public function change_password(Request $request){
    //prd($request->toArray());
    $data = [];
    $password = isset($request->password) ?  $request->password:'';
    $new_password = isset($request->new_password) ?  $request->new_password:'';
    $method = $request->method();

        //prd($method);
    $auth_user = Auth::guard('admin')->user();
    $admin_id = $auth_user->id;
    if($method == 'POST' || $method =="post"){
        $post_data = $request->all();
        $rules = [];

        $rules['old_password'] = 'required|min:6|max:20';
        $rules['new_password'] = 'required|min:6|max:20';
        $rules['confirm_password'] = 'required|min:6|max:20|same:new_password';

        $validator = Validator::make($post_data, $rules);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        else{
                //prd($request->all());

            $old_password = $post_data['old_password'];

            $user = Admin::where(['id'=>$admin_id])->first();

            $existing_password = (isset($user->password))?$user->password:'';

            $hash_chack = Hash::check($old_password, $user->password);

            if($hash_chack){
                $update_data['password']=bcrypt(trim($post_data['new_password']));

                $is_updated = Admin::where('id', $admin_id)->update($update_data);

                $message = [];

                if($is_updated){

                    $message['alert-success'] = "Password updated successfully.";
                }
                else{
                    $message['alert-danger'] = "something went wrong, please try again later...";
                }

                return back()->with($message);


            }
            else{
                $validator = Validator::make($post_data, []);
                $validator->after(function ($validator) {
                return back()->with('alert-danger','Invalid Password!');

                    //$validator->errors()->add('old_password', 'Invalid Password!');
                });
                    //prd($validator->errors());
                return back()->withErrors($validator)->withInput();
            }
        }
    }



}

// public function profile(Request $request){
//     $data = [];


//     return view('admin.home.profile',$data);
// }






















}