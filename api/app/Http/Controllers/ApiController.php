<?php

namespace App\Http\Controllers;

use JWTAuth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\support\str;

use App\User;
use App\AppVersion;
use App\UserLogin;
use App\UserOtp;
use App\Category;
use App\Banner;
use App\Product;
use App\Cart;
use App\Wishlist;
use App\Designer;
use App\Coupon;
use App\Brand;
use App\Order;
use App\Influencers;
use App\Gallery;
use App\Events;
use App\EventGallery;
use App\EventQuestion;
use App\Subscription;
use App\EventQuestionAnswer;
use App\WalletHistory;
use App\InfluencersGallery;
use App\EventChat;
use Mail;
use Storage;



class ApiController extends Controller
{


 public function __construct()
 {
    $this->user = new User;
    date_default_timezone_set("Asia/Kolkata");  
    $this->url = env('BASE_URL');
}







                    //============================= Fans Studio API ==================================//

public function app_version(){
    $app_version = AppVersion::first();
    return response()->json([
        'result' => 'success',
        'message' => '',
        'version' => $app_version,
    ],200);
}


public static function sendEmail($viewPath, $viewData, $to, $from, $replyTo, $subject, $params=array()){

    try{

        Mail::send(
            $viewPath,
            $viewData,
            function($message) use ($to, $from, $replyTo, $subject, $params) {
                $attachment = (isset($params['attachment']))?$params['attachment']:'';

                if(!empty($replyTo)){
                    $message->replyTo($replyTo);
                }

                if(!empty($from)){
                    $message->from($from);
                }

                if(!empty($attachment)){
                    $message->attach($attachment);
                }

                $message->to($to);
                $message->subject($subject);

            }
        );
    }
    catch(\Exception $e){
            // Never reached
    }

    if( count(Mail::failures()) > 0 ) {
        return false;
    }       
    else {
        return true;
    }

}






private function send_message($mobile,$message)
{
    $sender = "CITRUS";
    $message = urlencode($message);
    $msg = "sender=".$sender."&route=4&country=91&message=".$message."&mobiles=".$mobile."&authkey=284738AIuEZXRVCDfj5d26feae";

    $ch = curl_init('http://api.msg91.com/api/sendhttp.php?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
                        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    $result = curl_close($ch);
    return $res;
}


public function send_otp(Request $request)
{
   $validator =  Validator::make($request->all(), [
    'mobile' => 'required_without:email',
    'email' => 'required_without:mobile',

]);

   $status = 'new';

   if ($validator->fails()) {

    return response()->json([
        'result' => 'failure',
        'otp'=> '',
        'message' => json_encode($validator->errors()),

    ],400);
}
//$otp = rand(100000,999999);
// $otp = rand(1111,9999);

$otp = 1234;

$message = $otp." is your authentication Code to register.";
$mobile = $request['mobile'];
$time = date("Y-m-d H:i:s",strtotime('15 minutes'));

if(!empty($request->mobile)){
    // $this->send_message($mobile,$message);
    UserOtp::updateOrcreate([
        'mobile'=>$mobile],[
            'otp'=>$otp,
            'timestamp'=>$time,
        ]);

}
if(!empty($request->email)){
    $email = $request->email;
    $subject = 'OTP Varification From FansStudio';
    $fromEmail = 'fansstudio@gmail.com';
    $toEmail = $email;
    $data['otp'] = $otp;
    $success = $this->sendEmail('send_otp',$data, $toEmail, $fromEmail,$fromEmail, $subject);
    if($success){
        UserOtp::updateOrcreate([
            'email'=>$email],[
                'otp'=>$otp,
                'timestamp'=>$time,
            ]);

    }
}

return response()->json([
    'result' => 'success',
    'message' => 'SMS Sent SuccessFully',
    //'status' =>$status,
    'otp'=>$otp,
],200);
}

public function verify_otp(Request $request){
 $validator =  Validator::make($request->all(), [
   //'mobile' => 'required',
    'mobile' => 'required_without:email',
    'email' => 'required_without:mobile',
    'otp'=>'required',

]);

 if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',

        'message' => json_encode($validator->errors()),

    ],400);
}

$mobile = isset($request->mobile) ? $request->mobile :'';
$email = isset($request->email) ? $request->email :'';
$otp = isset($request->otp) ? $request->otp :'';

if(!empty($mobile)){
    $verify_otp  = UserOtp::where(['mobile'=>$mobile,'otp'=>$otp])->first();
}if(!empty($email)){
  $verify_otp  = UserOtp::where(['email'=>$email,'otp'=>$otp])->first();
}

if(!empty($verify_otp)){
 return response()->json([
    'result' => 'success',
    'message' => 'OTP Varified SuccessFully',
],200);

}else{
    return response()->json([
        'result' => 'failure',
        'message' => 'OTP Not Varified',
    ],200);

}



}

public function social_login(Request $request){
   $validator =  Validator::make($request->all(), [
    'username' => 'required',
    'deviceID' => 'required',
    'deviceToken' => 'required',
    'deviceType' => 'required',
]);
   $user = null;
   $status = 'new';
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'token' => null,
        'status' =>$status,
        'message' => json_encode($validator->errors()),
        'user'=>$user
    ],400);
}

