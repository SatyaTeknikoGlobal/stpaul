@include('front.common.header')
<style>
.faq-img{
 width:auto;height: 555px;
}
.cid-qBIhwJjKYX .mbr-slider .carousel-control.carousel-control-next{
  margin-left: 93%!important;
}
.cid-qBIhwJjKYX .full-screen .slider-fullscreen-image{
  height: 200px;
}

.cid-qBIhwJjKYX .mbr-slider .carousel-control{
  height: 50px;
  width: 50px;
  top: 40%;
}

@media (max-width: 768px){
  .faq-img{
   height: auto;
 }
 .cid-qBIhwJjKYX .mbr-slider .carousel-control.carousel-control-next{
  margin-left: 80%!important;
}
.cid-qBIhwJjKYX .full-screen .carousel-item .container.container-slide img{
  display: block;
}
.mbr-overlay{
  display: none;
}

.cid-qBIhwJjKYX .full-screen .carousel-item  img{
  display: none;
}



.cid-qBIhwJjKYX .full-screen .slider-fullscreen-image{
  min-height: 220px;
}


}




.about-area .about-caption ul li{
       font-size: 16px;
    color: #000;
    line-height: 1.6;
    font-weight: 400;
    padding-right: 50px;
}

</style>

<section class="slide cid-qBIhwJjKYX" data-interval="false" id="slider1-15" data-rv-view="5930">
  <div class="full-screen">
    <div class="mbr-slider slide carousel"  data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="4000">
      <ol class="carousel-indicators">

        <?php if(!empty($banners)){

          for ($i=0; $i < count($banners); $i++) { ?>

            <li data-app-prevent-settings="" data-target="#slider1-15" class="<?php if($i == 0) echo "active"?>" data-slide-to="{{$i}}"></li>


          <?php }}?>
               <!--  <li data-app-prevent-settings="" data-target="#slider1-15" class=" active" data-slide-to="1"></li>
                <li data-app-prevent-settings="" data-target="#slider1-15" data-slide-to="2"></li> -->
              </ol>
              <div class="carousel-inner" role="listbox">

                <?php if(!empty($banners)){
                  $i = 1;
                  $storage = Storage::disk('public');
                  $path = 'banner/';
                  foreach($banners as $banner){
                    $image = $banner->banner;
                    if(!empty($image)){
                      if($storage->exists($path.$image))
                      {
                        $bannerUrl = url('storage/app/public/'.$path.'/'.$image);
                      }
                    }



                    ?>


                    <?php if(CustomHelper::isMobile()){?>
                      <div class="carousel-item slider-fullscreen-image <?php if($i == 1) echo "active";?>" data-bg-video-slide="false" >
                        <div class="container container-slide">
                          <div class="image_wrapper">
                            <div class="mbr-overlay" style="opacity: 0;">
                            </div>
                            <a href="" target="_blank"><img src="{{$bannerUrl ?? ''}}" ></a>
                            <div class="carousel-caption justify-content-center">
                              <div class="col-10 align-center">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  ++$i;}else{?>

                        <div class="carousel-item slider-fullscreen-image <?php if($i == 1) echo "active";?>" data-bg-video-slide="false" style="background-image: url({{$bannerUrl ?? ''}}); width: 100%;" >
                          <div class="container container-slide">
                            <div class="image_wrapper">
                              <div class="mbr-overlay" style="opacity: 0;">
                              </div>
                              <img src="{{$bannerUrl ?? ''}}">
                              <div class="carousel-caption justify-content-center">
                                <div class="col-10 align-center">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php }?>






                      <?php
                      ++$i;
                    }}?>

               <!--  <div class="carousel-item slider-fullscreen-image " data-bg-video-slide="false" style="background-image: url(public/assets/carousel/assets2/images/duffy-brook-350227-2000x1333.jpg);">
                    <div class="container container-slide">
                        <div class="image_wrapper">
                            <img src="public/assets/carousel/assets2/images/duffy-brook-350227-2000x1333.jpg">
                            <div class="carousel-caption justify-content-center">
                                <div class="col-10 align-left">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url(public/assets/carousel/assets2/images/duffy-brook-350228-2000x1333.jpg);">
                    <div class="container container-slide">
                        <div class="image_wrapper">
                            <div class="mbr-overlay" style="opacity: 0.3;">
                                
                            </div>
                            <img src="public/assets/carousel/assets2/images/duffy-brook-350228-2000x1333.jpg">
                            <div class="carousel-caption justify-content-center">
                                <div class="col-10 align-right">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              -->


            </div>
            <div>
             <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#"><span aria-hidden="true" class="mbri-left mbr-iconfont"></span><span class="sr-only">Previous</span></a>


             <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#"><span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a>
           </div>

           


         </div></div>

       </section>








       <div class="about-area section-padding2">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="about-caption mb-50">

                <div class="section-tittle mb-35">
                  <span>  About Us:</span>
                  <h2>More About Our Company 
                  </h2>
                </div>
                <p>

                </p>

                <p class="text-justify">

                  The St Paul's Academy is a podium of wide exposure for all students who plan on appearing for national and international competitive exams. This PAN India examination helps students evaluate their potential in an all-India platform. This way they know exactly how to assess their capabilities and which areas to work on.
                  
                </p>
                <p>
                  St. Paul’s Education Academy does not only stop at evaluation, we believe in empowering the students and the generations to follow. We help students focus on bigger aims and prepare their minds accordingly. We provide the creamy level with valuable scholarships. We boost up their confidence by rewarding their perseverance. We aim at inspiring young minds and giving them a platform to unleash their full potential.
                </p>
               <!--  <ul>


                  <div class="col-md-6">
                    <li><span class="flaticon-business" style="font-size:19px;font-weight: 600"></span> Creative ideas base</li>
                    <li><span class="flaticon-communications-1" style="font-size:19px;font-weight: 600"></span> Assages of sorem gpsum ilable</li>

                  </div>
                  <div class="col-md-6">
                   <li><span class="flaticon-graduated" style="font-size:19px;font-weight: 600"></span> Have suffered alteration in so</li>

                   <li><span class="flaticon-tools-and-utensils" style="font-size:19px;font-weight: 600"></span> Randomised words whi</li>
                 </div>
               </ul> -->

             </div>
           </div>
           <div class="col-lg-6 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide my-5" data-ride="carousel" style="background-color: #2d3092;">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active" style="margin: 91px 0px;">
                  <p style="color: #fff;padding: 10px 65px 10px 50px;text-align: justify;">
                    We not only complete the course but help our students understand even the most basic of the topics. With us, no child is a slow learner, as we are here to help everyone learn and become successful.
                  </p>
                </div>
                <div class="carousel-item" style="margin: 91px 0px;" >
                  <p style="color: #fff;padding: 10px 65px 10px 50px;text-align: justify;">
                    At St. Paul’s Education Academy, we are on a mission to make the whole world get the best of education with easy-to-learn courses. With our tried and tested modules, we can bring education to every doorstep.
                  </p>
                </div>

              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>


            <div class="btn btn-primary"><a href="{{route('home.about')}}" >More About Us</a></div>

          </div>
        </div>
      </div>
    </div>

    <div class="categories-area">
      <div class="container">
        <div class="row justify-content-sm-center">
          <div class="cl-xl-7 col-lg-8 col-md-10">

            <div class="section-tittle text-center mb-70">
              <span>Popular Upcoming Exam</span>
              <h2>Lets Browse All Upcoming exams</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php if(!empty($exams)){
            //  pr($exams);
            foreach($exams as $exam){
              $date = date("F d, Y ", strtotime($exam->start_date));
              $description = mb_strlen(strip_tags($exam->description),'utf-8') > 50 ? mb_substr(strip_tags($exam->description),0,50,'utf-8').'...' : strip_tags($exam->description);
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
                         <!--  <a href="{{route('home.exam_details',['exam_id'=>$exam->id])}}"> -->
                         	   <a href="#"  data-toggle="modal" data-target="#basicModal{{ $exam->id }}">
                         	<button type="submit"  class="btn btn-primary">
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
                                      
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>
                    </div>
                  <?php }}?>


                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="browse-btn2 text-center">
                      <button type="submit"  class="btn btn-primary">
                        <a href="{{route('home.exam_list')}}">View All Exams</a>
                      </button>
                    </div>
                  </div>
                </div>


              </div>



              <div class="about-area section-padding2">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 col-md-12">
                      <div class="about-caption mb-50">

                        <div class="section-tittle mb-35">
                          <span>
                           Registration Process:
                         </span>
                         <h2>
                           Registration Process:
                         </h2>
                       </div>
                       <p>


                        Once you have successfully checked your eligibility for St  Paul Education Academy’s 2021 competitive test, you need to follow these few simple steps to complete your registration.

                      </p>


                      <ul>
                        <li>
                         <b>Step 1:</b>Click on the Register Icon on the Home Page.

                       </li>

                       <li>
                        <b> Step 2:</b> Fill in the required details such as:
                        <ul class="mb-0 px-5">
                         <li><b>a.</b> 
                           Your Full Name:

                         </li>


                         <li><b>b.</b> 
                           A valid email id:

                         </li>
                         <li><b>c.</b> 
                           Your mobile number:

                         </li>
                        
                         <li><b>d.</b> 
                           And finally set your private password. Make sure your password is strong.
                         </li>
                       </ul>


                     </li>
                     <li>
                      <b>Step 3:</b> Once you have chosen a strong password you need to fill the referral code provided to you.

                    </li>
                    <li>
                     <b> Step4:</b> The Final step is that once you have filled in all the required details, click on the “Register” icon present below the page.
                     With these few simple steps, you are now registered for our 2021 Online Exam.
                   </li>
                 </ul>




                 <!--  <div class="btn btn-primary"><a href="{{route('home.about')}}">More About Us</a></div> -->
               </div>
             </div>
             <div class="col-lg-6 col-md-12">

              <div class="about-img ">
                <div class="about-font-img d-none d-lg-block">
                  <img src="https://stpaulseducationacademy.com/public/assets/web/img/gallery/xabout2.png.pagespeed.ic.869_mUW4z9.png" alt="">
                  
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>



    <div class="team-area section-bg" data-background="https://stpaulseducationacademy.com/public/assets/img/gallery/section_bg02.png">
      <div class="container">
        <div class="row justify-content-center">
          <div class="cl-xl-7 col-lg-8 col-md-10">

            <div class="section-tittle text-center mb-70">
              <span>More About Our Toppers</span>
              <h2>Our  Toppers</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-team mb-30">
              <div class="team-img">
                <img src="{{asset('public/assets/web/img/gallery/xteam1.png.pagespeed.ic.TZ8-eGP1Xz.png')}}" alt="">

                <!-- <ul class="team-social">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fas fa-globe"></i></a></li>
                </ul> -->
              </div>
              <div class="team-caption">
                <h3><a href="instructor.html">Alexa Janathon</a></h3>
                <p>Topper</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-team mb-30">
              <div class="team-img">
                <img src="{{asset('public/assets/web/img/gallery/xteam2.png.pagespeed.ic.QGR2FKgXJC.png')}}" alt="">


              </div>
              <div class="team-caption">
                <h3><a href="instructor.html">Janathon Smith</a></h3>
                <p>Topper</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-team mb-30">
              <div class="team-img">
                <img src="{{asset('public/assets/web/img/gallery/xteam3.png.pagespeed.ic.VM2Ep7RucC.png')}}" alt="">


              </div>
              <div class="team-caption">
                <h3><a href="instructor.html">Alexa MacCalum</a></h3>
                <p>Topper</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-team mb-30">
              <div class="team-img">
                <img src="{{asset('public/assets/web/img/gallery/xteam4.png.pagespeed.ic.6mw2bqEGft.png')}}" alt="">


              </div>
              <div class="team-caption">
                <h3><a href="instructor.html">Alexa j Watson</a></h3>
                <p>Topper</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>



  <div class="testimonial-area fix my-5 section-bg section-padding2" data-background="{{asset('public/assets/web/img/gallery/section_bg03.png')}}">
    <div class="container">
      <div class="section-tittle section-tittle2 text-center">
        <span>Testimonial</span>
        <h2> Our Student Say</h2>
        <p style="color: #fff;">Reviews that motivate us to revolutionize the realm of education.

        </p>
      </div>


      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-9">
          <div class="h1-testimonial-active">

            <?php if(!empty($tesimonials)){
              foreach($tesimonials as $testimonial){

                $user = \App\User::where('id',$testimonial->user_name)->first();

                $storage = Storage::disk('public');
                $path = 'testimonial/thumb/';
                $image = $testimonial->image;
                $imageUrl = url('public/assets/img/noimage.png');

                if(!empty($image)){
                  if($storage->exists($path.$image))
                  { 
            //$imageUrl = url('public/storage/'.$path.'/'.$image);
                    $imageUrl = url('storage/app/public/'.$path.'/'.$image);

                  }
                }



                ?>
                <div class="single-testimonial">

                  <div class="testimonial-icon">
                    <img src="{{$imageUrl}}" class="ani-btn " alt="">
                  </div>

                  <div class="testimonial-caption text-center">
                    <p>{!!$testimonial->text!!}.</p>

                    <div class="testimonial-ratting">
                     <?php if($testimonial->rating == 1){?>
                       <i class="fas fa-star"></i>
                     <?php }if($testimonial->rating == 2){?>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                     <?php }if($testimonial->rating == 3){?>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                    <?php }if($testimonial->rating == 4){?>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                   <?php }if($testimonial->rating == 5){?>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                   <?php }?>



                 </div>
                 <div class="rattiong-caption">
                  <span>{{$user->name ??''}}</span>
                </div>
              </div>
            </div>
          <?php }}?>




        </div>
      </div>
    </div>
  </div>
