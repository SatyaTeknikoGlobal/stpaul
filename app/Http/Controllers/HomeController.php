<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Vendor;
use App\Users;
use App\CouponCategory;
use Auth;
use DB;
use Validator;
use Storage;
use App\Cart;
use App\State;
use App\Coupon;
use App\Category;
use App\Rank;
use App\Post;
use App\Exam;
use App\UserOtp;
use App\Testimonial;
use App\Course;
use App\Question;

use App\Order;
use App\Faq;
use App\PaidUser;
use App\Answer;
use App\Banner;
use App\AttemptExam;
use App\User;

use Session;
use Hash;


use Twilio\Rest\Client;


class HomeController extends Controller
{

 public function __construct(){


 }



 public function index(Request $request)
 {
  $data = [];


  if(!empty(Auth::guard('appusers')->user())){
    //pr(Auth::guard('appusers')->user());
  }
  $exams = Exam::where('status',1)->where('status',1)->where('is_delete',0)->latest()->take(3)->get();

  $tesimonials = Testimonial::where('status',1)->get(); 
  $faqs = Faq::where('status',1)->latest()->take(7)->get(); 



  $banners = Banner::where('status',1)->where('type','web')->get(); 

  $data['exams'] = $exams;
  $data['faqs'] = $faqs;
  $data['banners'] = $banners;
  $data['tesimonials'] = $tesimonials;
  
  return view('front.home.index',$data);

}




public function twillosend(Request $request){
  $sid = "AC41ba1d02d8b1bda44a8f527d920ba06a";
  $token = "f023cff8e8ec03b2d6defbb7577e3fb6";
  $twilio = new Client($sid, $token);


  $message = $twilio->messages
                  ->create("whatsapp:+15005550006", // to
                   [
                     "from" => "whatsapp:+14155238886",
                     "body" => "Hello there!"
                   ]
                 );

                  print($message->sid);



                }








                public function profile(){
                  $data = [];
                 /* $user_id = Auth::guard('appusers')->user()->id;
                  $users = PaidUser::where('id',$user_id)->latest()->get();
                  $data['users'] = $users;
                  */

                  return view('front.home.profile',$data);

                }





                public function profile_update(Request $request){
                  $method = $request->method();
                  if(!empty(Auth::guard('appusers')->user())){
                    $user_id = Auth::guard('appusers')->user()->id;

                  }
                  if($method == 'POST' || $method == 'post'){
                    $rules = [];
                    $rules['name'] = 'required';
                    $rules['email'] = 'required';
                    $rules['mobile'] = 'required';
                    $rules['address'] = 'required';

                    $this->validate($request,$rules);

                    $dbArray = [];
                    $dbArray['name'] = $request->name;
                    $dbArray['address'] = $request->name;
                    $success = Users::where('id',$user_id)->update($dbArray);
                    if($success){
                      return back()->with('alert-success', 'Profile Update Successfully');

                    }else{
                      return back()->with('alert-danger', 'something Went Wrong');

                    }
                  }
                }