$token = null;
$user = User::orWhere('email',$request->only('username'))->first();
if(!empty($user)){
    $token = JWTAuth::fromUser($user);
    $status = 'old';


    $deviceID = $request->input("deviceID");
    $deviceToken = $request->input("deviceToken");
    $deviceType = $request->input("deviceType");

    $device_info = UserLogin::where(['user_id'=>$user->id])->first();
    if (!empty($device_info)){
        $device_info->deviceToken = $deviceToken;
        $device_info->deviceType = $deviceType;
        $device_info->save();
        unset($user->id);
        $user->image = asset('public/images/'.$user->image);
        return response()->json([
            'result' => 'success',
            'token' => $token,
            'message' => 'Successful Login',
            'status' =>$status,
            'user' => $user
        ],200);
    }
    UserLogin::create([
        "user_id"=>$user->id,
        "ip_address"=>$request->ip(),
        "deviceID"=>$deviceID,
        "deviceToken"=>$deviceToken,
        "deviceType"=>$deviceType,
    ]);
    unset($user->id);







    return response()->json([
        'result' => 'success',
        'token' => $token,
        'message' => 'Successful Login',
        'status' =>$status,
        'user' => $user
    ],200);
}else{
    return response()->json([
        'result' => 'success',
        'token' => $token,
        'message' => 'New User',
        'status' =>$status,
        'user' => $user
    ],200);
}









}














public function login(Request $request)
{
    $validator =  Validator::make($request->all(), [
        'username' => 'required',
        'otp'=>'required',
        'deviceID' => 'required',
        'deviceToken' => 'required',
        'deviceType' => 'required',
    ]);
    $user = null;
    $status = 'new';
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'token' => null,
            'status' =>$status,
            'message' => json_encode($validator->errors()),
            'user'=>$user
        ],400);
    }
    $time = date("Y-m-d H:i:s",strtotime('-15 minutes'));
    $verify_otp  = UserOtp::where(['mobile'=>$request->only('username'),'otp'=>$request['otp']])->orWhere(['email'=>$request->only('username'),'otp'=>$request['otp']])->first();
    if (empty($verify_otp)) {
        return response()->json([
            'result' => 'failure',
            'token' => null,
            'status' =>$status,
            'message' => 'Invalid Otp.',
            'user'=>$user
        ],200);
    }
    $credentials = $request->only('mobile');
    $user = User::where('phone',$request->only('username'))->orWhere('email',$request->only('username'))->first();

    try {
        if (!empty($user)) {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json([
                    'result' => 'failure',
                    'token' => null,
                    'status' =>$status,
                    'message' => 'invalid_credentials',
                    'user' => null], 400);
            }
        } 
        else{
           return response()->json([
            'result' => 'success',
            'status' =>$status,
            'message' => '',
            'token' => null,
            'user' => $user], 200);
       } 
   }

   catch (JWTException $e) {
    return response()->json([
        'result' => 'failure',
        'token' => null,
        'status' =>$status,
        'message' => 'could_not_create_token',
        'user' => null], 500);
}
$deviceID = $request->input("deviceID");
$deviceToken = $request->input("deviceToken");
$deviceType = $request->input("deviceType");

$device_info = UserLogin::where(['user_id'=>$user->id])->first();
if (!empty($device_info)){
    $device_info->deviceToken = $deviceToken;
    $device_info->deviceType = $deviceType;
    $device_info->save();
    unset($user->id);
    $user->image = asset('public/images/'.$user->image);
    return response()->json([
        'result' => 'success',
        'token' => $token,
        'message' => 'Successful Login',
        'status' =>$status,
        'user' => $user
    ],200);
}
UserLogin::create([
    "user_id"=>$user->id,
    "ip_address"=>$request->ip(),
    "deviceID"=>$deviceID,
    "deviceToken"=>$deviceToken,
    "deviceType"=>$deviceType,
]);
unset($user->id);
if($user->photo!=='' && $user->photo!=null){
  $user->photo =  asset('public/images/'.$user->photo);
}
return response()->json([
    'result' => 'success',
    'token' => $token,
    'message' => 'Successful Login',
    'status' =>$status,
    'user' => $user
],200);

}





public function loginWithPassword(Request $request)
{
    $validator =  Validator::make($request->all(), [
        'username' => 'required',
        'password'=>'required',
        'deviceID' => 'required',
        'deviceToken' => 'required',
        'deviceType' => 'required',
    ]);
    $user = null;
    $status = 'new';
    $type ='';
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'token' => null,
            'status' =>$status,
            'message' => json_encode($validator->errors()),
            'user'=>$user
        ],400);
    }
    //$phone = $request->only('username');
    $username = $request->username;
    $password = $request->only('password');


    $influencers = DB::table('influencers')->where('mobile',$username)->orWhere('email',$username)->first();
    if(!empty($influencers)){

     $pass_check =  Hash::check($request->password, $influencers->password);
     if($pass_check){
       $type = 'influencer';
       $user = $influencers;
       $credentials = $request->only('username', 'password');
       $credentials['mobile'] = $influencers->mobile;
   }else{
     return response()->json([
        'result' => 'failure',
        'status' =>$status,
        'message' => 'Invalid credentials',
        'token' => null,
        'type' => $type,

        'user' => $user], 200);
 }







}else{
    $type = 'user';
}






