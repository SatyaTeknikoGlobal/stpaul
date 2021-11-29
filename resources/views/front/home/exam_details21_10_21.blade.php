@include('front.common.header')
<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>Exam Description</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 

$BackUrl = CustomHelper::BackUrl();


?>
@include('snippets.errors')
@include('snippets.flash')
<div class="container-fluid no-padding contactus-section section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="exam-list">

                    <h2 class="mb-3"> {{$exams->title ??''}} </h2> 
                    <h4>
                        <b>{{date("F d, Y ", strtotime($exams->start_date))}}</b>
                    </h4>

                    <!-- <p>
                        Below is the list of competitive exams with dates for 12th pass, graduation level, law,
                        engineering, banking, and arts field candidates:
                    </p> -->
                    <p>
                      {!!$exams->description!!}
                  </p>


                  <?php if($exams->start_date >= date('Y-m-d')){?>



                  <?php if($status == 'N'){
                     if(isset(Auth::guard('appusers')->user()->id)){
                        ?>
                        <button type="submit" id="buy_now" class="btn btn-primary" style="padding:11px 56px;">
                            <a href="#" style="font-size:1.75rem; font-weight: 500;">Register For Exam</a>
                        </button>
                    <?php }else{?>
                        <a href="{{route('home.login',['back_url'=>$BackUrl])}}" id=""><button type="submit" class="btn btn-primary" style="padding:11px 56px;">
                            Login
                        </button></a>
                    <?php }}
                    elseif($status == 'Y'){
                        if(isset(Auth::guard('appusers')->user()->id)){
                            ?>
                            <button type="submit submit-btn" class="btn btn-primary" style="padding:11px 56px;">
                                <!-- <a href="#" id="">Start Exam</a> -->
                                <a href="{{route('home.exam_instruction',['exam_id'=>$exams->id])}}" id="" style="font-size: 19px;">Start Exam</a>
                            </button>

                        <?php }else{?>
                          <a href="{{route('home.login',['back_url'=>$BackUrl])}}" id=""><button type="submit" class="btn btn-primary" style="padding:11px 56px;font-size: 19px;">
                            Login
                        </button></a>
                        </button>
                    <?php }}?>





                <?php }else{?>

                           
                             <a href="#" class="font"  style="font-size:15px !important; font-weight: 500;">Exam Completed</a>
                          



                <?php }?>
                </div>

            </div>
        </div>

    </div>
</div>


<?php if(isset(Auth::guard('appusers')->user()->id)){?>
    <form id="payment_form" action="{{route('home.exam_payment')}}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="exam_amount" value="{{$exams->price}}" id="exam_amount"> 
      <input type="hidden" name="exam_id" value="{{$exams->id}}" id="exam_id"> 
      <input type="hidden" name="transaction_id" value="" id="transaction_id"> 
      <input type="hidden" name="user_id" value="{{Auth::guard('appusers')->user()->id}}" id="user_id"> 

      
  </form>
<?php }?>





<style>
.submit-btn{
    padding: 0px;
}

.exam-list p {
    font-size: 20px;
    margin-bottom: 20px;
}

        /* .exam-list ul li {
            list-style-type: none;
    font-size: 18px;
    margin-bottom: 21px;
    box-shadow: -1px 0px 15px rgb(25 25 25 / 10%);
    padding: 28px 14px;


        }
        .exam-list ul li b{
            color: #2d3092;

            } */

            .exam-list ul {
                margin-bottom: 40px;
            }

            .exam-list ul li {
                margin-bottom: 15px;
            }

            .exam-list h5 {
                font-size: 20px;
            }

        /* .btn-primary a{
            color:#fff
            } */
            .enroll,
            .enroll b {
                font-size: 16px;
                margin-left: 23px;
                text-decoration: underline;
                color: red;
            }
            .exams a{
              text-decoration: none;
              color: #fff;
          }
          .categories-area .single-cat .cat-cap h5>a{
              margin-bottom: 5px;
          }
          .categories-area .single-cat:hover h5 b{
              color: #fff;
          }
          .categories-area .single-cat .cat-cap a{
              color: #fff;
          }
          .btn-primary a{
            color: #fff;
        }
    </style>

    @include('front.common.footer')


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <script type="text/javascript">
     
        $("#buy_now").click(function(){

            var total = $('#exam_amount').val();
        //alert(total);
        if(total <=0){
            return false;
        }else{

          var name = "{{Auth::guard('appusers')->user()->name ??''}}";
          var mobile = "{{Auth::guard('appusers')->user()->mobile ??''}}";
          var email = "{{Auth::guard('appusers')->user()->email ?? ''}}";

          var logoUrl = "{{asset('public/assets/web/img/logo/logo.png')}}";
          var currSel = $(this);
          var options = {
        //rzp_test_AU0RNdkjA3eYpN
        // rzp_live_ZiF0ZWN0ny4Flv
       /* key: "rzp_test_E4R95mxJqZPnrc",*/
        key: "{{env('RAZORPAY_APIKEY_TEST')}}",
        amount: total * 100,
        id: "<?php echo rand(0000,9999)?>",
        name: 'STPAUL',
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
        $('#payment_form').submit();
        //submitPaymentForm(transaction_id);
    }
</script>