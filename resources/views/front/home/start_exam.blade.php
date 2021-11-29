
<?php 
$user_id = Auth::guard('appusers')->user()->id;
$exam_id = $exams->id;
$exist = \App\AttemptExam::where('user_id',$user_id)->where('exam_id',$exam_id)->first();
if(!empty($exist)){
 $start_time = $exist->start_time;
}
$total_time_taken = $exams->no_of_questions * $exams->time_per_question;
$end_time = date('Y-m-d H:i:s',strtotime('+'.$total_time_taken.' seconds',strtotime($start_time)));
$end_time = date('M d, Y H:i:s',strtotime($end_time));
   // $start_time = date('M d, Y H:i:s',strtotime($start_time));
   // echo $end_time;
   // Jan 5, 2022 15:37:25
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>{{$exams->title ?? ''}} Exam Started</title>
   <script src="https://momentjs.com/downloads/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



   <link rel="stylesheet" href="{{asset('public/assets/web/css/bootstrap.css')}}" />
   <link rel="stylesheet" href="{{asset('public/assets/web/css/style.css')}}">
  <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('public/assets/web/css/themify-icon.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <style type="text/css">
    .modal-open .modal{
     overflow-x: hidden;
     overflow-y: hidden;
  }
  .btn{
   font-size: 16px;
   padding: 0.375rem .75rem;
    border-radius: 5px;
}
.quiz-container {
   background-color: #fff;
   border-radius: 10px;
   box-shadow: 0 0 10px 2px rgb(1 0 0 / 45%);
   overflow: hidden;
   margin: 15px 15px;
 height: 100%;
     overflow-y: scroll;

}
.quiz-header {
   padding: 3rem;
   border-right: 1px solid #00000069;
   height: 370px;
}

button {
   background-color: #149dcc;
   color: #fff;
   border: none;
   display: block;
   width: 100%;
   cursor: pointer;
   font-size: 1.1rem;
   font-family: inherit;
   padding: 1.3rem;

}
button:hover {
   background-color: #149dcc;
}
button:focus {
   outline: none;
   background-color: #149dcc;
}
ul {
   display: block;
   list-style-type: none;
}
li{
   font-size: 20px;
}
.grey{
   color: grey;
   float: right;
}
.green{
   color: green;
   float: right;
}
.red{
   color: red;
   float: right;
}

.serial{
   padding: 18px;
   /*  border-left: 1px solid #00000069;*/
}

label {
   font-weight: 500!important;
}

.row {
   margin-right: 0px!important;
   margin-left: 0px!important;
}

.number{
   background: #459f0c;
   height: 34px;
   width: 34px;
   border-radius: 100%;
   display: block;
   color: #fff;
   font-weight: 600;
   padding: 5px;
   font-size: 16px;
}
.numbering{
  margin: 8px 7px;
}
.modal{
  position: absolute;
  float: left;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
.modal-body h3{
   margin-bottom: 10px;
}
.modal-header {
   background-color: #149dcc;
   border-bottom: none;
   position: relative;
   
   display: -ms-flexbox;
   display: flex;
   -ms-flex-align: start;
   align-items: flex-start;
   -ms-flex-pack: justify;
   justify-content: space-between;
   padding: 15px;
   border-bottom: 1px solid #e9ecef;
   border-top-left-radius: 0.3rem;
   border-top-right-radius: 0.3rem;
}
.btn-submit{
   font-size: 25px;
}
.modal-header .close {
   padding: 15px;
   margin: 15px 15px 15pxauto;
   width: fit-content;
}
.close {
  float: right;
  font-size: 24px;
  font-weight: 700;
  line-height: 1;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  opacity: .5;
}
.exam-title{
   font-size: 25px;text-transform: uppercase;
}
.left-time{
font-size:25px;
margin-top: 10px;

}


@media only screen and  (max-width: 991px){
   .col-xs-12{
          max-width: 100%;
   }

   label p{
   font-size: 40px;
}

   .left-time,
   .exam-title,
   .btn-submit{
      font-size: 40px;
      width: fit-content;
   }

   .modal-body h3 {
     margin-bottom: 36px;
     font-size: 38px;
  }
/* .modal-dialog{
   max-width: auto;
   }*/

   .modal-header .close{
      font-size: 40px;
   }
   .quiz-header h4 p{
      font-size: 40px;
      line-height: 60px;
      font-weight: 400;
   }
   .quiz-header ul li{
      font-size: 40px;
   }
   .number{

      height: 60px;
      width: 60px;
      font-size: 30px;
   }

   .serial{
      padding-top: 30px;

   }
   .quiz-header{
      border-bottom: 1px solid #00000069;
      border-right: 0;
      height: 100%;
   }
   .quiz-container56565{
      padding: 0px;
   }
   .quiz-container{
      padding: 0px;
      margin: 5px 10px;
   }
   ul {
      display: block;
      list-style-type: none;
   }
   input[type="checkbox"], input[type="radio"] {
      font-size: 40px;
      font-weight: 200;
      width: 35px;
      height: 35px;
   }
}



@media only (min-width: 991px) and  (max-width: 1024px){
   .btn-submit{
      
      width: fit-content;
   }
}
</style>

</head>
<body id="body_html" class="quiz-container">
   <p id="demo"></p>
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <strong class="left-time" style="margin-left: auto;margin-right: 20px;"> Total Time Left:</strong>

            <div class="countdown left-time" style="margin-left:20px;"></div>
         </div>
      </div>
   </div>
</div>
<form action="" class="" id="question_save" method="post" style="padding-top:70px;">
   {{csrf_field()}}
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="form-group no-margin-bottom no-margin-top" style="text-align:center;">
            <div class="col-md-1 col-lg-1 col-d-none">
            </div>
            <div class="col-md-10 col-lg-10 col-sm-12">
               <div class="row">
                  <div class="col-md-4  col-sm-5">
                     <strong style="font-size: 30px!important;color: red;">Time Left : <span id='timer'></span></strong>
                  </div>
                  <div class="col-md-6 col-sm-4">
                     <strong class="exam-title">{{$exams->title ?? ''}}</strong>
                  </div>
                  <!-- <div class="col-md-2 col-d-none">
                  </div> -->
                  <div class="col-md-2 col-sm-3">
                     <button class="btn btn-success btn-submit" type="button" data-toggle="modal" data-target="#examfinish"  >Finish Test</button>
                  </div>
               </div>
            </div>
            <div class="col-md-1 col-lg-1 col-d-none">
            </div>
            <div class="col-xs-12 col-sm-12 clear" style="padding-top: 10px;">
               <div class="row justify-content-md-center">
                  <div class="col-md-1 col-lg-1 col-sm-1">
                  </div>
                  <div class="col-md-10 col-lg-10 col-sm-12 ">
                     
                     <div class="quiz-container56565" id="quiz">
                        <div class="col-md-6 col-xs-12 col-sm-12" >
                           <div class="quiz-header">
                              <h4 style="text-align: left;">
                                 {!!$question->question_name ?? ''!!}
                              </h4>
                              <ul style="text-align: left;">
                                 <li>
                                    <input type="radio" name="option" value="1">
                                    <label for="a" id="a_text">{!!$question->option_1 ?? ''!!}</label>
                                 </li>
                                 <li>
                                    <input type="radio" name="option" value="2">
                                    <label for="b" id="b_text">{!!$question->option_2 ?? ''!!}</label>
                                 </li>
                                 <li>
                                    <input type="radio" name="option" value="3">
                                    <label for="c" id="c_text">{!!$question->option_3 ?? ''!!}</label>
                                 </li>
                                 <li>
                                    <input type="radio" name="option" value="4">
                                    <label for="d" id="d_text">{!!$question->option_4 ?? ''!!}</label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-12" >
                           <div class="row serial">

                              <?php 
                              $count_answer = \App\Answer::where('user_id',$user_id)->where('exam_id',$exam_id)->count();

                              for ($i=1; $i <= $exams->no_of_questions; $i++) { 
                                 if($i >=$question_count){
                                  
                                    ?>
                                    <div class="col-md-1 col-sm-2   col-xs-6 numbering">
                                       <span  class= "number" >{{$i}}</span>
                                    </div>
                                 <?php }else{?>
                                   <div class="col-md-1 col-sm-2   col-xs-6 numbering">
                                    <span  class= "number" style="background-color: red;">{{$i}}</span>
                                 </div>

                              <?php }} ?>

                           </div>
                           
                        </div>
                     </div>
                     <div class="col-md-1 col-lg-1 col-sm-1">
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12">
                       <button class="btn btn-primary mb-3" id="save_proceed" style="font-size: 25px !important">Save & Proceed</button>
                    </div>
                    
                 </div>
              </div>
           </div>
        </div>
     </div>
     <input type="hidden" name="question_id" value="{{$question->id ?? ''}}">
     <input type="hidden" name="exam_id" value="{{$exams->id}}">
     <input type="hidden" name="question_count" value="{{$question_count}}">
     <input type="hidden" name="submit_exam" id="submit_exam" value="">
     <input type="hidden" name="user_id" value="{{Auth::guard('appusers')->user()->id}}">
  </form>





  <div class="modal responsive-modal" id="examfinish" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
     <div class="modal-content">
      <div class="modal-header" style="border-bottom:none;">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
     </button>
  </div>
  <div class="modal-body text-left" style="padding:10px 60px 60px">
    <h3>Total Attempet Question : <span class="grey">{{$attempt_no_of_question ?? 0}}</span></h3>
    <h3>Total Correct Question : <span class="green"> {{$correct ?? 0}}</span></h3>
    <h3>Total Skip Question : <span class="red"> {{$skip ?? 0}}</span></h3>
 </div>
 <div class="modal-footer">
    <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancel</button>
    <button type="button" id="submit_exam_all" class="btn btn-primary mb-3">Submit Exam</button>
 </div>
</div>
</div>
</div>



<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
         //define your time in second
         var c= '{{$exams->time_per_question}}';
             //var c= 50000;
             var t;
             timedCount();
             
             function timedCount()
             {
               
                var hours = parseInt( c / 3600 ) % 24;
                var minutes = parseInt( c / 60 ) % 60;
                var seconds = c % 60;
                
                var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
                
                
                $('#timer').html(result);
                if(c == 0 )
                {
                     //setConfirmUnload(false);
                     //$("#quiz_form").submit();
                     //window.location="logout.html";
                     submit_answer();
                     
                  }
                  c = c - 1;
                  t = setTimeout(function()
                  {
                     timedCount()
                  },
                  1000);
               }
               
               function submit_answer(){
                $('#question_save').submit();
             }
             
             
             
             
             
          </script>
          <style type="text/css">
          .btn-primary, .btn-primary:active {
            background-color: #149dcc;
            border-color: transparent;
            color: #ffffff;
         }
         ::selection {
            background-color: transparent;
         }
      </style>
      <!--  <script type="text/javascript">
         $('body').bind('copy paste',function(e) {
         e.preventDefault(); return false; 
         });
         
         jQuery(document).ready(function(){
         jQuery(function() {
             jQuery(this).bind("contextmenu", function(event) {
                 event.preventDefault();
                 //alert('Right click disable in this site!!')
             });
         });
         });
         
         
      </script> -->
      <script>
         // Set the date we're counting down to
         
         
         
         
         // var countDownDate = new Date("{{$end_time}}").getTime();/////expire time
         
         
         
         // // alert(countDownDate);
         
         // // Update the count down every 1 second
         // var x = setInterval(function() {
            
         //   // Get today's date and time
         //    var now = new Date().getTime();/////start_time
         //   //var now = '{{$start_time}}'/////start_time
         
         
         //   // alert(now);
         
         
         //   // Find the distance between now and the count down date
         //   var distance = countDownDate - now;
         
         //   // Time calculations for days, hours, minutes and seconds
         //   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
         //   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
         //   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
         //   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
         
         //   // Output the result in an element with id="demo"
         //   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
         //   + minutes + "m " + seconds + "s ";
         
         //   // If the count down is over, write some text 
         //   if (distance < 0) {
         //     clearInterval(x);
         //     //document.getElementById("demo").innerHTML = "EXPIRED";
         //   }
         // }, 1000);
         
         
         
         
         var total_sec = '{{$total_time_taken}}';
         
         
         var countDownDate = moment().add(parseInt(total_sec), 'seconds');
         
         var x = setInterval(function() {
          diff = countDownDate.diff(moment());
          
          if (diff <= 0) {
           clearInterval(x);
                    // If the count down is finished, write some text 
                    $('.countdown').text("EXPIRED");
                 } else
                 $('.countdown').text(moment.utc(diff).format("HH:mm:ss"));
                 
              }, 1000);
         
         
         
         
           </script>
           <script type="text/javascript">
            document.addEventListener("keyup", function (e) {
               var keyCode = e.keyCode ? e.keyCode : e.which;
               if (keyCode == 44) {
                stopPrntScr();
             }
          });
            function stopPrntScr() {
               
              var inpFld = document.createElement("input");
              inpFld.setAttribute("value", ".");
              inpFld.setAttribute("width", "0");
              inpFld.style.height = "0px";
              inpFld.style.width = "0px";
              inpFld.style.border = "0px";
              document.body.appendChild(inpFld);
              inpFld.select();
              document.execCommand("copy");
              inpFld.remove(inpFld);
           }
           function AccessClipboardData() {
              try {
                window.clipboardData.setData('text', "Access   Restricted");
             } catch (err) {
             }
          }
          setInterval("AccessClipboardData()", 300);
       </script>



       <script type="text/javascript">
        

         $('#submit_exam_all').click(function(){
            $('#submit_exam').val(1);

            $('#question_save').submit();
         });

      </script>
   </body>
   </html>