if($type == 'influencer'){
    try {
        if (!empty($user)) {
            if (!$token = $user->id) {
                return response()->json([
                    'result' => 'failure',
                    'token' => null,
                    'status' =>$status,
                    'type' => $type,
                    'message' => 'invalid_credentials',
                    'user' => null], 400);
            }
        } 
        else{ 
           return response()->json([
            'result' => 'failure',
            'status' =>$status,
            'message' => 'Invalid credentials',
            'token' => null,
            'type' => $type,

            'user' => $user], 200);
       } 
   }

   catch (JWTException $e) {
    return response()->json([
        'result' => 'failure',
        'token' => null,
        'status' =>$status,
        'message' => 'could_not_create_token',
        'type' => $type,

        'user' => null], 500);
}


return response()->json([
    'result' => 'success',
    'token' => $token,
    'message' => 'Successful Login',
    'status' =>$status,
    'user' => $user,
    'type' => $type,
],200);
}





if($type == 'user')
{
    $user_detail = User::where('phone',$username)->orWhere('email',$username)->first();
    if(!empty($user_detail)){
       $pass_check =  Hash::check($request->password, $user_detail->password);
       if($pass_check){
        $user  = User::where('phone',$username)->orWhere('email',$username)->first();
    }
}

if (!empty($user)) {
   $status = 'old';


   if($user->photo!=='' && $user->photo!=null){
      $user->photo =  asset('public/images/'.$user->photo);
  }
}
try {
    if (!empty($user)) {
        if (!$token = JWTAuth::fromUser($user)) {
            return response()->json([
                'result' => 'failure',
                'token' => null,
                'status' =>$status,
                'type' => $type,
                'message' => 'invalid_credentials',
                'user' => null], 400);
        }
    } 
    else{ 
       return response()->json([
        'result' => 'failure',
        'status' =>$status,
        'message' => 'Invalid credentials',
        'token' => null,
        'type' => $type,

        'user' => $user], 200);
   } 
}

catch (JWTException $e) {
    return response()->json([
        'result' => 'failure',
        'token' => null,
        'status' =>$status,
        'message' => 'could_not_create_token',
        'type' => $type,

        'user' => null], 500);
}
$deviceID = $request->input("deviceID");
$deviceToken = $request->input("deviceToken");
$deviceType = $request->input("deviceType");
$device_info = UserLogin::where(['user_id'=>$user->id])->first();
if (!empty($device_info)){
    $device_info->deviceToken = $deviceToken;
    $device_info->deviceType = $deviceType;
    $device_info->save();

    return response()->json([
        'result' => 'success',
        'token' => $token,
        'message' => 'Successful Login',
        'status' =>$status,
        'user' => $user,
        'type' => $type,

    ],200);
}
UserLogin::create([
    "user_id"=>$user->id,
    "ip_address"=>$request->ip(),
    "deviceID"=>$deviceID,
    "deviceToken"=>$deviceToken,
    "deviceType"=>$deviceType,
]);
unset($user->id);

return response()->json([
    'result' => 'success',
    'token' => $token,
    'message' => 'Successful Login',
    'status' =>$status,
    'user' => $user,
    'type' => $type,

],200);
}




}
public function logout(Request $request)
{
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
        'deviceID' => 'max:255',
    ]);

    if ($validator->fails()) {

        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors())
        ],400);
    }

    try {
        JWTAuth::invalidate($request->token);
        $user_login = UserLogin::where(['deviceID' => $request->input("deviceID")])->delete();
        return response()->json([
            'result' => 'success',
            'message' => 'User logged out successfully'
        ],200);
    } catch (JWTException $exception) {
        return response()->json([
            'result' => 'failure',
            'message' => 'Sorry, the user cannot be logged out'
        ], 500);
    }
}

