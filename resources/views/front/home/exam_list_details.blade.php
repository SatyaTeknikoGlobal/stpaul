<style type="text/css">
    html {
}
</style>

@include('front.common.header')
<div class="slider-area">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>{{$courses->name ?? ''}} Exam Lists</h2>
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
                  </div>

              </div>

            
               <div class="row">

                <div class="col-lg-6">
                </div>
                 <div class="col-lg-6">
                  
                 </div>
                 <br>
                <?php if(!empty($exams)){
                    foreach($exams as $exam){
                        $date = date("F d, Y ", strtotime($exam->start_date));
                        $description = mb_strlen(strip_tags($exam->description),'utf-8') > 50 ? mb_substr(strip_tags($exam->description),0,50,'utf-8').'...' : strip_tags($exam->description);
                    ?>
                <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                    <div class="single-cat mb-50 exams ">
                        <!-- <div class="cat-icon">
                        <span class="flaticon-web-design"></span>
                    </div> -->
                        <div class="cat-cap">
                            <h5><a href="#">{{$exam->title ?? ''}}</a></h5>
                            <h5><b>{{$date}}</b></h5>
                            <p>{{$description}}</p>
                             <a href="{{route('home.exam_details',['exam_id'=>$exam->id])}}">
                            <button type="submit" class="btn btn-primary">
                               Enroll Now
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }}?>

                </div>

        
        {{$exams->links()}}






        </div>




    </div>
    <style>
     .heading{
        position: relative;
     }
    .heading h3{
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
    z-index: 9999;
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
    </style>

    





@include('front.common.footer')
