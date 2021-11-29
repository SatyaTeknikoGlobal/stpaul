<style>
.app-icon {
  margin-left: 110px;
}

.dropdown-menu{
  width: auto !important;
}

.dropdown-menu{
  height: 200px;
}
.dropdown-menu .dropdown-item h5 {
  font-size: 17px;
  text-align: center;
  font-weight: 500;
  color: #0d10819e;
}
.dropdown-item{
  margin-bottom: 14px;
}

.header-info-right {
  position: relative;
}
.header-info-right ul{
 margin-bottom: 20px;
}

.submenu {
  position: absolute;
  width: 145px;
  background: rgba(255, 255, 255, .8);
  left: 0;
  top: 90%;
  visibility: hidden;
  opacity: 0;

}

.header-area .header-top .header-info-right ul li {
  position: relative;
}

.header-info-right ul li {
  position: relative;
}

.main-header .header-top .header-info-right ul>li:hover>ul.submenu {
  visibility: visible;
  opacity: 1;
  top: 100%;
  z-index: 333;
  padding: 20px 20px;
}

.header-info-right ul>li:hover>ul.submenu {
  visibility: visible;
  opacity: 1;
  top: 100%;
  z-index: 333;
  padding: 20px 20px;
}

.app-icon a img {
  width: 125px;
  margin-left: auto;
}
.app-icon{
  margin-left: 119px;
}

.header-info-right ul{
 margin-bottom: 20px;
}


@media (max-width:767px) {

  .header-info-right ul{
   margin-bottom: 0px;
 }
 .mobile-p-0{
  padding: 0px;
}
.header-area .header-bottom .menu-wrapper{
  padding: 0 11px;
}

}
@media (max-width:992px) {
 .mobile-p-0{
  padding: 0px;
}
.main-header .container{
  width: 100%;
  margin: 0px;


} 
}
</style>

<?php 
// $page = '';
// $slug = isset($vendor->slug) ? $vendor->slug :'';
// $segments_arr = request()->segments();
// $seg1 = isset($segments_arr[0]) ? $segments_arr[0] :'';
// $seg2 = isset($segments_arr[1]) ? $segments_arr[1] :'';


$name = isset(Auth::guard('appusers')->user()->name) ? Auth::guard('appusers')->user()->name :'User';


// if($seg1 == $slug){
// 	$page = 'home';
// }if($seg2 == 'cart'){
// 	$page = 'cart';
// }

// $url = url('/').'/'.$slug;


// $imgUrl = asset('public/assets/front/images/avatars/1.jpg');
// if(!empty(Auth::guard('appusers')->user()->image)){
//  $imgUrl = Auth::guard('appusers')->user()->image;
//  }

$storage = Storage::disk('public');
$imgUrl = asset('public/assets/web/img/user.png');
$path = 'users/thumb/';
if(!empty(Auth::guard('appusers')->user()->photo)){
 $image = Auth::guard('appusers')->user()->photo;
 if($storage->exists($path.$image)){
  $imgUrl=url('storage/app/public/'.$path.'/'.$image);

}

}