public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'mobile' => 'required|unique:users,phone',
        'email'=>'required|unique:users',
        'password'=>'required',
        'confirm_password'=>'required_with:password|same:password|',
        'referral_code'=>'',
        'deviceID' => '',
        'deviceToken' => '',
        'deviceType' => '',
    ]);
    if ($validator->fails()) {

        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),
            'token'=>null,
            'user'=>null
        ],400);
    }

    if(!empty($request->referral_code)){
        $exist = User::where('referral_code',$request->referral_code)->first();
    }



    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->mobile;
   // $user->gender =isset($request->gender) ? $request->gender :'';
    $password = $request->password;
    $user->referral_code = $this->generateReferalCode(8);


    if(!empty($exist)){
        $user->referral_userID = $exist->id;
    }

                       // $user->password = Hash::make($password);
    $user->password = bcrypt($password);
    $user->photo= 'user.png';
    $image = $request->file('image');
    if (!empty($image)) {
                            //Store Image In Folder
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/'), $imageName);

        $user->photo = $imageName;
    }

    $user->save();

    $credentials = $request->only('mobile');
                       // $user = User::where($credentials)->first();
    $user = User::where('phone',$credentials)->first();
    $user->photo= $this->url.'assets/images/users/'.$user->photo;
    try {
        if (!empty($user)) {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json([
                    'result' => 'failure',
                    'token' => null,
                    'message' => 'invalid_credentials',
                    'user' => null], 400);
            }
        } else {
            return response()->json([
                'result' => 'failure',
                'token' => null,
                'message' => 'invalid_credentials',
                'user' => null], 400);
        }

    } catch (JWTException $e) {
        return response()->json([
            'result' => 'failure',
            'token' => null,
            'message' => 'could_not_create_token',
            'user' => null], 500);
    }
    $deviceID = $request->input("deviceID");
    $deviceToken = $request->input("deviceToken");
    $deviceType = $request->input("deviceType");
    $device_info = UserLogin::where(['user_id'=>$user->id])->first();
    UserLogin::create([
        "user_id"=>$user->id,
        "ip_address"=>$request->ip(),
        "deviceID"=>$deviceID,
        "deviceToken"=>$deviceToken,
        "deviceType"=>$deviceType,
    ]);
    unset($user->id);
    if($user->image!=='' && $user->image!=null){
      $user->image =  asset('public/images/'.$user->image);
  }

  return response()->json([
    'result' => 'success',
    'token' => $token,
    'message' => 'Successful Login',
    'user' => $user
],200);
}


public  function generateReferalCode($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



public function home(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',
]);
   $data = array();
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'data' =>$data,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'data' =>$data,
    ],401);
} 
$banners = [];

$data['user'] = $user;
$data['banner'] = $banners;

$banners = Banner::where('type','app')->where('status',1)->get();
if(!empty($banners)){
    foreach($banners as $banner){
        $banner->image = $this->url.'public/storage/banner/'.$banner->image;
    }
    $data['banner'] = $banners;
}
if(!empty($user)){
    $data['user'] = $user;
}

$today = date('Y-m-d');
$time = date('H:i');
$upcoming_events = [];
$live_influencer = [];
$galleries = [];
$popular_influencer = [];

$data['upcoming_events'] = $upcoming_events;
$data['live_influencer'] = $live_influencer;
$data['galleries'] = $galleries;

// ->where('start_time','>',$time)

$events = Events::whereDate('event_date','>=',$today)->where('start_time','>',$time)->latest()->take(5)->get();


if(!empty($events)){
    foreach($events as $event){
        $influencer_id = $event->influencers_id;

        $influencer = Influencers::where('id',$influencer_id)->first();
        if(!empty($influencer)){
            $event->image = $this->url.'public/storage/influencer/'.$influencer->image;
            $event_date = $event->event_date;


            $event->influencer_name = $influencer->name;
            $event->influencer_id = $influencer->id;

            //echo $event_date;

            $event->event_day = date('D',strtotime($event_date));
            $event->event_month = date('F',strtotime($event_date));
            $event->event_date = date('j',strtotime($event_date));
            //$event->influencer = $influencer;
            $upcoming_events[] = $event;

        }
    }
}

if(!empty($upcoming_events)){
    $data['upcoming_events'] = $upcoming_events;
}


$live_influencer = [];


$events = Events::where('event_date',$today)->where('start_time','<=',$time)->where('end_time','>=',$time)->latest()->take(5)->get();
if(!empty($events)){
    foreach($events as $event){
        $influencer_id = $event->influencers_id;

        $influencer = Influencers::where('id',$influencer_id)->first();
        if(!empty($influencer)){
            $influencer->image = $this->url.'public/storage/influencer/'.$influencer->image;
            $influencer->event_date = $event->event_date;
            $influencer->event_id = $event->id;
            $is_subscription = 'N';

            $event_sub = DB::table('event_subscription')->where('user_id',$user->id)->where('event_id',$event->id)->first();
            if(!empty($event_sub)){
                $is_subscription = 'Y';
            }
            $user_sub = DB::table('user_subscriptions')->where('user_id',$user->id)->where('end_date','>=',date('Y-m-d'))->first();
            if(!empty($user_sub)){
                $is_subscription = 'Y';
            }
            $influencer->is_subscription = $is_subscription;

            $live_influencer[] = $influencer;
        }
    }
}

if(!empty($live_influencer)){
    $data['live_influencer'] = $live_influencer;
}


$popular_influencer = Influencers::where('status',1)->latest()->take(5)->get();
if(!empty($popular_influencer)){
    foreach($popular_influencer as $pop){
        $pop->image = $this->url.'public/storage/influencer/'.$pop->image;
    }
}



$galleries = Gallery::where('status',1)->latest()->take(10)->get();

if(!empty($galleries)){
    foreach($galleries as $ga){
        $ga->image = $this->url.'public/storage/galleries/'.$ga->image;
    }
}

