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
use App\Subscription;
use App\UserSubscription;




use App\Influencers;
use App\InfluencersGallery;
use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;



Class SubscriptionController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

        $routeName = CustomHelper::getAdminRouteName();
    }



    public function index(Request $request){
      // $influencers = User::paginate(10);
      // $data['influencers'] = $influencers;
      $data = [];
      return view('admin.subscription.index',$data);
  }



  public function users_list(Request $request){
      $data = [];

      $data['subscriptions'] = Subscription::where('status',1)->get();

      return view('admin.subscription.users_list',$data);
  }

  public function get_user(Request $request){
    $sub_id = isset($request->sub_id) ? $request->sub_id :0;
    $routeName = CustomHelper::getAdminRouteName();
    $datas = UserSubscription::where('is_delete',0)->orderBy('id','desc');

    if($sub_id != 0){
        $datas->where('subscription_id',$sub_id);
    }

    $datas = $datas->get();


    return Datatables::of($datas)


    ->editColumn('id', function(UserSubscription $data) {

        return  $data->id;
    })
    ->editColumn('name', function(UserSubscription $data) {
        $user = User::where('id',$data->user_id)->first();


        return  $user->name ?? '';
    })
    ->editColumn('subscription', function(UserSubscription $data) {
        $subscription = Subscription::where('id',$data->subscription_id)->first();

        return  $subscription->name;
    })
    ->editColumn('start_date', function(UserSubscription $data) {
        return  $data->start_date;


    })
    ->editColumn('end_date', function(UserSubscription $data) {
        return  $data->end_date;


    })
    ->editColumn('status', function(UserSubscription $data) {
     $html ='';

     if($data->status == 1){
        $html = 'Active';
     }else{
        $html = 'InActive';

     }

     return  $html;
 })
    ->editColumn('created_at', function(UserSubscription $data) {
        return  $data->created_at;
    })

  //   ->addColumn('action', function(UserSubscription $data) {

  //     $BackUrl = 'admin/subscription';
  //     return ' <a href="' . route('admin.subscription.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
  //     <a  href="' . route('admin.subscription.delete',$data->id.'?back_url='.$BackUrl) . '"  id="delete_item" onclick="return confirm("Do you really want to remove?");"><i class="fa fa-trash"></i></a>';
  // })

    ->rawColumns(['name', 'status', 'action'])
    ->toJson();



}


public function list(Request $request){

    $routeName = CustomHelper::getAdminRouteName();
    $datas = Subscription::orderBy('id','desc')->where('is_delete',0)->get();

    return Datatables::of($datas)


    ->editColumn('id', function(Subscription $data) {

        return  $data->id;
    })
    ->editColumn('name', function(Subscription $data) {
        return  $data->name;
    })
    ->editColumn('description', function(Subscription $data) {
        $description = mb_strlen(strip_tags($data->description),'utf-8') > 50 ? mb_substr(strip_tags($data->description),0,50,'utf-8').'...' : strip_tags($data->description);

        return  $description;
    })
    ->editColumn('mrp', function(Subscription $data) {
        return  $data->mrp.'/-';


    })
    ->editColumn('price', function(Subscription $data) {
        return  $data->price.'/-';


    })
    ->editColumn('duration', function(Subscription $data) {
        return  $data->duration;


    })
    ->editColumn('status', function(Subscription $data) {
        $sta = '';
        $sta1 ='';
        if($data->status == 1){
            $sta1 = 'selected';
        }else{
            $sta = 'selected';
        }

        $html = "<select id='change_subs_status$data->id' onchange='change_subs_status($data->id)'>
        <option value='1' ".$sta1.">Active</option>
        <option value='0' ".$sta.">InActive</option>
        </select>";




        
        return  $html;
    })
    ->editColumn('created_at', function(Subscription $data) {
        return  $data->created_at;
    })

    ->addColumn('action', function(Subscription $data) {
         // <a  href="' . route('admin.subscription.delete',$data->id.'?back_url='.$BackUrl) . '"  id="delete_item" onclick="return confirm("Do you really want to remove?");"><i class="fa fa-trash"></i></a>
      $BackUrl = 'admin/subscription';

// <a onclick="assign_user('.$data->id.')" title="Assign User"><i class="fa fa-id-card" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
      return '

      <a href="' . route('admin.subscription.assign',$data->id.'?back_url='.$BackUrl) . '" title="Assign User"><i class="fa fa-id-card" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;




      <a href="' . route('admin.subscription.edit',$data->id.'?back_url='.$BackUrl) . '"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
      ';
  })

    ->rawColumns(['name', 'status', 'action'])
    ->toJson();
}




