
@include('front.common.header')

<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap hero-cap2 text-center">
              <h2>Sign Up</h2>
          </div>
      </div>
  </div>
</div>
</div>
</div>


<div class="container contactus-section my-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
           
            <div class="getintouch">
                <span></span>
                 <h2 style="margin-top: 0px;margin-bottom: 30px;">Register</h2>



                <form class="contactus-form" id="signupform" method="post" enctype="multipart/form-data" action="{{route('home.register')}}">

                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="name">Name <span class="required">*</span></label>
                            <input class="form-control"  placeholder="Enter your name"
                            name="name" type="text" id="name" value="{{old('name')}}">
                        </div>
                        @include('snippets.errors_first', ['param' => 'name'])
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="email">Email address <span class="required">*</span></label>
                            <input class="form-control" placeholder="eg: foo@bar.com" name="email" type="text"
                            id="email" value="{{old('email')}}">
                        </div>
                        @include('snippets.errors_first', ['param' => 'email'])
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="mobile">Phone Number <span class="required">*</span></label> 
                            <input class="form-control" min="10" max="10" placeholder="9191919191" name="phone" type="text"
                            id="mobile" value="{{old('phone')}}">
                        </div>
                        @include('snippets.errors_first', ['param' => 'phone'])
                    </div>
                   <!--  <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="aadhar-card">Aadhar Card or Pan Number
                            
                        </label>
                            <input class="form-control" placeholder="XXXXX" name="id_card" type="text"
                            id="card" value="{{old('id_card')}}">
                        </div>
                        @include('snippets.errors_first', ['param' => 'id_card'])
                    </div> -->


                      <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="aadhar-card">Profile Image</label>
                            <input class="form-control" placeholder="XXXXX" name="image" type="file"
                            id="image" >
                        </div>
                        @include('snippets.errors_first', ['param' => 'image'])
                    </div>


                     <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="password">Password  <span class="required">*</span></label>
                            <input class="form-control" placeholder="******" name="password" type="password"
                            id="password" >
                        </div>
                        @include('snippets.errors_first', ['param' => 'password'])
                    </div>


                     <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="mobile">Confirm Password  <span class="required">*</span></label>
                            <input class="form-control" placeholder="******" name="confirm_password" type="password"
                            id="confirm_password" >
                        </div>
                        @include('snippets.errors_first', ['param' => 'confirm_password'])
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                  <div class="form-group">
                                      <label for="referal">Referal Code</label>
                                      <input class="form-control" placeholder="Referal Code" name="referral_code" type="text"
                                      id="referal" >


                                  </div>
                                  @include('snippets.errors_first', ['param' => 'referral_code'])
                              </div>




                        <?php /*
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="exam-name">Exam Name*</label>
                            <select name="exam_id" class="form-control" id="exam_id">
                                <option value="" selected disabled></option>
                                <?php if(!empty($exams)){
                                    foreach($exams as $exam){
                                        ?>
                                        <option value="{{$exam->id}}">{{$exam->title}}</option>

                                    <?php }}?>
                                </select>

                                @include('snippets.errors_first', ['param' => 'exam_id'])

                            </div>
                        </div>
                    
                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-group">
                                <label for="exam-date">Exam Date*</label>

                                      <!--   <select name="exam_date" class="form-control" id="exam_date">
                                            <option value=""></option>
                                        </select> -->
                                        <input type="text" name="exam_date" class="form-control" id="exam_date" readonly>

                                    </div>
                                    @include('snippets.errors_first', ['param' => 'exam_date'])
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                  <div class="form-group">
                                      <label for="referal">Referal Code</label>
                                      <input class="form-control" placeholder="Referal Code" name="referral_code" type="text"
                                      id="referal" >


                                  </div>
                                  @include('snippets.errors_first', ['param' => 'referral_code'])
                              </div>

                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group form-icon" >
                                 Payment of - <span id="exam_price">0/-</span>
                             </div>
                         </div>

    */?>
                        <!--  <input type="hidden" name="transaction_id" value="" id="transaction_id">
                         <input type="hidden" name="exam_amount" value="0" id="exam_amount"> -->

                         <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-icon" >

                               <button type="submit" style="width:100%" class="btn btn-primary">Register</button>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group text-left">
                                <a href="{{route('home.login')}}"
                                title="Already Have Account">Already Have Account ?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>

@include('front.common.footer')


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script type="text/javascript">
    $("#exam_id").change(function(){
        var exam_id = $(this).val();
        var _token = '{{ csrf_token() }}';
        $.ajax({
          url: "{{ route('home.get_exam_details') }}",
          type: "POST",
          data: {exam_id:exam_id},
          dataType:"JSON",
          headers:{'X-CSRF-TOKEN': _token},
          cache: false,
          success: function(resp){
            if(resp.status){
                $('#exam_date').val(resp.exams.exam_date);
                $('#exam_amount').val(resp.exams.price);
                $('#exam_price').html(resp.exams.price+' /-');
            }


        }
    });
    });

    $("#buy_now").click(function(){

        var total = $('#exam_amount').val();
        //alert(total);
        if(total <=0){
            return false;
        }else{

          var name = $('#name').val();
          var mobile = $('#mobile').val();
          var email = $('#email').val();

          var logoUrl = "https://gowisekart.com/admin/uploads/logo1575713051.png";
          var currSel = $(this);
          var options = {
        //rzp_test_AU0RNdkjA3eYpN
        key: "rzp_test_AU0RNdkjA3eYpN",
        amount: total * 100,
        id: "<?php echo rand(0000,9999)?>",
        name: 'GOWISEKART',
        image: logoUrl,
        "prefill": {
          "name": name,
          "contact": mobile,
          "email": email
      },
      handler: demoSuccessHandler
  }
  window.r = new Razorpay(options);
  var succ = r.open();
  if(succ){
    return false;
}

}

});




    function padStart(str) {
        return ('0' + str).slice(-2)
    }


    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
          padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
          );

        var transaction_id = transaction.razorpay_payment_id;
        $('#transaction_id').val(transaction_id);
        $('#signupform').submit();
        //submitPaymentForm(transaction_id);
    }
</script>
<style type="text/css">
    body{
        font-size: 18px !important;
    }
    .form-control{
        font-size: 17px;
    }
   .btn-primary, .btn-primary:active {
         font-size: 17px;
    }


     .getintouch{
          box-shadow: 2px 1px 20px 0px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 22%);
    }
    .required{
        color: red;
    }
</style>