if(!empty($galleries)){
    $data['galleries'] = $galleries;
}


if(!empty($popular_influencer)){
    $data['popular_influencer'] = $popular_influencer;
}



return response()->json([
    'result' => 'success',
    'message' => 'Home Details',
    'data' =>$data,
],200);  




}

public function upcoming_events(Request $request){
 $validator =  Validator::make($request->all(), [
    'token' => 'required',

]);
 $events = array();
 $user = null; 
 if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'events' =>$events,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'events' =>$events,
    ],401);
} 
$today = date('Y-m-d');
$time = date('H:i');
$upcoming_events = [];
// $events = Events::where('event_date','>',$today)->paginate(10);
$events = Events::whereDate('event_date','>=',$today)->where('start_time','>',$time)->paginate(10);
if(!empty($events)){
    foreach($events as $event){
        $influencer_id = $event->influencers_id;

        $influencer = Influencers::where('id',$influencer_id)->first();
        if(!empty($influencer)){
            $influencer->image = $this->url.'public/storage/influencer/'.$influencer->image;
            $event_date = $event->event_date;
            $event->event_day = date('D',strtotime($event_date));
            $event->event_month = date('F',strtotime($event_date));
            $event->event_date = date('j',strtotime($event_date));
            $event->influencer = $influencer;

        }
    }
}


return response()->json([
    'result' => 'success',
    'message' => 'Upcoming Event',
    'events'=>$events,
],200); 

}


public function event_details(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
        'eventID' => 'required',
        //'influencers_id' => 'required',
        
    ]);
    $details = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),
            'details' =>$details,
        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
            'details' =>$details,
        ],401);
    } 

//->where('influencers_id',$request->influencers_id)

    $details = Events::where('id',$request->eventID)->first();

    if(!empty($details)){

        $details->start_time = date('h:i A', strtotime($details->start_time));
        $details->end_time = date('h:i A', strtotime($details->end_time));

        $start = strtotime($details->start_time);
        $end =strtotime($details->end_time);
        $elapsed = $end - $start;
        $details->duration = date('H:i',$elapsed).' Hours';
        $influencers_id = $details->influencers_id;
        $influencer = Influencers::where('id',$influencers_id)->first();
        if(!empty($influencer)){
            $influencer->image = $this->url.'public/storage/influencer/'.$influencer->image;
        }

        $details->influencer = $influencer;

        $event_gallery = EventGallery::where('event_id',$request->eventID)->get();
        if(!empty($event_gallery)){
            foreach($event_gallery as $gall){
                $gall->image = $this->url.'public/storage/event_gallery/'.$gall->image;
            }
        }

        $details->gallery = $event_gallery;



    }
    return response()->json([
        'result' => 'success',
        'message' => 'Event Details',
        'details'=>$details,
    ],200);  
}






public function edit_profile(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',

]);
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'user' =>$user,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'user' =>$user,
    ],401);
} 

$dbArray= [];
if(!empty($request->name)){
    $dbArray['name'] = $request->name;
}
if(!empty($request->gender)){
    $dbArray['gender'] = $request->gender;
}
if(!empty($request->dob)){
    $dbArray['dob'] = $request->dob;
}
if($request->hasFile('image')){
 $file = $request->file('image');

 $destinationPath = public_path("/uploads/images");

 $side = $request->file('image');

 $side_name = $user->id.'_user_profile'.time().'.'.$side->getClientOriginalExtension();

 $side->move($destinationPath, $side_name);

 $dbArray['photo'] = $side_name;
}


User::where('id',$user->id)->update($dbArray);
$user = User::where('id',$user->id)->first();

if(!empty($user) && !empty($user->photo)){
    $user->photo= $this->url.'api/public/uploads/images/'.$user->photo;
}else{
   $user->photo= $this->url.'api/public/uploads/images/man.png';
}



return response()->json([
    'result' => 'success',
    'message' => ' Profile Updated successfully',
    'user'=>$user,
],200); 

}

public function my_profile(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
    ]);
    $user = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),
            'user' =>$user,
        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
            'user' =>$user,
        ],401);
    } 


    if(!empty($user) && !empty($user->photo)){
        $user->photo= $this->url.'api/public/uploads/images/'.$user->photo;
    }else{
       $user->photo= $this->url.'api/public/uploads/images/user.png';
   }

   return response()->json([
    'result' => 'success',
    'message' => 'User Profile',
    'user'=>$user,
],200);  

}



public function notification_list(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
        
    ]);
    $notifications = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),
            'notifications' =>$notifications,
        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
            'notifications' =>$notifications,
        ],401);
    } 
    $notifications = DB::table('notifications')->where('user_id',$user->id)->get();

    return response()->json([
        'result' => 'success',
        'message' => 'Notification List',
        'notifications'=>$notifications,
    ],200);  

}

public function get_question(Request $request){
 $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'question_id' => 'required',

]);
 $question = array();
 $user = null; 
 if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'question' =>$question,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'question' =>$question,
    ],401);
} 

