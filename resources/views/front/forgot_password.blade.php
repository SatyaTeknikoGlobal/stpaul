
@include('front.common.header')

<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap hero-cap2 text-center">
              <h2>Forgot Password</h2>
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


                    <h3 style="margin-bottom: 20px;margin-top: 20px;">Forgot Password</h3>
                    <form class="contactus-form" id="forget_password" method="post"
                    action="{{route('home.forget_password_update')}}">

                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="username_field">
                            <label>Enter Mobile No</label>

                            <div class="form-group">

                                <input type="text" required="" placeholder="Enter Mobile No" id="mobile"
                                class="form-control" name="mobile">
                                <span class="mt-5 forget"><a id="send_otp">Send OTP</a></span>
                            </div>
                            @include('snippets.errors_first', ['param' => 'username'])

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" id="otp_field">
                            <label>Enter OTP</label>

                            <div class="form-group">
                                <input type="text" required="" placeholder="******" id="otp"
                                class="form-control" name="otp">
                                <span class="mt-5 forget"><a id="verify_otp">Verify Now</a></span>
                            </div>
                            @include('snippets.errors_first', ['param' => 'password'])
                        </div>


                        <div id="password_field">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                            <label>Enter Password</label>

                            <div class="form-group">
                                <input type="text" required="" placeholder="Enter Password" id="password"
                                class="form-control" name="password">
                            </div>
                            @include('snippets.errors_first', ['param' => 'password'])
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label>Enter Confirm Password</label>

                            <div class="form-group">
                                <input type="text" required="" placeholder="Enter Confirm Password" id="confirm_password"
                                class="form-control" name="confirm_password">
                            </div>
                                <span style="color:red;" id="pass_err"></span>

                            @include('snippets.errors_first', ['param' => 'confirm_password'])
                        </div>





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <a id="forget_password_form_submit"  class="btn btn-success">Submit</a>
                            </div>
                        </div>





                    </div>




                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
<style>
a:hover{
    text-decoration:none;
}
.forget{
    position: absolute;
    right: 17px;
    bottom: 14px;
}
</style>
@include('front.common.footer')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#otp_field').hide();
        $('#password_field').hide();
    });

    $('#send_otp').click(function(){
        var mobile = $('#mobile').val();
        if(mobile == ''){
            alert('Enter Mobile No');
            return false;
        }else{
            var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route('home.send_otp') }}",
                type: "POST",
                data: {mobile:mobile},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                success: function(resp){
                    if(resp.success){
                        alert(resp.message);
                        $('#mobile').prop("readonly", true);
                        $('#send_otp').hide();
                        $('#otp_field').show();

                    }
                    else{
                        alert(resp.message);

                    }

                }
            });
        }

    });


    $('#verify_otp').click(function(){
        var mobile = $('#mobile').val();
        var otp = $('#otp').val();
        if(mobile == ''){
            alert('Enter Mobile No');
            return false;
        }else if(otp ==''){
            alert('Enter OTP');
            return false;
        }
        else{
            var _token = '{{ csrf_token() }}';
            $.ajax({
                url: "{{ route('home.verify_otp') }}",
                type: "POST",
                data: {mobile:mobile,otp:otp},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                success: function(resp){
                    if(resp.success){
                        $('#otp').prop("readonly", true);
                        $('#verify_otp').hide();

                        $('#password_field').show();
                    }
                }
            });
        }

    });

    $('#forget_password_form_submit').click(function(){
        $('#pass_err').html('');
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        if(password != confirm_password){
            $('#pass_err').html('Password Should Be Match With Confirm Password');
            return false;
        }else{
            $('#forget_password').submit();
        }


    });


</script>