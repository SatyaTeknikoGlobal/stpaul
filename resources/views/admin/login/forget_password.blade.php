<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
       <link rel="shortcut icon" href="{{asset('public/assets/web/img/favicon.png')}}">

    <title>ST.PAUL'S Education Academy</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets1/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets1/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets1/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets1/lib/jqvmap/jqvmap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets1/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/assets1/css/app.css')}}" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>


<body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="card card-border-color card-border-color-primary">
              <div class="card-header"><img class="logo-img" src="{{asset('public/assets/web/img/favicon.png')}}" alt="logo" width="150" height="150" style="border-radius: 10px;"><span class="splash-description">Forgot Password</span></div>

                @include('snippets.errors')
                @include('snippets.flash')


              <div class="card-body">
                <form action="{{route('admin.forget_password')}}" method="post">
                {!! csrf_field() !!}
                  <div class="login-form">
                    <div class="form-group">
                      <input class="form-control" id="email" name="email" type="text" placeholder="Enter Email" autocomplete="off" value="{{old('email')}}">

                         @include('snippets.errors_first', ['param' => 'email'])

                    </div>
                
                    <div class="form-group row login-submit">
                      <div class="col-6"><button type="submit" class="btn btn-primary btn-xl">Submit</button></div>

                      <div class="col-6"><a href="{{url('admin/login')}}" >Already Have Account</a></div>

                       
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



