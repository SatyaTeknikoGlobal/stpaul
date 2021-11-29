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

</style>

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
<div class="slider-area">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>FAQ</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
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
