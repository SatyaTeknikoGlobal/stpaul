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
use App\Event;




use App\Influencers;
use App\UserLogin;
use App\InfluencersGallery;
use Yajra\DataTables\DataTables;


use Storage;
use DB;
use Hash;



Class NotificationController extends Controller
{


	private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

        $routeName = CustomHelper::getAdminRouteName();
    }



    public function index(Request $request){


        $method = $request->method();
        if($method == 'post' || $method == 'POST'){
            $user_id1 = $request->user_id1;///////All
            $user_id2 = $request->user_id2;/////Specific User
            $user_id3 = $request->user_id3;////Event Wise


            $title1 = $request->title1;
            $title2 = $request->title2;
            $title3 = $request->title3;


            $text1 = $request->text1;
            $text2 = $request->text2;
            $text3 = $request->text3;

            //$image1 = $request->image1;
           // $image2 = $request->image2;
            //$image3 = $request->image3;


            if(isset($user_id1) && isset($text1)){
                $users = User::where('status',1)->where('is_delete',0)->get();
                $image = '';
               ////////Image Upload
                $file = $request->file('image1');
                if ($file) {
                    $path = 'notification/';
                    $thumb_path = 'notification/thumb/';
                    $storage = Storage::disk('public');
                    $IMG_WIDTH = 768;
                    $IMG_HEIGHT = 768;
                    $THUMB_WIDTH = 336;
                    $THUMB_HEIGHT = 336;

                    $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
                    
                    if($uploaded_data['success']){
                        $image = $uploaded_data['file_name'];
                    //echo $image;
                    }

                }


                if(!empty($users)){
                    foreach($users as $user){

                        $devices = UserLogin::where('user_id',$user->id)->get();
                        if(!empty($devices)){
                            foreach($devices as $device){
                                $deviceToken = $device->deviceToken;
                                if($image !=''){
                                    $sendData = array(
                                        'body' => $text1,
                                        'title' => $title1,
                                        'sound' => 'Default',
                                        'image' => url('public/storage/notification/'.$image),


                                    );

                                }else{
                                   $sendData = array(
                                    'body' => $text1,
                                    'title' => $title1,
                                    'sound' => 'Default',
                                );
                               }

                               $result = $this->fcmNotification($deviceToken,$sendData);

                               if($result){
                                $dbArray = [];
                                $dbArray['user_id'] = $user->id;
                                $dbArray['text'] = $title1;
                                $dbArray['image'] =  url('public/storage/notification/'.$image);
                                $dbArray['description'] = $text1;
                                DB::table('notifications')->insert($dbArray);

                            }

                        }
                    }




                }
            }

        }

        if(isset($user_id2) && isset($text2)){
           $users = User::whereIn('id',$user_id2)->where('status',1)->where('is_delete',0)->get();
           $image = '';
               ////////Image Upload
           $file = $request->file('image2');
           if ($file) {
            $path = 'notification/';
            $thumb_path = 'notification/thumb/';
            $storage = Storage::disk('public');
            $IMG_WIDTH = 768;
            $IMG_HEIGHT = 768;
            $THUMB_WIDTH = 336;
            $THUMB_HEIGHT = 336;

            $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
            
            if($uploaded_data['success']){
                $image = $uploaded_data['file_name'];
                    //echo $image;
            }

        }


        if(!empty($users)){
            foreach($users as $user){

                $devices = UserLogin::where('user_id',$user->id)->get();
                if(!empty($devices)){
                    foreach($devices as $device){
                        $deviceToken = $device->deviceToken;
                        if($image !=''){
                            $sendData = array(
                                'body' => $text2,
                                'title' => $title2,
                                'sound' => 'Default',
                                'image' => url('public/storage/notification/'.$image),
                            );
                        }else{
                            $sendData = array(
                                'body' => $text2,
                                'title' => $title2,
                                'sound' => 'Default',
                            );
                        }


                            //prd($sendData);

                        $result = $this->fcmNotification($deviceToken,$sendData);

                        if($result){
                            $dbArray = [];
                            $dbArray['user_id'] = $user->id;
                            $dbArray['text'] = $title2;
                            $dbArray['image'] = url('public/storage/notification/'.$image);
                            $dbArray['description'] = $text2;
                            DB::table('notifications')->insert($dbArray);

                        }

                    }
                }




            }
        }

    }

    if(!empty($user_id3) && !empty($text3)){


    }



}


$users = User::get();
$data['users'] = $users;
//$data['events'] = Event::where('event_date','>=',date('Y-m-d'))->get();





return view('admin.notification.index',$data);
}




public function fcmNotification($device_id, $sendData)
{
        #API access key from Google API's Console
    if (!defined('API_ACCESS_KEY')){
        define('API_ACCESS_KEY', 'AAAATmZU4nA:APA91bGClTtsQEYtexrS3tdYGTca7Q2UhwWGHplyx7vjXoE2RgMihRt1oc2z-SepjOIDXDVkGmps4X1jKa-YPzUpyYKe6RUWl-isZ2_S8o_Npyh18FFltQKIgeFEQexhKQl07gHQTdEm');

    }

    $fields = array
    (
        'to'    => $device_id,
        'data'  => $sendData,
        'notification'  => $sendData
    );


    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
        #Send Reponse To FireBase Server    
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch);
        //$data = json_decode($result);
    if($result === false)
        die('Curl failed ' . curl_error());

    curl_close($ch);

       // prd($result);
    return $result;
}







private function saveImage($request, $influencer, $oldImg=''){

    $file = $request->file('image');
    if ($file) {
        $path = 'notification/';
        $thumb_path = 'notification/thumb/';
        $storage = Storage::disk('public');

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










}