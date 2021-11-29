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


$imgUrl = asset('public/assets/front/images/avatars/1.jpg');
// if(!empty(Auth::guard('appusers')->user()->image)){
// $imgUrl = Auth::guard('appusers')->user()->image;
// }
?>
<!doctype html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Education </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('public/assets/web/img/favicon.png')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/web/css/bootstrap.css')); ?>" />
    <!-- <link rel="stylesheet" href="<?php echo e(asset('public/assets/web/css/A.style.css.pagespeed.cf.pn9YGtjreM.css')); ?>"> -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/web/css/style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/web/css/themify-icon.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>


    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="<?php echo e(asset('public/assets/web/img/logo/loder.png')); ?>" alt="">
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
            <div class="container-fluid">
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
                        <a href="tel:+919652252233" title="9652252233"><i class="fa fa-phone"
                          aria-hidden="true"></i>+91 9652252233</a>
                        </li>
                        <li class="app-icon">
                          <a href="" style="margin-right:10px;">
                            <img src="<?php echo e(asset('public/assets/web/img/android.png')); ?>" alt="android">
                          </a>
                          <a href="">
                            <img src="<?php echo e(asset('public/assets/web/img/ios.png')); ?>" alt="ios">
                          </a>
                        </li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="header-bottom header-sticky">
              <div class="container-fluid">
                <div class="logo d-none d-lg-block">

                  <a href="<?php echo e(url('/')); ?>">

                    <img src="<?php echo e(asset('public/assets/web/img/logo/logo.png')); ?>" alt="logo">
                    St.Paul's <span class="span">Education Academy</span>
                  </a>
                </div>

                <div class="menu-wrapper">

                  <div class="logo logo2 d-block d-lg-none">

                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('public/assets/web/img/logo/logo.png')); ?>" alt="logo">
                    </a>
                    <!-- St.Paul's<span>Education Academy</span> -->
                  </div>

                  <div class="main-menu d-none d-lg-block">
                    <nav>
                      <ul id="navigation">
                        <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('home.exam_list')); ?>">Exams</a></li>
                        <li><a href="<?php echo e(route('home.about')); ?>">About Us</a></li>


                        <li><a href="<?php echo e(route('home.contact')); ?>">Contact Us</a></li>
                    <?php if(!empty(Auth::guard('appusers')->user())){?>

                        <li><a href="<?php echo e(route('home.profile')); ?>" style="text-decoration: underline;">My Profile</a></li>
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
                  <ul>
                    <?php if(empty(Auth::guard('appusers')->user())){?>
                      <li><a href="<?php echo e(route('home.login')); ?>"><i class="fa fa-user"></i>Sign In</a></li>
                      <li><a href="<?php echo e(route('home.register')); ?>"><i class="fa fa-lock" aria-hidden="true"></i>Register</a>
                      </li>
                    <?php }else{?>
                    <!-- <li><a href="#"><i class="ti-user"></i> User</a>
                      <ul class="submenu">
                        <li><a href="<?php echo e(route('home.dashboard')); ?>">Dashboard</a></li>
                        <li><a href="<?php echo e(route('home.logout')); ?>">Logout</a></li>
                      </ul>
                    </li> -->


                    <ul class="list-inline float-right mb-0">
                  <li class="list-inline-item dropdown notif show">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="true">
                      <img src="https://lh3.googleusercontent.com/proxy/66iB4K8v3pZ7n9JzHrXqWaSWsqjGVviJYHdL4dzOCDnALPP6Q0m3OLRYQlfh_JtG78I4z9uKrb9i6m80i9nCBrKT" alt="Profile image" height="30px" width="30px" style="border-radius: 65px;" class="avatar-rounded">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" style="will-change: transform; position: absolute; transform: translate3d(-108px, 50px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                      <!-- item-->
                      <div class="dropdown-item noti-title">
                        <h5 class="text-overflow">
                          <small>Hello, <?php echo e(Auth::guard('appusers')->user()->name ??''); ?></small>
                        </h5>
                      </div>

                      <!-- item-->
                      <a href="<?php echo e(route('home.dashboard')); ?>" class="dropdown-item notify-item">
                        <i class="fas fa-user"></i>
                        <span>Dashboard</span>
                      </a>

                      <!-- item-->
                      <a href="<?php echo e(route('home.logout')); ?>" class="dropdown-item notify-item">
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


          <div class="col-8">
            <div class="mobile_menu d-block d-lg-none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>
<style>
.header-info-right {
  position: relative;
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
  margin-left: 140px;
}
</style><?php /**PATH /home/stpaul/public_html/resources/views/front/common/header.blade.php ENDPATH**/ ?>