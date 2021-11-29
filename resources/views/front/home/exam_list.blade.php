<style type="text/css">
    html {
}
</style>
<?php 

$BackUrl = CustomHelper::BackUrl();

?>


@include('snippets.errors')
@include('snippets.flash')

@include('front.common.header')
<div class="slider-area">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>Exam Lists</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="categories-area ">
        <div class="container">
            <div class="row">
              
                <div class="section-tittle col-md-12 text-center mb-30 mt-30">
                    <h3>
                        <span>List Of Exams</span>
                    </h3>
                    <h3> Below is the list of competitive exams with dates for 12th pass, graduation level, law,
                        engineering, banking, and arts field candidates:</h3>
                  </div>

              </div>

              <?php if(!empty($courses)){
                foreach($courses as $course){
                    $exams = \App\Exam::where('course_id',$course->id)->where('is_delete',0)->where('status',1)->get();
                     if(!empty($exams) && count($exams) > 0){
                                    ?>
               <div class="row">

                <div class="col-lg-6">
                    <div class=" heading"><h3 class="mb-5" style="text-transform:uppercase;">{{$course->name ??''}}</h3>  
                    </div>
                
                </div>
                 <div class="col-lg-6">
                    <?php if(count($exams) > 6){?>
                  <div class="heading1"><h3 class="mb-5" style="float: right;color: red;">
                    <a href="{{route('home.exam_list_details',['course_id'=>$course->id])}}">View All</a></h3> 
                    </div>
                <?php }?>
                 </div>
                 <br>
                <?php
                    foreach($exams as $exam){
                        //echo $exam->description;
                        $date = date("F d, Y ", strtotime($exam->start_date));
                        /*$description = mb_strlen(strip_tags($exam->description),'utf-8') > 500 ? mb_substr(strip_tags($exam->description),0,500,'utf-8').'...' : strip_tags($exam->description);*/
                        $description = mb_strlen(strip_tags($exam->description),'utf-8') > 500 ? mb_substr(strip_tags($exam->description),0,500,'utf-8').'...' : strip_tags($exam->description);
                         $description1 = mb_strlen(strip_tags($exam->description),'utf-8') > 5000 ? mb_substr(strip_tags($exam->description),0,5000,'utf-8').'...' : strip_tags($exam->description);
                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                    <div class="single-cat mb-50 exams ">
                        <!-- <div class="cat-icon">
                        <span class="flaticon-web-design"></span>
                    </div> -->
                        <div class="cat-cap">
                            <h5><a href="#">{{$exam->title ?? ''}}</a></h5>
                            <h5><b>{{$date}}</b></h5>
                            <p>{!!($description)!!}</p>
                          <!--   <a  href="{{route('home.exam_details',['exam_id'=>$exam->id])}}"> -->
                                <a href="#"  data-toggle="modal" data-target="#basicModal{{ $exam->id }}">
                                <button type="submit" class="btn btn-primary">
                                Details
                            </button></a>

                            <div class="modal fade" id="basicModal{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header" style="background: #0d1081b5;">
                                        <h4 class="modal-title" id="myModalLabel" style="color: #fff;">Exam Description #{{$exam->title ??''}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <h3 style="text-transform: uppercase;"> {{$exam->title ??''}} </h3><br>
                                        <h3> <b>{{date("F d, Y ", strtotime($exam->start_date))}}</b></h3>
                                        <hr>
                                       <h4 style="margin-bottom: 0px!important;text-align: justify;font-size: 16px;">{!!($description1)!!} </h4>

                                        <br>
                                        <a  href="{{route('home.exam_details',['exam_id'=>$exam->id])}}"> <button type="button" class="btn btn-primary">Continue>></button>
                                        </a>
                                      </div>
                                      <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                      </div> -->
                                    </div>
                                  </div>
                                </div>

                        </div>
                    </div>
                </div>
            <?php }}?>

                </div>

            <?php }}?>

        






        </div>




    </div>
    <style>
     .heading{
        position: relative;
     }
    .heading1 h3{
        font-size: 25px;
    }
    .heading:after{
               content: '';
    position: absolute;
    width: 70px;
    height: 3px;
    background: #1499c7;
    left: 0;
    bottom: -11px;
    opacity: 0;
 /*   z-index: 9999;*/
    opacity: 1;
    -webkit-transition: all .5s ease;
    -moz-transition: all .5s ease;
    -ms-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
    }
 /*   .heading:before{
        margin-bottom: 1499c7;
    }*/
        .exam-list p {
            font-size: 18px;
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
     .categories-area .single-cat .cat-cap p{
     margin-bottom: 0px!important;
    }
    </style>




@include('front.common.footer')