$question = EventQuestion::where('id',$request->question_id)->first();

return response()->json([
    'result' => 'success',
    'message' => 'Question Details',
    'question'=>$question,
],200);  

}

public function submit_answer(Request $request){
 $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'question_id' => 'required',
    'option_id' => 'required',
    'event_id' => 'required',
    'time' => '',

]);
 $question = array();
 $user = null; 
 if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'question' =>$question,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'question' =>$question,
    ],401);
} 

$exist = EventQuestionAnswer::where('user_id',$user->id)->where('question_id',$request->question_id)->where('event_id',$request->event_id)->first();
if(!empty($exist)){
  EventQuestionAnswer::create([
    'user_id'=>$user->id,
    'question_id'=>$request->question_id,
    'option_id'=>$request->option_id,
    'event_id'=>$request->event_id,
    'time'=>$request->time,

]);

  return response()->json([
    'result' => 'success',
    'message' => 'Answer SUbmitted Succesfully',
],200);  
}else{
    return response()->json([
        'result' => 'failure',
        'message' => 'Answer Already SUbmitted ',
    ],200);
}



}




public function gallery_list(Request $request){
  $validator =  Validator::make($request->all(), [
    'token' => 'required',


]);
  $galleries = array();
  $user = null; 
  if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'galleries' =>$galleries,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'galleries' =>$galleries,
    ],401);
} 

$galleries = Gallery::where('status',1)->get();

if(!empty($galleries)){
    foreach($galleries as $gallery){
        $gallery->image = $this->url.'/public/storage/galleries/'.$gallery->image;
    }
}


return response()->json([
    'result' => 'success',
    'message' => 'Gallery List',
    'galleries' =>$galleries,
],200); 
}



public function subscription_list(Request $request){
  $validator =  Validator::make($request->all(), [
    'token' => 'required',
    
    
]);
  $subscriptions = array();
  $user = null; 
  if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'subscriptions' =>$subscriptions,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'subscriptions' =>$subscriptions,
    ],401);
} 

$subscriptions = Subscription::where('status',1)->get();


return response()->json([
    'result' => 'success',
    'message' => 'subscriptions List',
    'subscriptions' =>$subscriptions,
],200); 
}



public function WalletHistory(Request $request){
  $validator =  Validator::make($request->all(), [
    'token' => 'required',
    
    
]);
  $wallets = array();
  $user = null; 
  if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),
        'wallets' =>$wallets,
    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
        'wallets' =>$wallets,
    ],401);
} 

$wallets = WalletHistory::where('user_id',$user->id)->orderby('id','desc')->paginate(10);
if(!empty($wallets)){
    foreach($wallets as $wallet){
        $created_at = $wallet->created_at;
        $wallet->date = date('Y-m-d',strtotime($created_at));
        $wallet->time = date('h:i A',strtotime($created_at));
    }
}

return response()->json([
    'result' => 'success',
    'message' => 'Wallet History',
    'wallets' =>$wallets,
],200); 
}


public function get_wallet(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',


    ]);
    $wallets = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),
            'wallets' =>$wallets,
        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
            'wallets' =>$wallets,
        ],401);
    } 

    $wallets = WalletHistory::where('user_id',$user->id)->latest()->take(3)->get();

    if(!empty($wallets)){
        foreach($wallets as $wallet){
            $created_at = $wallet->created_at;
            $wallet->date = date('Y-m-d',strtotime($created_at));
            $wallet->time = date('h:i A',strtotime($created_at));
        }
    }


    return response()->json([
        'result' => 'success',
        'message' => 'Wallet History',
        'wallet' =>$user->wallet,

        'wallets_history' =>$wallets,
    ],200); 
}

public function influencer_details(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
        'influencer_id' => 'required',


    ]);
    $influencers = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),

        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
        ],401);
    } 

    $influencers = Influencers::where('id',$request->influencer_id)->first();




    if(!empty($influencers)){

        $galleries = InfluencersGallery::select('image')->where('influencer_id',$request->influencer_id)->get();
        if(!empty($galleries)){
            foreach($galleries as $gallery){
                $gallery->image = $this->url.'public/storage/influencer_gallery/'.$gallery->image;
            }
        }
        $influencers->image = $this->url.'public/storage/influencer/'.$influencers->image;
        $influencers->gallery= $galleries;
        $details = Events::where('influencers_id',$request->influencer_id)->where('event_date','>',date('Y-m-d'))->latest()->first();

        $influencers->gallery= $galleries;
        $influencers->event_date= '';
        $influencers->start_time= '';
        $influencers->end_time= '';
        $influencers->about= '';


        
        if(!empty($details)){

            $details->start_time = date('h:i A', strtotime($details->start_time));
            $details->end_time = date('h:i A', strtotime($details->end_time));

            $start = strtotime($details->start_time);
            $end =strtotime($details->end_time);
            $elapsed = $end - $start;
        //$details->duration = date('H:i',$elapsed).' Hours';

            $influencers->event_date= $details->event_date;
            $influencers->start_time= date('h:i A', strtotime($details->start_time));
            $influencers->end_time= date('h:i A', strtotime($details->end_time));

            $influencers->about= $influencers->description;


        }



    }


    return response()->json([
        'result' => 'success',
        'message' => 'Wallet History',
        'influencers' =>$influencers,
    ],200);
}

