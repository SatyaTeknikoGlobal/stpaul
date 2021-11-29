

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

          <h3 style="text-transform: uppercase;"> {{$exams->title ??''}} </h3><br>
         <h3> <b>{{date("F d, Y ", strtotime($exams->start_date))}}</b></h3>
         <!--  <p>
            {!!$exams->description!!}
          </p> -->


          <?php if($exams->start_date >= date('Y-m-d')){?>



            <?php if($status == 'N'){
             if(isset(Auth::guard('appusers')->user()->id)){
              ?>
               <a href="#"  style="color: #fff;">
              <button type="submit" id="buy_now" class="btn btn-success" style="padding:11px 56px;">
               Register For Exam
              </button>
              </a>
            <?php }else{?>
              <a href="{{route('home.login',['back_url'=>$BackUrl])}}" id="" style="color: #fff;"><button type="submit" class="btn btn-success" style="padding:11px 56px;">
                Login
              </button></a>
            <?php }}
            elseif($status == 'Y'){
              if(isset(Auth::guard('appusers')->user()->id)){

                $exist = \App\AttemptExam::where('user_id',Auth::guard('appusers')->user()->id)->where('exam_id',$exams->id)->first();

                ?>
                <?php if(empty($exist)){

                  if($exams->start_date == date('Y-m-d')){
                  ?>
                   <a href="{{route('home.exam_instruction',['exam_id'=>$exams->id])}}" id="" style="color: #fff;">
                <button class="btn btn-success" style="padding:11px 56px;" >
                 Start Exam
                </button>
                </a>
              <?php }else{?>

                <a href="#"  id="">

                <button class="btn btn-primary" style="padding:11px 56px;"  data-toggle="modal" data-target="#startExam">
                  Start Exam
                 
                </button>
                </a>

              <?php }}else{?>
                  <a href="{{route('home.result_details',['exam_id'=>$exams->id])}}" id="" style="color: #fff;"><button class="btn btn-success" style="padding:11px 56px;" >
                 Check Result
                </button></a>

              <?php }?>

              <?php }else{?>
                <a href="{{route('home.login',['back_url'=>$BackUrl])}}" id="" style="color: #fff;"><button type="submit" class="btn btn-success" style="padding:11px 56px;">
                  Login
                </button></a>
              </button>
            <?php }}?>





          <?php }else{?>
            <button class="btn btn-success m-0" style="padding:11px 20px;">
           
            <a style="font-size: 19px; color: #fff;" ><i class="fas fa-check-double" aria-hidden="true" style="font-size: 19px; color: #fff;"></i> Exam Completed</a>
          </button>


          <?php }?>
        </div>

      </div>
    </div>

  </div>
</div>





<div id="startExam" class="modal fade" role="dialog" style="margin-top: 115px;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #696bb1;   border-bottom: none; ">
        <button type="button" class="close" data-dismiss="modal" style="    font-size: 25px;
        position: absolute;
        right: 11px;">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body text-center py-5"  style="background-color: #696bb1; height: 200px;">
       <div id="timer">
        <span id="days"></span>days
        <span id="hours"></span>hours
        <span id="minutes"></span>minutes
        <span id="seconds"></span>seconds
      </div>

      <h4 style="color:#fff" class="my-3">Exam Will Be Start on {{$exams->start_date}}</h4>
      <a href="{{url('/')}}"  class=" btn btn-warning" style="background: #ddbdbc; color: #000;"><b>Back To Home</b></a>
    </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
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
          .exam-list p {
            font-size: 18px;
            margin-bottom: 20px;
          }
		
@media (max-width: 575px){
#timer {
    font-size: 10px!important;
    letter-spacing: 1px!important;
}
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

            #timer {
              font-family: Arial, sans-serif;
              font-size: 20px;
              color: #fff;
              letter-spacing: -1px;
            }
            #timer span {
              font-size: 30px;
              color: #fff;
              margin: 0 3px 0 15px;
            }
            #timer span:first-child {
              margin-left: 0;
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
        /* key: "rzp_test_E4R95mxJqZPnrc",*/
        // key: "rzp_test_E4R95mxJqZPnrc",
        key: "rzp_live_ZiF0ZWN0ny4Flv",
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
    <script>
      	var timer;

      	var compareDate = new Date();
		compareDate.setDate(compareDate.getDate() + 7); //just for this demo today + 7 days
		timer = setInterval(function() {
		  timeBetweenDates(compareDate);
		}, 1000);

		function timeBetweenDates(toDate) {
			var exam_date = '{{$exams->start_date}}';/*
			var targetDate  = new Date(Date.UTC(2017, 0, 01));*/
		  	var dateEntered = toDate;

		  	var d = new Date(exam_date);
		  	var now = new Date();
		  	var difference = d.getTime() - now.getTime();

		  if (difference <= 0) {

		    // Timer done
		    clearInterval(timer);

		  } else {

		    var seconds = Math.floor(difference / 1000);
		    var minutes = Math.floor(seconds / 60);
		    var hours = Math.floor(minutes / 60);
		    var days = Math.floor(hours / 24);

		    hours %= 24;
		    minutes %= 60;
		    seconds %= 60;

		    $("#days").text(days);
		    $("#hours").text(hours);
		    $("#minutes").text(minutes);
		    $("#seconds").text(seconds);
		  }
		}
		</script>