// public function assign_user(Request $request){
//   $sub_id = isset($request->sub_id) ? $request->sub_id :'';
//   $html = ' <select class="form-control select2" id="example3" name="user_ids[]" multiple="multiple">';

//   $users = User::where('status',1)->get();
//   if(!empty($users)){
//     foreach($users as $user){
//         $html.='<option value='.$user->id.'>'.$user->name.'</option>';
//     }
// }
// $html.='</select>';

// echo $html;
// }



public function change_status(Request $request){

    $subid = isset($request->subid) ? $request->subid :'';
    $status = isset($request->status) ? $request->status :'';

    $user = Subscription::where('id',$subid)->first();
    if(!empty($user)){

        Subscription::where('id',$subid)->update(['status'=>$status]);
        $response['success'] = true;
        $response['message'] = 'Status updated';


        return response()->json($response);
    }else{
        $response['success'] = false;
        $response['message'] = 'No Subscription FOund';
        return response()->json($response);
    }




}


public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $subscription = '';
    if(is_numeric($id) && $id > 0){
        $subscription = Subscription::find($id);
        if(empty($subscription)){
            return redirect($this->ADMIN_ROUTE_NAME.'/subscription');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/subscription';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['name'] = 'required';

        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Subscription has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Subscription has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }


    $page_heading = 'Add Subscription';

    if(isset($subscription->name)){
        $users_name = $subscription->name;
        $page_heading = 'Update Subscription - '.$users_name;
    }  

    $data['page_heading'] = $page_heading;
    $data['id'] = $id;
    $data['subscription'] = $subscription;

    return view('admin.subscription.form', $data);

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


    $oldImg = '';

    $subscription = new Subscription;

    if(is_numeric($id) && $id > 0){
        $exist = Subscription::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $subscription = $exist;

            $oldImg = $exist->image;
        }
    }else{
        $data['date'] = date('Y-m-d');
        //prd($oldImg);
    }

    foreach($data as $key=>$val){
        $subscription->$key = $val;
    }

    $isSaved = $subscription->save();

    if($isSaved){
        $this->saveImage($request, $subscription, $oldImg);
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
        $is_delete = Subscription::where('id', $id)->update(array('is_delete'=>1));
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'Subscription has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}


public function assign(Request $request){
   $data = [];

   $sub_id = isset($request->sub_id) ? $request->sub_id :'';
   $method = $request->method();
   if($method =='post' || $method == 'POST'){
    $rules = [];
    $rules['user_ids']='required';




    $this->validate($request,$rules);


    if(!empty($request->user_ids)){
        $user_ids = $request->user_ids;
        foreach ($user_ids as $key => $value) {
            $dbArray = [];

            $dbArray['user_id'] = $value;
            $dbArray['subscription_id'] = $sub_id;
            $dbArray['start_date'] = date('Y-m-d');
            $subscription = Subscription::where('id',$sub_id)->first();

            $dbArray['end_date'] = date('Y-m-d');
            $dbArray['status'] = 1;

            UserSubscription::create($dbArray);



        }
    }


   }





   $user_ids = [];
   $subscribed_user = UserSubscription::where('subscription_id',$sub_id)->where('status',1)->get();
   if(!empty($subscribed_user)){
    foreach($subscribed_user as $sub){
        $user_ids[] = $sub->user_id;
    }
   }

   $users = User::whereNotIn('id',$user_ids)->where('status',1)->get();
   $data['users'] = $users;
   $data['subscribed_users'] = $subscribed_user;
   $data['sub_id'] = $sub_id;


   return view('admin.subscription.assign',$data);
}






}