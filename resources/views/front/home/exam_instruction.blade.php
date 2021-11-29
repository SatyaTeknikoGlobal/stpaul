@include('front.common.header')
<br>
<div class="slider-area mb-5">
   <div class="slider-height2 d-flex align-items-center">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="hero-cap hero-cap2 text-center">
                  <h2>Exam Instruction</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php 
$question = $exams->no_of_questions;
$time = $exams->time_per_question;

$total_time = $question * $time;
$time_in_minute =  gmdate('i', $total_time);



?>


<div class="categories-area ">
   <div class="container">
      <div class="row">
         <div class="container presentation-box-footer-padding" >
            <div class="row justify-content-md-center">
               <div class="col-md-8 " style="box-shadow: 0 0 5px #333;padding-top: 20px;padding-bottom: 20px;">
                  <center> <h1 style="color: #4b4e51;text-transform: uppercase;">{{$exams->title ?? ''}}</h1></center>
                  <br>
                  <center><h3><strong style="color: #7e868d;">Please Read The Instruction Carefully</strong></h3></center>
                  <br>
                  <div class="col-md-12 ">
                     <h3><u>General Instruction</u></h3><br>
                     <ul style="margin-left: 40px;">
                        <li style="list-style: circle;font-size: 16px;">Total number of questions : {{$exams->no_of_questions ?? 0}}</li>
                        <li style="list-style: circle;font-size: 16px;">Time alloted : {{$time_in_minute}} minutes</li>
                        <li style="list-style: circle;font-size: 16px;">Do not refresh the page</li>
                        <li style="list-style: circle;font-size: 16px;"> {!!$exams->description!!}</li>
                        </ul>
                    
                  </div><br><br><br>
                  <center> <a class="btn btn-primary mb-5" style="font-size:16px !important;" href="{{route('home.start_exam',['exam_id'=>$exams->id])}}">Start</a></center>

              </div>

            </div>
         </div>
      </div>
   </div>
</div>
<br><br>
<style type="text/css">
   .btn-primary, .btn-primary:active {
   background-color: #149dcc;
   border-color: #149dcc;
   color: #ffffff;
   }
</style>
@include('front.common.footer')