public function influencer_list(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',
]);
   $influencers = array();
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 

$influencers = Influencers::where('status',1)->orderby('id','desc')->paginate(10);
if(!empty($influencers)){
    foreach($influencers as $influe){
        if(!empty($influe->image)){
            $influe->image = $this->url.'public/storage/influencer/'.$influe->image;
        }
    }
}

return response()->json([
    'result' => 'success',
    'message' => 'Wallet History',
    'influencers' =>$influencers,
],200);




}

public function live_influencer_list(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
    ]);
    $influencers = array();
    $user = null; 
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),

        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
        ],401);
    } 

    $today = date('Y-m-d');
    $time = date('H:i');

    $events = Events::where('event_date',$today)->where('start_time','<=',$time)->where('end_time','>=',$time)->latest()->paginate(10);
    if(!empty($events)){
        foreach($events as $event){
            $influencer_id = $event->influencers_id;

            $influencer = Influencers::where('id',$influencer_id)->first();
            if(!empty($influencer)){
                $influencer->image = $this->url.'public/storage/influencer/'.$influencer->image;
                $influencer->event_date = $event->event_date;
                $influencer->event_id = $event->id;



                $is_subscription = 'N';

                $event_sub = DB::table('event_subscription')->where('user_id',$user->id)->where('event_id',$event->id)->first();
                if(!empty($event_sub)){
                    $is_subscription = 'Y';
                }
                $user_sub = DB::table('user_subscriptions')->where('user_id',$user->id)->where('end_date','>=',date('Y-m-d'))->first();
                if(!empty($user_sub)){
                    $is_subscription = 'Y';
                }


                $influencer->is_subscription = $is_subscription;


                $influencers[] = $influencer;
            }




        }
    }


    return response()->json([
        'result' => 'success',
        'message' => 'Live Influencers List',
        'influencers' =>$influencers,
    ],200);
}


public function chats(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'eventId' => 'required',
]);
   $chats = array();
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 

$chats = EventChat::where('event_id',$request->eventId)->paginate(15);
if(!empty($chats)){
    foreach($chats as $chat){
        $chat->name = '';
        $chat->image = '';

        if($chat->user_id == 0){
            $chat->name = 'Admin';
            $chat->image = $this->url.'api/public/uploads/images/user.png';
        }

        if($chat->user_id !=0){
            $user = User::where('id',$chat->user_id)->first();
            $chat->name = $user->name;
            if(!empty($user->photo)){
                $chat->image = $this->url.'api/public/uploads/images/'.$user->photo;
            }else{
                $chat->image = $this->url.'api/public/uploads/images/man.png';
            }

        }


    }
}

return response()->json([
    'result' => 'success',
    'message' => 'Live Chats List',
    'chats' =>$chats,
],200);


}




public function chatSubmit(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'eventId' => 'required',
    'text' => 'required',
]);
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 

$chats = EventChat::where('event_id',$request->eventId)->paginate(15);
$dbArray = [];

$dbArray['user_id'] = $user->id;
$dbArray['event_id'] =$request->eventId; 
$dbArray['text'] =$request->text; 

EventChat::create($dbArray);



return response()->json([
    'result' => 'success',
    'message' => 'Submitted SuccessFully',
],200);


}


public function winers_list(Request $request){
 $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'eventId' => 'required',
    'question_id' => 'required',
]);
 $user = null; 
 $winers_list = array();
 if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 

$answers = DB::table('event_question_answers')->where('event_id',$request->eventId)->where('question_id',$request->question_id)->get();


$userIds = [];

if(!empty($answers)){
    foreach($answers as $ans){
        $question = EventQuestion::where('id',$ans->question_id)->first();
        if(!empty($question)){
            if($question->right_option == $ans->option_id){
                if(!in_array($ans->user_id,$userIds)){
                    $userIds[] = $ans->user_id;

                }
            }
        }
    }
}



$users = User::select('photo','id')->whereIn('id',$userIds)->get();
if(!empty($users)){
    foreach($users as $user){

        if(!empty($user->photo)){
         $user->photo = $this->url.'api/public/uploads/images/'.$user->photo;
     }else{
      $user->photo = $this->url.'api/public/uploads/images/man.png';
  }
}
}


return response()->json([
    'result' => 'success',
    'message' => ' SuccessFully',
    'winers_list' => $users,
],200);




}