</div>
        <?php /*
        <section class="section-padding2">
          <div class="container">
          <div class="section-tittle section-tittle2 text-center">
      
        <h2 style="color:black; margin-bottom:40px;">Frequently Ask Questions</h2>
        <!-- <p style="color: #fff;">Reviews that motivate us to revolutionize the realm of education.

        </p> -->
      </div>
          <div class="row">
            <div class="col-md-2"></div>
  
  <div class="col-md-8">
 
    <div class="tabs">

      <?php if(!empty($faqs)){
        $i = 1;
        foreach($faqs as $faq){
        ?>
      <div class="tab">
        <input type="radio" id="rd{{$i}}" name="rd{{$i}}" style="display:none;">
        <label class="tab-label" for="rd{{$i}}">
          <h3 style="color:white;">{!!$faq->question!!}</h3>
        </label>
        <div class="tab-content">
          <h5> {!!$faq->answer!!}</h5>
        </div>
      </div>
    <?php
      ++$i;
     }}?>


      <!-- <div class="tab">
        <input type="radio" id="rd2" name="rd" style="display:none;">
        <label class="tab-label" for="rd2">
        <h3>FAQ 1</h3>
        </label>
        <div class="tab-content">
         <h5> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil, aut.</h5>
        </div>
      </div>
       -->
    </div>
  </div>
  <div class="col-md-2"></div>
</div>
          </div>
</section>

       

        <style>
          .tabs {
	 border-radius: 8px;
	 overflow: hidden;
	 box-shadow: 0 4px 4px -2px rgba(0, 0, 0, 0.5);
}
 .tab {
	 width: 100%;
	 color: white;
	 overflow: hidden;
}
 .tab-label {
	 display: flex;
	 justify-content: space-between;
	 padding: 1em;
	 background: #2d3092;
	 font-weight: bold;
	 cursor: pointer;

}
 .tab-label:hover {
	 background: #1a252f;
}
 .tab-label::after {
	 content: "\276F";
	 width: 1em;
	 height: 1em;
	 text-align: center;
	 transition: all 0.35s;
}
 .tab-content {
	 max-height: 0;
	 padding: 0 1em;
	 color: #2c3e50;
	 background: white;
	 transition: all 0.35s;
}
 .tab-close {
	 display: flex;
	 justify-content: flex-end;
	 padding: 1em;
	 font-size: 0.75em;
	 background: #2c3e50;
	 cursor: pointer;
}
 .tab-close:hover {
	 background: #1a252f;
}
 input:checked + .tab-label {
	 background: #2d3092;
}
 input:checked + .tab-label::after {
	 transform: rotate(90deg);
}
 input:checked ~ .tab-content {
	 max-height: 100vh;
	 padding: 1em;
}
 

        .exams .btn-primary {
          width: 100%;
          border-radius: 8px;
          color: #fff;
        }
        .exams a{
          text-decoration: none;
          color: #fff;
        }
        .btn-primary a{
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


      */ ?>
      <style type="text/css">
      .about-area .about-caption ul li{
        line-height: 34px;
      }
      .cid-qBIhwJjKYX .full-screen .carousel-item .container.container-slide{
        min-height: auto;
      }
      .carousel-indicators li{
        height: 10px !important;
        width: 10px !important;
      }
      .carousel-inner .carousel-item{
        height: 220px !important;
      }

      .faq-section {
        background: #fdfdfd;
        min-height: auto;
        padding: 10vh 0 0;
        height: auto;
      }
      .faq-title h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
      }
      .faq-title h2::before {
        content: "";
        position: absolute;
        left: 50%;
        width: 60px;
        height: 2px;
        background: #E91E63;
        bottom: -25px;
        margin-left: -30px;
      }
      .faq-title p {
        padding: 0 190px;
        margin-bottom: 10px;
      }

      .faq {
        background: #FFFFFF;
        box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
        border-radius: 4px;
        height: auto;
      }

      .faq .card {
        border: none;
        background: none;
        border-bottom: 1px dashed #CEE1F8;
      }

      .faq .card .card-header {
        padding: 0px;
        line-height: auto;
        border: none;
        background: none;
        text-align: left !important;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
      }

      .faq .card .card-header:hover {
        background: rgba(233, 30, 99, 0.1);
        padding-left: 10px;
      }

      .faq .card .card-header .faq-title {
        width: 100%;
        text-align: left;
        padding: 0px;
        padding-left: 10px;
        padding-right: 30px;
        font-weight: 400;
        font-size: 15px;
        letter-spacing: 1px;
        color: #3B566E;
        text-decoration: none !important;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        padding-top: 20px;
        padding-bottom: 20px;
        line-height: 25px;

      }

      .faq .card .card-header .faq-title .badge {
        display: inline-block;
        width: 20px;
        height: 20px;
        line-height: 14px;
        float: left;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
        text-align: center;
        background: #E91E63;
        color: #fff;
        font-size: 12px;
        margin-right: 15px;
        /*  line-height: 30px;*/
      }

      .faq .card .card-body {
        padding: 15px;
        padding-left: 35px;
        padding-bottom: 16px;
        font-weight: 400;
        font-size: 16px;
        color: #6F8BA4;
        line-height: 28px;
        letter-spacing: 1px;
        border-top: 1px solid #F3F8FF;
      }

      .faq .card .card-body p {
        margin-bottom: 14px;
      }

      @media (max-width: 991px) {
        .faq {
          margin-bottom: 30px;
        }
        .faq .card .card-header .faq-title {
          line-height: 26px;
          margin-top: 10px;
        }
      }
      .btn-primary a{
        color: #fff;
        font-size: 19px;
      }

      .cid-qBIhwJjKYX .full-screen .carousel-item .container.container-slide{
        height: 100% !important;
      }


    </style>
    <section class="faq-section">

      <div class="container">
        <div class="row">
          <!-- ***** FAQ Start ***** -->

          <div class="col-md-6">
            <div class="faq-title text-center pb-3">
              <h2>Frequently Ask Questions</h2>
            </div>
            <div class="faq" id="accordion" style="margin-bottom: 20px">

              <?php if(!empty($faqs)){
                $i = 1;
                foreach($faqs as $faq){

                  $question = strip_tags($faq->question);
                  $answer = strip_tags($faq->answer);


                  ?>
                  <div class="card">
                    <div class="card-header" id="faqHeading-{{$i}}">
                      <div class="mb-0">
                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-{{$i}}" data-aria-expanded="true" data-aria-controls="faqCollapse-{{$i}}">
                          <span class="badge">{{$i}}</span>{!!$question!!}
                        </h5>
                      </div>
                    </div>
                    <div id="faqCollapse-{{$i}}" class="collapse" aria-labelledby="faqHeading-{{$i}}" data-parent="#accordion">
                      <div class="card-body">
                        <p style="margin-bottom:6px;">{!!$answer!!}</p>
                      </div>
                    </div>
                  </div>
                  <?php  $i++;}}?>


                </div>
              </div>


              <div>
               <img src="{{url('public/assets/web/img/hero/Faq.png')}}" class="img-fluid faq-img" >

             </div>
           </div>
         </div>
       </section>
       @include('front.common.footer')
