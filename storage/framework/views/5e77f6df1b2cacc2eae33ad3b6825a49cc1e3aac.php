
<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


<div class="container no-padding contactus-section  section-padding30">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 style="margin-top: 0px;margin-bottom: 30px;">Register</h2>
            <div class="getintouch">
                <span></span>



                <form class="contactus-form" id="signupform" method="post" enctype="multipart/form-data" action="<?php echo e(route('home.register')); ?>">

                <?php echo e(csrf_field()); ?>


                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="name">Name <span class="required">*</span></label>
                            <input class="form-control"  placeholder="Enter your name"
                            name="name" type="text" id="name" value="<?php echo e(old('name')); ?>">
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" placeholder="eg: foo@bar.com" name="email" type="text"
                            id="email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="mobile">Phone Number*</label>
                            <input class="form-control" placeholder="9191919191" name="phone" type="text"
                            id="mobile" value="<?php echo e(old('phone')); ?>">
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'phone'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="aadhar-card">Aadhar Card or Pan Number*</label>
                            <input class="form-control" placeholder="XXXXX" name="id_card" type="text"
                            id="card" value="<?php echo e(old('id_card')); ?>">
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'id_card'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                      <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="aadhar-card">Profile Image</label>
                            <input class="form-control" placeholder="XXXXX" name="image" type="file"
                            id="image" >
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'image'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                     <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="password">Password*</label>
                            <input class="form-control" placeholder="******" name="password" type="password"
                            id="password" >
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                     <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-group">
                            <label for="mobile">Confirm Password*</label>
                            <input class="form-control" placeholder="******" name="confirm_password" type="password"
                            id="confirm_password" >
                        </div>
                        <?php echo $__env->make('snippets.errors_first', ['param' => 'confirm_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                  <div class="form-group">
                                      <label for="referal">Referal Code</label>
                                      <input class="form-control" placeholder="Referal Code" name="referral_code" type="text"
                                      id="referal" >


                                  </div>
                                  <?php echo $__env->make('snippets.errors_first', ['param' => 'referral_code'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

                               <button type="submit" style="width:100%" class="btn btn-primary">Reister</button>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group text-left">
                                <a href="<?php echo e(route('home.login')); ?>"
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

<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script type="text/javascript">
    $("#exam_id").change(function(){
        var exam_id = $(this).val();
        var _token = '<?php echo e(csrf_token()); ?>';
        $.ajax({
          url: "<?php echo e(route('home.get_exam_details')); ?>",
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
</script><?php /**PATH /home/stpaul/public_html/resources/views/front/register.blade.php ENDPATH**/ ?>