public function my_participation(Request $request){
  $validator =  Validator::make($request->all(), [
    'token' => 'required',
]);
  $user = null; 
  $my_participation = array();
  if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 
$eventIds = [];
$event_users = DB::table('event_users')->where('user_id',$user->id)->get();
if(!empty($event_users)){
    foreach($event_users as $event){
        $eventIds[]  = $event->event_id;
    }
}
$events = null;


if(!empty($eventIds)){

    $events = Events::whereIn('id',$eventIds)->paginate(10);
    if(!empty($events)){
        foreach($events as $event){
            $event_date = $event->event_date;
            $event->image = $this->url.'public/storage/events/'.$event->image;

            $event->event_day = date('D',strtotime($event_date));
            $event->event_month = date('F',strtotime($event_date));
            $event->event_date = date('j',strtotime($event_date));

            $event->start_time = date('h:i A',strtotime($event->start_time));
            $event->end_time = date('h:i A',strtotime($event->end_time));


            $influencer = Influencers::where('id',$event->influencers_id)->first();
            $event->influencer = $influencer;

        }
    }
}

return response()->json([
    'result' => 'success',
    'message' => ' SuccessFully',
    'my_participation' => $events,
],200);


}


public function question_winner_list(Request $request){
    $validator =  Validator::make($request->all(), [
        'token' => 'required',
        'eventId' => 'required',
        'question_id' => 'required',
    ]);
    $user = null; 
    $winers_list = array();
    if ($validator->fails()) {
        return response()->json([
            'result' => 'failure',
            'message' => json_encode($validator->errors()),

        ],400);
    }
    $user = JWTAuth::parseToken()->authenticate();
    if (empty($user)){
        return response()->json([
            'result' => 'failure',
            'message' => '',
        ],401);
    } 

    $answer = 0;
    $answers = DB::table('event_question_answers')->where('event_id',$request->eventId)->where('question_id',$request->question_id)->get();


    $questions = EventQuestion::where('id',$request->question_id)->first();

    $user_answers = DB::table('event_question_answers')->where('event_id',$request->eventId)->where('question_id',$request->question_id)->where('user_id',$user->id)->first();
    if(!empty($user_answers)){

        if($user_answers->option_id == $questions->right_option){
            $answer = 1;
        }else{
            $answer = 2;
        }

    }


    $userIds = [];

    if(!empty($answers)){
        foreach($answers as $ans){
            $question = EventQuestion::where('id',$ans->question_id)->first();
            if(!empty($question)){
                if($question->right_option == $ans->option_id){
                    if(!in_array($ans->user_id,$userIds)){
                        $userIds[] = $ans->user_id;

                    }
                }
            }
        }
    }
    $users = User::select('photo','id','name','email')->whereIn('id',$userIds)->get();
    if(!empty($users)){
        foreach($users as $user){

            if(!empty($user->photo)){
             $user->photo = $this->url.'api/public/uploads/images/'.$user->photo;
         }else{
          $user->photo = $this->url.'api/public/uploads/images/man.png';
      }
  }
}






return response()->json([
    'result' => 'success',
    'message' => ' SuccessFully',

    'winers_list' => $users,
    'questions' => $questions,
    'answer' => $answer,

],200);


}

public function join_live(Request $request){
   $validator =  Validator::make($request->all(), [
    'token' => 'required',
    'eventId' => 'required',
]);
   $user = null; 
   $winers_list = array();
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}
$user = JWTAuth::parseToken()->authenticate();
if (empty($user)){
    return response()->json([
        'result' => 'failure',
        'message' => '',
    ],401);
} 



$is_subscription = 'N';

$event_sub = DB::table('event_subscription')->where('user_id',$user->id)->where('event_id',$request->eventId)->first();
if(!empty($event_sub)){
    $is_subscription = 'Y';
}
$user_sub = DB::table('user_subscriptions')->where('user_id',$user->id)->where('end_date','>=',date('Y-m-d'))->first();
if(!empty($user_sub)){
    $is_subscription = 'Y';
}


if($is_subscription == 'Y'){
    $dbArray = [];
    $dbArray['user_id'] = $user->id;
    $dbArray['event_id'] = $request->eventId;


    $check_exist = DB::table('event_users')->where('user_id',$user->id)->where('event_id',$request->eventId)->first();


    if(empty($check_exist)){
        DB::table('event_users')->insert($dbArray);
    }else{
        return response()->json([
            'result' => 'success',
            'message' => 'You Already Joined',

        ],200);

    }

    return response()->json([
        'result' => 'success',
        'message' => ' SuccessFully',

    ],200);

}else{
    return response()->json([
        'result' => 'success',
        'message' => 'Please take subscription',

    ],200);
}
}


public function forget_password(Request $request){
   $validator =  Validator::make($request->all(), [
    'username' => 'required',
    'password' => 'required',
    'confirm_password' => 'required_with:password|same:password',
]);
   $user = null; 
   if ($validator->fails()) {
    return response()->json([
        'result' => 'failure',
        'message' => json_encode($validator->errors()),

    ],400);
}


$user = User::where('phone',$request->only('username'))->orWhere('email',$request->only('username'))->where('is_delete',0)->first();
if(!empty($user)){

    User::where('phone',$user->phone)->update(['password'=>bcrypt($request->password)]);
    return response()->json([
    'result' => 'success',
    'message' => 'Password Changed Succesfully',
],200);

}else{
    return response()->json([
    'result' => 'failure',
    'message' => 'User Not Exist',
    ],200);
}


}


}
