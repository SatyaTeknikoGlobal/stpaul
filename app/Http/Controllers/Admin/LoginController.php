<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CustomHelper;
use DB;


class LoginController extends Controller{
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index(Request $request){

        if (auth()->user()){
         return redirect('admin');
     }

     $method = $request->method();

     if($method == 'POST' || $method == 'post'){
        $rules = [];
        $rules['username'] = 'required';
        $rules['password'] = 'required';

        $this->validate($request, $rules);
        $credentials = $request->only('username', 'password');



        // 
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]))
        {
            //prd($request->toArray());
            $request->session()->regenerate();
            return redirect('admin');
        }else{
            return view('admin/login/index');

        }



    }

    return view('admin/login/index');
}


// public function auth(Request $request){

//         //prd($request->toArray());
//     $this->validate($request, [
//         'username' => 'required|email',
//         'password' => 'required',
//     ]);
//     if (auth()->guard('admin')->attempt(['email' => $request->input('username'), 'password' => $request->input('password')]))
//     {
//         return redirect('admin');
//     }
//     else{
//             //dd('your username and password are wrong.');

//         $errors['err_msg'] = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Your username or password is wrong</strong>.</div>';

//         return back()->with($errors);
//     }
// }

public function logout(Request $request){


    // auth()->user('admin')->logout();
    Auth::logout();

    $request->session()->invalidate();

    return redirect('/admin');
}




public function forget_password(Request $request){

 $method = $request->method();

 if($method == 'POST' || $method == 'post'){
    $rules = [];
    $rules['email'] = 'required|email';


    $this->validate($request, $rules);

    $email = $request->email;

    if(!empty($email)){
           // DB::enableQueryLog(); // Enable query log

        $user = Admin::where('email',$email)->first();

           // dd(DB::getQueryLog()); // Show results of log

        if(!empty($user)){ 

            $forgot_token = generateToken(40);


            $to_email = $email;
            $subject = 'Reset password - Stpauls Education Academy';

            $from_email = 'satyasahoo.abc@gmail.com';
            $reset_link = '<a href="'.url('admin/reset?t='.$forgot_token).'">Click here to reset password</a>';

            $email_data = [];
            $email_data['reset_link'] = $reset_link;

            $is_mail = CustomHelper::sendEmail('emails.reset_password', $email_data, $to=$to_email, $from_email, $replyTo = $from_email, $subject);

            if($is_mail && !empty($user)){


                $user->forgot_token = $forgot_token;

                $user->save();

                $msg_type = 'success';

                $message = 'Reset password link has been sent to your email, please check.';
            }


                //return redirect(url('account/forgot'))->with('alert-'.$msg_type, $message);

            return redirect()->back()->with('alert-success', $message);   



        }else{
           return redirect()->back()->with('alert-danger', 'Email Not Exist');   

       }
   }


}

return view('admin/login/forget_password');


}


public function reset_old(Request $request){
   $data = [];
   $token = (isset($request->t))?$request->t:'';




   return view('admin.login.reset', $data);
}




public function reset(Request $request){

    $data = [];

    $isVerified = false;
    $isValidToken = false;

    $token = (isset($request->t))?$request->t:'';

    if(!empty($token)){

        $user = Admin::where('forgot_token', $token)->first();

        if(!empty($user)){

            $isValidToken = true;

            $method = $request->method();

            if($method == 'POST' || $method == 'post'){


                    //prd($request->toArray());
                $rules = [];

                $rules['email'] = 'required|email';
                $rules['password'] = 'required';
                $rules['confirm_password'] = 'required|same:password';

                $this->validate($request, $rules);


                $email = $request->email;

                $user = Admin::where('email', $email)->first();



                $forgot_token = generateToken(40);
                if(!empty($user)){
                if($user->email == $email){

                        //prd($user->toArray());

                    $password = bcrypt($request->password);

                    $user->password = $password;
                    $user->forgot_token = '';

                    $isSaved = $user->save();

                    if($isSaved){
                        $msg_type = 'success';
                        $message = 'Your password has been updated successfully, please login.';
                    }

                    if(!empty($referer)){
                        return redirect(url('admin/login'))->with('alert-'.$msg_type, $message);
                    }

                    return redirect(url('admin/login'))->with('alert-'.$msg_type, $message);
                }

            }else{
                    return redirect()->back()->with('alert-danger', 'User Not Exist');   

            }


            }
        }



            /*$user = User::where('verify_token', $token)->first();

            if(!empty($user) && count($user) > 0){
                //prd($user->toArray());
                $user->verify_token = '';
                $user->save();

                $isVerified = true;
            }*/
        }

        $data['isVerified'] = $isVerified;
        $data['isValidToken'] = $isValidToken;
        $data['token'] = $token;


        return view('admin.login.reset', $data);
    }













    /*End of controller */
}