?>
<!doctype html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> ST. PAUL'S </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/web/img/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('public/assets/web/css/bootstrap.css')}}" />
    <!-- <link rel="stylesheet" href="{{asset('public/assets/web/css/A.style.css.pagespeed.cf.pn9YGtjreM.css')}}"> -->
    <link rel="stylesheet" href="{{asset('public/assets/web/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('public/assets/web/css/themify-icon.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    









    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/web/assets/mobirise-icons/mobirise-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/tether/tether.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/soundcloud-plugin/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/dropdown/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/theme/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/carousel/assets2/mobirise/css/mbr-additional.css')}}" type="text/css">








  </head>

  <body>


    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="{{asset('public/assets/web/img/logo/loder.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>



    <header>

      <div class="header-area">
        <div class="main-header ">
          <div class="header-top d-none d-lg-block">

            <div class="header-left-social">
              <ul class="header-social">
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
              </ul>
            </div>
            <div class="container">
              <div class="col-xl-12">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="header-info-left">
                    <ul>
                      <li>
                        <a href="mailto:support@stpaulseducationacademy.com"
                        title="support@stpaulseducationacademy.com"><i class="fa fa-envelope"
                        aria-hidden="true"></i>Emailus: support@stpaulseducationacademy.com</a>
                      </li>
                      <li>
                        <a ><i class="fa fa-phone"
                          aria-hidden="true" style="color: #000!important; font-size: 14px;"></i>+91 9652252233 or 18003099090
                        </li>
                        
                        <li class="app-icon">
                          <a href="" style="margin-right:10px;">
                            <img src="{{asset('public/assets/web/img/android.png')}}" alt="android">
                          </a>
                          <a href="">
                            <img src="{{asset('public/assets/web/img/ios.png')}}" alt="ios">
                          </a>
                        </li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="header-bottom header-sticky">
              <div class="container mobile-p-0">
                <div class="logo d-none d-lg-block">

                  <a href="{{url('/')}}">

                    <img src="{{asset('public/assets/web/img/logo/logo.png')}}" alt="logo">
                    St.Paul's <span class="span">Education Academy</span>
                  </a>
                </div>

                <div class="menu-wrapper">

                  <div class="logo logo2 d-block d-lg-none">

                    <a href="{{url('/')}}"><img src="{{asset('public/assets/web/img/logo/logo.png')}}" alt="logo">
                    </a>
                    <!-- St.Paul's<span>Education Academy</span> -->
                  </div>

                  <div class="main-menu d-none d-lg-block">
                    <nav>
                      <ul id="navigation">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{route('home.exam_list')}}">Exams</a></li>
                        <li><a href="{{route('home.about')}}">About Us</a></li>


                        <li><a href="{{route('home.contact')}}">Contact Us</a></li>
                        <?php if(!empty(Auth::guard('appusers')->user())){?>
                          <li><a href="{{route('home.profile')}}" style="text-decoration: underline;">My Profile</a></li>
                        <?php }?>

                      </ul>
                    </nav>
                  </div>

                  <div class="header-search  d-lg-flex d-block">
                <!-- <form action="#" class="form-box f-right ">
                  <input type="text" name="Search" placeholder="Search Courses">
                  <div class="search-icon">
                    <i class="fas fa-search special-tag"></i>
                  </div>
                </form> -->
                <div class="header-info-right">
                  <ul class="">
                    <?php if(empty(Auth::guard('appusers')->user())){?>
                      <li><a href="{{route('home.login')}}"><i class="fa fa-user"></i>Sign In</a></li>
                      <li><a href="{{route('home.register')}}"><i class="fa fa-lock" aria-hidden="true"></i>Register</a>
                      </li>
                    <?php }else{?>
                    <!-- <li><a href="#"><i class="ti-user"></i> User</a>
                      <ul class="submenu">
                        <li><a href="{{route('home.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('home.logout')}}">Logout</a></li>
                      </ul>
                    </li> -->


                    <ul class="list-inline float-right">
                      <li class="list-inline-item dropdown notif show">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" aria-haspopup="false"  aria-expanded="true">
                          <img src="{{$imgUrl}}" alt="Profile image" height="30px" width="30px" style="border-radius: 65px;" class="avatar-rounded">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown" style="will-change: transform; position: absolute; transform: translate3d(-108px, 50px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                          <!-- item-->
                          <div class="dropdown-item noti-title">
                            <h5 class="text-overflow">
                             Hello, {{Auth::guard('appusers')->user()->name ??''}}
                           </h5>
                         </div>

                         <!-- item-->
                         <a href="{{route('home.dashboard')}}" class="dropdown-item notify-item">
                          <i class="fas fa-user"></i>
                          <span>Dashboard</span>
                        </a>

                        <a href="{{route('home.profile')}}" class="dropdown-item notify-item">
                          <i class="fas fa-user"></i>
                          <span>Profile</span>
                        </a>

                        <!-- item-->
                        <a href="{{route('home.logout')}}" class="dropdown-item notify-item">
                          <i class="fas fa-power-off"></i>
                          <span>Logout</span>
                        </a>
                      </div>
                    </li>
                  </ul>




                <?php }?>
              </ul>




              


            </div>
          </div>



        </div>


        <div class="col-12 mobile-p-0">
          <div class="mobile_menu d-block d-lg-none"></div>
        </div>
      </div>
    </div>
  </div>
</div>

</header>
