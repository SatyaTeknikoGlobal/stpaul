
@include('front.common.header')

<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap hero-cap2 text-center">
              <h2>Login</h2>
          </div>
      </div>
  </div>
</div>
</div>
</div>

<div class="container-fluid no-padding contactus-section section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="getintouch">

                        @include('snippets.errors')
                        @include('snippets.flash')


                    <h3 style="margin-bottom: 20px;margin-top: 20px;">Login</h3>
                    <form class="contactus-form" id="signupform" method="post"
                    action="{{route('home.login')}}">

                    {{csrf_field()}}

                    <input type="hidden" name="back_url" value="{{$back_url ?? ''}}">


                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="text" required="" placeholder="Email" id="email"
                                class="form-control" name="email">
                            </div>
                            @include('snippets.errors_first', ['param' => 'email'])

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="password" required="" placeholder="******" id="password"
                                class="form-control" name="password">
                            </div>
                            @include('snippets.errors_first', ['param' => 'password'])

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-icon">
                                <input type="submit" name="post" title="Send" value="Login"
                                style="position: relative;margin-bottom: 10px;width:100%;font-weight: 500;">

                                <p class="messege">Not registered? <a href="{{route('home.register')}}"
                                    title="Create An Account">Create an account</a></p>

                                </div>
                                <div class="form-group text-center">
                                    <a href="{{route('home.forgot_password')}}" title="Forgot Password">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="alert-msg" id="alert-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<style type="text/css">
    body{
        font-size: 18px !important;
    }
    .form-control,
    .form-group input{
        font-size: 17px;
    }
    .getintouch{
          box-shadow: 2px 1px 20px 0px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 22%);
    }
</style>
@include('front.common.footer')