                public function login(Request $request){

                  $data = [];
                  $method = $request->method();
                    //prd($request->toArray());
                  $back_url = isset($request->back_url) ? $request->back_url :'';


                  $data['back_url'] = $back_url;
                  if($method =='post' || $method == 'POST'){
                    $rules = [];
                    $rules['email'] = 'required|email';
                    $rules['password'] = 'required';

                    $this->validate($request,$rules);


                    //prd($back_url);

                    $exist = Users::where('email',$request->email)->first();

     //$hash_chack = Hash::check($old_password, $existing_password);

                    if(!empty($exist)){

                      if (Auth::guard('appusers')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
                      {
                      // redirect()->route('home');

                        if(!empty($back_url)){
                          $url = url($back_url);
                        return redirect()->to($url);
                          
                        }else{
                          return redirect()->route('home.dashboard');

                        }

                      }else{
                        return back()->with('alert-danger', 'Email or password wrong');
                      }



      // Auth::guard('appusers')->loginUsingId($exist->id);
      // return redirect()->route('home')->with('alert-success', 'Login successfully');


                    }else{
                      return back()->with('alert-danger', 'Email or password wrong');
                    }
                  }
                  if(!empty(Auth::guard('appusers')->user())){
                    return redirect()->route('home.dashboard');
                  }
                  else{
                    return view('front.login',$data);
    //return back()->with('alert-danger', 'Email or password wrong');

                  }
                }


                public function register(Request $request){

                  $data = [];

                  $dbArray= [];


                  $method = $request->method();
                  if($method =='post' || $method == 'POST'){
                    $rules = [];
                    $rules['name'] = 'required';
                    $rules['email'] = 'required|email|unique:users';
                    $rules['phone'] = 'required|unique:users';
                    $rules['password'] = 'required';
                    $rules['confirm_password'] = 'required|same:password';

                    $this->validate($request,$rules);
                    $setting = DB::table('settings')->where('id',1)->first();
//     $password = md5($request->password);
                    $referalcode = isset($request->referalcode) ? $request->referalcode :'';
                    $dbArray['refer_id'] = 0;
                    if(!empty($referalcode)){
                      $exist = Users::where('referral_code',$referalcode)->first();
                      if(!empty($exist)){
                        if(!empty($setting)){
                          $wallet = $setting->refer + $exist->wallet;
                          Users::where('referral_code',$referalcode)->update(array('wallet'=>$wallet));
                        }
                        $dbArray['refer_id'] = isset($exist->id) ? $exist->id :'';
                      }else{
                        return back()->with('alert-danger', 'Referal Code Not Exist');
                      }
                    }


                    $dbArray['name'] = $request->name;
                    $dbArray['email'] = $request->email;
                    $dbArray['phone'] = $request->phone;
                    $dbArray['password'] = bcrypt($request->password);



                    $referal_code = $this->generateRandomString(8);
                    $exist_refer = Users::where('referral_code',$referalcode)->first();
                    if(empty($exist_refer)){
                      $dbArray['referral_code'] = $referal_code;
                    }else{
                     $dbArray['referral_code'] = $this->generateRandomString(8);
                   }

                   $file = $request->file('image');
                   if ($file) {
                    $path = 'users/';
                    $thumb_path = 'users/thumb/';
                    $storage = Storage::disk('public');
                    $IMG_WIDTH = 768;
                    $IMG_HEIGHT = 768;
                    $THUMB_WIDTH = 336;
                    $THUMB_HEIGHT = 336;
                    $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
                    if($uploaded_data['success']){

                      $image = $uploaded_data['file_name'];
                      $dbArray['photo'] = $image;
                    }
                  }






                  $user_id = Users::create($dbArray)->id;



                  if(!empty($user_id)){
                    $otp = 1234;
                    $message = $otp." is your authentication Code to register.";

                    $success = CustomHelper::send_message($request->phone,$message);


                    Auth::guard('appusers')->loginUsingId($user_id);
                    return redirect()->route('home')->with('alert-success', 'Login successfully');
                  }else{
                    return back()->with('alert-danger', 'Email or password wrong');
                  }


                }




                $exams = Exam::where('status',1)->get();
                $data['exams'] = $exams;
                if(!empty(Auth::guard('appusers')->user())){
                  return redirect()->route('home.dashboard');
                }
                else{
                  return view('front.register',$data);
                }


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
                      $user = User::find($id);

                      if(!empty($user) && $user->id > 0){

                        $storage = Storage::disk('public');

                        if($type == 'file'){
                          $old_image = $user->image;
                          $user->photo = $new_image;
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




              public function logout(Request $request){


                $request->session()->invalidate();

                return redirect()->route('home');

              }


              public  function generateRandomString($length = 20) {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                  $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
              }


              public function change_password(Request $request){
                $data = [];
                $slug = isset($request->slug) ? $request->slug : '';
                $method = $request->method();
                $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';

                if(!empty($slug)){
                  $vendor = Vendor::where('slug',$slug)->first();
                  $data['vendor'] = $vendor;
                  if($method == 'post' || $method == 'POST'){
                    $rules['old_password'] = 'required|min:6|max:20';
                    $rules['password'] = 'required|min:6|max:20';
                    $rules['confirm_password'] = 'required|min:6|max:20|same:password';
                    $this->validate($request,$rules);

                    $old_password = isset($request->old_password) ? $request->old_password :'';
                    $password = isset($request->password) ? $request->password :'';
                    $confirm_password = isset($request->confirm_password) ? $request->confirm_password :'';

                    $user = Users::where(['id'=>$user_id])->first();
                    $existing_password = (isset($user->password))?$user->password:'';
                    $hash_chack = Hash::check($old_password, $existing_password);
                    if($hash_chack){
                      $update_data['password']=bcrypt(trim($password));
                      $is_updated = DB::table('web_users')->where('id', $user_id)->update($update_data);
                      if($is_updated){

                        return back()->with('alert-success', 'Password Changed successfully.');
                      }
                      else{
                       return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
                     }
                   }else{
                    return back()->with('alert-danger', 'old Password Not Matched.');
                  }

                }
                return view('front.home.change_password',$data);
              }else{
                abort(404);
              }

            }






            public function forgot_password(Request $request){
              $data = [];


              return view('front.forgot_password',$data);



            }

            public function get_exam_details(Request $request){

              $exam_id = isset($request->exam_id) ? $request->exam_id :'';
              $response = [];

              if($exam_id !=''){
                $exams = Exam::where('id',$exam_id)->first();
                if(!empty($exams)){
                  $response = array('status'=>true,'exams'=>$exams);
                }else{
                  $response = array('status'=>false,'exams'=>null);

                }
              }else{
                $response = array('status'=>false,'exams'=>null);

              }


              echo json_encode($response);
            }


            public function exam_payment(Request $request){
              $method = $request->method();
              if($method == 'post' || $method=='POST'){
                $rules = [];
                $rules['user_id'] = 'required';
                $rules['exam_amount'] = 'required';
                $rules['exam_id'] = 'required';
                $rules['transaction_id'] = 'required';
                $this->validate($request,$rules);



                $dbArray = [];
                $dbArray['user_id'] = $request->user_id;
                $dbArray['amount'] = $request->exam_amount;
                $dbArray['exam_id'] = $request->exam_id;
                $dbArray['transaction_id'] = $request->transaction_id;
                $success = DB::table('user_exam')->insert($dbArray);

                return redirect()->to(route('home.exam_details',['exam_id'=>$request->exam_id]));
              }


            }

            public function send_otp(Request $request){

              $method = $request->method();
              $mobile  = isset($request->mobile) ? $request->mobile :'';

              $exists = User::where('phone',$mobile)->first();
              if(!empty($exists)){
    //$otp = rand(1111,9999);
                $otp = 1234;

                UserOtp::updateOrCreate(['mobile'=>$mobile],['otp'=>$otp]);

                $message = $otp." is your authentication Code to register.";
                $success = CustomHelper::send_message($mobile,$message);
                $success = true;
                if($success){
                  echo json_encode(array('success'=>true,'message'=>'Otp Sent To Your Mobile number'));
                }else{
                  echo json_encode(array('success'=>false,'message'=>'Something Went Wrong'));
                }
              }else{

                echo json_encode(array('success'=>false,'message'=>'Account Doesnt Exist'));
              }



            }


            public function verify_otp(Request $request){
              $method = $request->method();
              $mobile  = isset($request->mobile) ? $request->mobile :'';
              $otp  = isset($request->otp) ? $request->otp :'';

              $exists = UserOtp::where(['mobile'=>$mobile,'otp'=>$otp])->first();
              if(!empty($exists)){
                echo json_encode(array('success'=>true,'message'=>'Otp Varified Successfully'));

              }else{
                echo json_encode(array('success'=>false,'message'=>'Incorrect Otp '));

              }




            }

            public function upload(Request $request){


            //prd($request->toArray());
             $data = [];
             $method = $request->method();
             $user = Auth::guard('appusers')->user();
             if($method == 'post' || $method == 'POST'){
               $request->validate([
                'file' => 'required',
              ]);


               if($request->hasFile('file')) {
                $file = $request->file('file');
              // $image_result = $this->saveImage($file,$user->id,'file');


                if ($file) {
                  $path = 'users/';
                  $thumb_path = 'users/thumb/';
                  $storage = Storage::disk('public');
                  $IMG_WIDTH = 768;
                  $IMG_HEIGHT = 768;
                  $THUMB_WIDTH = 336;
                  $THUMB_HEIGHT = 336;
                  $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);
                  if($uploaded_data['success']){
                    $image = $uploaded_data['file_name'];

                    $success = User::where('id',$user->id)->update(array('photo'=>$image));
                    if($success){
                      return back()->with('alert-success','Profile Image Successfully');
                    }else{
                      return back()->with('alert-danger','Something Went Wrong');

                    }

                  }
                }else{
                  return back()->with('alert-danger','File Empty');

                }
              }else{
                return back()->with('alert-danger','File required');

              }
            }

            return redirect()->to(route('home.profile'));
          }



          public function forget_password_update(Request $request){
            $method = $request->method();
            if($method == 'post' || $method == 'POST'){

              $mobile = isset($request->mobile) ? $request->mobile :'';
              $otp = isset($request->otp) ? $request->otp :'';
              $password = isset($request->password) ? $request->password :'';
              $confirm_password = isset($request->confirm_password) ? $request->confirm_password :'';

              User::where('phone',$mobile)->update(['password'=>bcrypt($password)]);

              return redirect()->to(route('home.login'))->with('alert-success', 'Password Changed successfully');


            }




          }


          public function dashboard(Request $request){
            $data = [];
            $user_id = isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
            $courses = Course::where('status',1)->latest()->get();
            $data['courses'] = $courses;
            $data['exam'] = Exam::select('id')->count();
            $data['course'] = Course::select('id')->count();

            $data['attempt_exam'] = AttemptExam::select('id')->where('user_id',$user_id)->where('exam_status','completed')->count();
        



            return view('front.home.dashboard',$data);

          }

          public function exam_list(Request $request){
            $data = [];

            $courses = Course::where('status',1)->latest()->get();
            $data['courses'] = $courses;

            return view('front.home.exam_list',$data);

          }
          public function exam_list_details(Request $request){
            $data = [];
            $course_id = isset($request->course_id) ? $request->course_id :'';

            $exams = Exam::where('course_id',$course_id)->latest()->paginate(15);
            $courses = Course::where('id',$course_id)->first();

            $data['exams'] = $exams;
            $data['courses'] = $courses;


            return view('front.home.exam_list_details',$data);

          }


          public function exam_details(Request $request){
           $data = [];
           $exam_id = isset($request->exam_id) ? $request->exam_id :'';
           $user_id = isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';

           $exams = Exam::where('id',$exam_id)->first();
           $data['status'] = 'N';
           $exist = [];
           if(!empty($user_id)){
             $exist = DB::table('user_exam')->where('exam_id',$exams->id)->where('user_id',$user_id)->first();

           }

           if(!empty($exist)){
            $data['status'] = 'Y';
          }


          $data['exams'] = $exams;

          //prd($data);
          return view('front.home.exam_details',$data);
        }







        public function about(Request $request){
          $data = [];

          return view('front.home.about',$data);

        }



        public function refund(Request $request){
          $data = [];

          return view('front.home.refund',$data);

        }



        public function contact(Request $request){
          $data = [];

          return view('front.home.contact',$data);

        }

        public function terms(Request $request){
          $data = [];

          return view('front.home.terms',$data);

        }


        public function privacy(Request $request){
          $data = [];

          return view('front.home.privacy',$data);

        }



        public function my_exam(Request $request){
          $data = [];

          return view('front.home.my_exam',$data);

        }


        public function upcoming_exam(Request $request){
          $data = [];
          $user_id = Auth::guard('appusers')->user()->id;

          // $exams = PaidUser::where('user_id',$user_id)->latest()->get();
          $exams = Exam::where('start_date','>',date('Y-m-d'))->get();
          $data['exams'] = $exams;

          return view('front.home.upcoming_exam',$data);

        }




        public function result_details(Request $request){
          $data = [];
          $user_id = Auth::guard('appusers')->user()->id;
          $exam_id = isset($request->exam_id) ? $request->exam_id :'';

          $exams = Exam::where('id',$exam_id)->first();
          $ranks = Rank::where('exam_id',$exam_id)->where('user_id',$user_id)->first();


          $results = Rank::where('exam_id',$exam_id)->orderBy('rank','asc')->limit(10)->get();


          $attempted_count = Answer::where('exam_id',$exam_id)->where('user_id',$user_id)->count();

          $data['exams'] = $exams;
          $data['ranks'] = $ranks;
          $data['results'] = $results;
          $data['attempted_count'] = $attempted_count;
          return view('front.home.result_details',$data);

        }


        public function exam_results(Request $request){
          $data = [];
          $exam_id = isset($request->exam_id) ? $request->exam_id :'';

          $results = Rank::where('exam_id',$exam_id)->orderBy('rank','asc')->limit(50)->get();

          $data['results'] = $results;



          return view('front.home.result_details_with_rank',$data);
        }

        public function my_result(Request $request){
          $data = [];
          $user_id = Auth::guard('appusers')->user()->id;

          $attempted = AttemptExam::where('user_id',$user_id)->where('exam_status','completed')->get();
          
          $data['attempted'] = $attempted;

          return view('front.home.my_result',$data);

        }


        public function exam_instruction(Request $request){
          $data = [];
          $exam_id = isset($request->exam_id) ? $request->exam_id :'';
          $exams = Exam::where('id',$exam_id)->first();
          $data['exams'] = $exams;

          $exist = \App\AttemptExam::where('user_id',Auth::guard('appusers')->user()->id)->where('exam_id',$exam_id)->where('exam_status','completed')->first();

          if(!empty($exist)){
            return redirect(route('home.result_details',['exam_id'=>$exam_id]));
          }





          return view('front.home.exam_instruction',$data);

        }




        public function update_rank($examId){





          $rank = 1;
          $result = Rank::where(['exam_id'=>$examId])->orderBy('marks','desc')->get();
          foreach ($result as $key => $user_data){
            if ($key == 0){
              Rank::find($user_data->id)->update(['rank'=>($key + 1)]);

              $rank = $key + 1;
            }else{
              $previous_key = ($key - 1);

              if ($result[$key]->correct_ans==$result[$previous_key]->correct_ans) {

                Rank::find($user_data->id)->update(['rank'=>$rank]);
                $this->time_wise_rank($examId,$rank);
              }
              else{
                Rank::find($user_data->id)->update(['rank'=>($key + 1)]);
                $rank = $key + 1;
              }
            }
          }
        }

        public function time_wise_rank($examId,$rank){
          $result = Rank::where(['exam_id'=>$examId,'rank'=>$rank])->orderBy('time_taken','asc')->get();
          foreach ($result as $r){
            Rank::find($r->id)->update(['rank'=>$rank]);
            $rank += 1;
          }
        }


    // public function mark_wise_rank($examId,$rank){
    //       $result = Rank::where(['exam_id'=>$examId,'rank'=>$rank])->orderBy('marks','asc')->get();
    //       foreach ($result as $r){
    //         Rank::find($r->id)->update(['rank'=>$rank]);
    //         $rank += 1;
    //       }
    //     }






        public function start_exam(Request $request){





          $data = [];
          $exam_id = isset($request->exam_id) ? $request->exam_id :'';
          $question_count = isset($request->question_count) ? $request->question_count :1;

          $submit_exam = isset($request->submit_exam) ? $request->submit_exam :'';
          $exams = Exam::where('id',$exam_id)->first();
          $user_id = Auth::guard('appusers')->user()->id;
          $total_question = $exams->no_of_questions;

          $attempt_no_of_question = Answer::where('user_id',$user_id)->where('exam_id',$exam_id)->count();


          $exist = \App\AttemptExam::where('user_id',Auth::guard('appusers')->user()->id)->where('exam_id',$exam_id)->where('exam_status','completed')->first();

          if(!empty($exist)){
            return redirect(route('home.result_details',['exam_id'=>$exam_id]));
          }

          if($submit_exam == 1){
               AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->update(['exam_status'=>'completed','end_time'=>date('Y-m-d H:i:s')]);
            /////////////////////Rank Calculation///////////////////
            $final_rank = CustomHelper::rank($user_id , $exam_id);
            $this->update_rank($exam_id);
            return redirect()->to(route('home.thanku',['exam_id'=>$exam_id]));
          }


          if($exams->no_of_questions < $attempt_no_of_question){
            AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->update(['exam_status'=>'completed','end_time'=>date('Y-m-d H:i:s')]);
            /////////////////////Rank Calculation///////////////////
            $final_rank = CustomHelper::rank($user_id , $exam_id);
            $this->update_rank($exam_id);
            //return redirect()->to(route('home.thanku'));
          }
          $dbArray = [];
          $dbArray['user_id'] = $user_id;
          $dbArray['exam_id'] = $exam_id;
          $dbArray['exam_status'] = 'attempted';
          $dbArray['start_time'] = date('Y-m-d H:i:s');
          $exist = AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->where('exam_status','attempted')->first();
          if(empty($exist)){
            AttemptExam::insert($dbArray);
          }
          $method = $request->method();
          $difficulti_level = 1;
          if($method == 'post' || $method == 'POST'){
           // prd($request->toArray());
            $question_id = isset($request->question_id) ? $request->question_id :'';
            $exam_id = isset($request->exam_id) ? $request->exam_id :'';
            $user_id = isset($request->user_id) ? $request->user_id :'';
            $option = isset($request->option) ? $request->option :'';
            $quest = Question::where('id',$question_id)->first();
            $dbArray1 = [];
            $dbArray1['status'] = 0;
            $difficulti_level =  $quest->difficulti_level;
            if(!empty($quest)){
              if($option == $quest->right_option){
                $dbArray1['status'] = 1;
                if($quest->difficulti_level == 1){
                  $difficulti_level = 2;
                }
                if($quest->difficulti_level == 2){
                  $difficulti_level = 3;
                }
                if($quest->difficulti_level == 3){
                  $difficulti_level = 3;
                }
              }else{
                $dbArray1['status'] = 0;
                if($quest->difficulti_level == 1){
                  $difficulti_level = 1;
                }

                if($quest->difficulti_level == 2){
                  $difficulti_level = 1;
                }

                if($quest->difficulti_level == 3){
                  $difficulti_level = 2;
                }
              }
            }
            $dbArray1['user_id'] = $user_id;
            $dbArray1['exam_id'] = $exam_id;
            $dbArray1['question_id'] = $question_id;
            $dbArray1['option_no'] = $option;
            Answer::insert($dbArray1);
            $question_count = $question_count + 1;
          }



          if($question_count > $exams->no_of_questions){
               AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->update(['exam_status'=>'completed','end_time'=>date('Y-m-d H:i:s')]);
            /////////////////////Rank Calculation///////////////////
            $final_rank = CustomHelper::rank($user_id , $exam_id);
            $this->update_rank($exam_id);
            return redirect()->to(route('home.thanku',['exam_id'=>$exam_id]));


            
          }


          $que_id =  $this->get_question($user_id,$total_question,$difficulti_level);
          $question = [];
          if($que_id == ''){
            AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->update(['exam_status'=>'completed','end_time'=>date('Y-m-d H:i:s')]);
            /////////////////////Rank Calculation///////////////////
            $final_rank = CustomHelper::rank($user_id , $exam_id);
            $this->update_rank($exam_id);
            return redirect()->to(route('home.thanku',['exam_id'=>$exam_id]));
          }
          else{
           $questions = Question::where('id',$que_id)->first();
           $question = $questions;
         }


        $correct = Answer::where('user_id',$user_id)->where('exam_id',$exam_id)->where('status',1)->count();

        $skip = $exams->no_of_questions - $attempt_no_of_question;


         
         $data['question_count'] = $question_count;
         $data['attempt_no_of_question'] = $attempt_no_of_question;
         $data['exams'] = $exams;
         $data['question'] = $question;
         $data['correct'] = $correct;
         $data['skip'] = $skip;
         return view('front.home.start_exam',$data);
       }


       private function get_question($user_id,$total_question,$difficulti_level)
       {    

        $attempted = Answer::select('question_id')->where('user_id', $user_id)->get();
        $attempt_ques = array();

        if(!empty($attempted)){
          foreach($attempted as $attemp){
            $attempt_ques[] = $attemp->question_id;
          }
        }     
        /////////////////// LEVELWISE QUESTIONS ///////////////////////
        if(!empty($attempt_ques)){
          $question = Question::where('difficulti_level', $difficulti_level)
          ->where('created_at' , ">=" , Carbon::now()->subMonths(3))
          ->whereNotIn('id', $attempt_ques)
          ->where('status',1)
          ->where('is_delete',0)
          ->inRandomOrder()
          ->first();
        }else{
         $question = Question::where('difficulti_level', $difficulti_level)
         ->where('created_at' , ">=" , Carbon::now()->subMonths(3))
         ->inRandomOrder()
         ->where('status',1)
         ->where('is_delete',0)
         ->first();
       }

       if(!empty($question)){
        return $question->id;
      }else{
        return '';
      }
    } 











    //   private function get_question($user_id,$exam_id,$difficulti_level,$no_of_questions){
    //     $questions = Question::where('difficulti_level',$difficulti_level)->inRandomOrder()->first();

    //     $question_count = Question::where('is_delete',0)->count();



    //     $i = 0;
    //     if(!empty($questions)){
    //       $exist = Answer::where('user_id',$user_id)->where('exam_id',$exam_id)->where('question_id',$questions->id)->first();
    //       if(empty($exist)){
    //         return $questions->id;
    //       }else{
    //        $i++;
    //        if($i<$no_of_questions){
    //          //return $this->get_question($user_id,$exam_id,$difficulti_level,$no_of_questions);
    //        }else{
    //         return '';
    //       }

    //     }
    //   }

    // }









    public function thanku(Request $request){
     $data = [];
     $exam_id = isset($request->exam_id) ? $request->exam_id :'';
     $user_id = Auth::guard('appusers')->user()->id;

     $attempt = Rank::where('exam_id',$exam_id)->where('user_id',$user_id)->first();

     $data['correct_ans'] = $attempt->correct_ans ?? '';
     $data['wrong_ans'] = $attempt->wrong_ans ?? '';
     $data['skipped_ans'] = $attempt->skipped_ans ?? '';
     return view('front.home.thanku',$data);

   }



        public function registration_process(Request $request){
          $data = [];

          return view('front.home.registration_process',$data);

        }




         public function faqs(Request $request){
          $data = [];
           $faqs = Faq::where('status',1)->latest()->get(); 
        $data['faqs'] = $faqs;

          return view('front.home.faq',$data);

        }
    public function thankyou(Request $request){
    
     return view('front.home.thankyou');

   }
    public function contact_form(Request $request){
         
    /* prd($request->toArray());*/

      $method = $request->method();
      $data= [];
      if ($method == 'POST' || $method == 'post') {
        $rules= [];
        $rules['name']  = 'required';
        $rules['email']  = 'required|email'; 
        $rules['phone']  = 'required|number';
        $rules['subject']  = 'required';
        $rules['message1']  = 'required';

          $name = $request->name;
          $email = $request->email;
          $phone = $request->phone;
          $subject = $request->subject;
          $message1 = $request->message1;
           $email1 = 'anisha@teknikoglobal.com';
        if(!empty($email)){
            $message1 = 'Hi! '.$name;
            $subject1 = 'New Enquiry';
            $fromEmail = $email;
            $toEmail = $email1;
            $data['name'] = $name;
            $data['email'] = $email;
            $data['phone'] = $phone;
            $data['subject'] = $subject;
            $data['message1'] = $request->message1;
            $result = CustomHelper::sendEmail('emails.new_enquiry',$data, $toEmail, $fromEmail,$fromEmail, $subject1);
            if ($result) {
               return redirect()->to(route('home.thankyou'));
            }else{
              echo "Something went wrong";
            }
        
        }

      }
        }


 }
