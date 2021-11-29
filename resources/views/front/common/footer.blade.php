</main>

<footer>

  <div class="footer-area footer-bg">
    <div class="container">
      
      <div class="footer-top footer-padding">
        <div class="row d-flex justify-content-between">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <div class="logo d-none d-lg-block">

                  <a href="{{url('/')}}">

                    <img src="{{asset('public/assets/web/img/logo/logo.png')}}" alt="logo">
                    St.Paul's
                    <span class="span">Education Academy</span>
                  </a>
                </div>

              </div>

            </div>

            <p class="footer-text">
              My Home Hub, Madhapur, Patrika Nagar, HITEC City Hyderabad, Telangana 500081

            </p>

          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Know More</h4>
                <ul>
                  <li><a href="{{route('home.about')}}">About Us</a></li>
                  <li><a href="{{route('home.contact')}}">Contact Us</a></li>
                  <li><a href="{{route('home.terms')}}">Terms and conditions </a></li>
                  <li><a href="{{route('home.privacy')}}">Privacy Policy</a></li>
                  <li><a href="{{route('home.refund')}}">Refund Policy</a></li>


                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Useful Links</h4>
                <ul>
                  <li><a href="{{route('home.registration_process')}}">Registration Process</a></li>
                  <li><a href="{{route('home.faqs')}}">FAQS</a></li>
                  <?php if(empty(Auth::guard('appusers')->user())){?>
                  <li><a href="{{route('home.login')}}">Sign In</a></li>
                  <li><a href="{{route('home.register')}}">Register</a></li>
                  <?php }else{?>
                    <li><a href="{{route('home.dashboard')}}">Sign In</a></li>
                    <li><a href="{{route('home.dashboard')}}">Register</a></li>
                  <?php } ?>



                </ul>



              </div>
            </div>
          </div>

        </div>
      </div>
  
      <!-- <div class="footer-bottom">
        <div class="row d-flex align-items-center">
          <div class="col-lg-12">
            <div class="footer-copy-right text-center">
              <p>
                Copyright &copy;
                <script>
                  {{date('Y')}}
                </script> 2021. ST.PAUL'S Education Academy. All Rights Reserved. </a>
              </p>
            </div>
          </div>
        </div>
      </div> -->
    </div>
     <div class="container-fluid">
      <div class="footer-bottom">
        <div class="row d-flex align-items-center">
          <div class="col-lg-12">
            <div class="footer-copy-right text-center">
              <p>
                Copyright &copy;
                <script>
                  {{date('Y')}}
                </script> 2021. ST.PAUL'S Education Academy. All Rights Reserved. </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</footer>

<div id="back-top">
  <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- <script src="{{asset('public/assets/carousel/assets2/web/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/popper/popper.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/tether/tether.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/dropdown/js/script.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/bootstrapcarouselswipe/bootstrap-carousel-swipe.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/smoothscroll/smooth-scroll.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/ytplayer/jquery.mb.ytplayer.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/touchswipe/jquery.touch-swipe.min.js')}}"></script>
  <script src="{{asset('public/assets/carousel/assets2/theme/js/script.js')}}"></script>
 -->




<style type="text/css">
  

</style>

<script src="{{asset('public/assets/web/js/vendor/modernizr-3.5.0.min.js')}}"></script>

<script src="{{asset('public/assets/web/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script
  src="{{asset('public/assets/web/js/popper.min.js%2bbootstrap.min.js%2bjquery.slicknav.min.js.pagespeed.jc.skzfcVBIpe.js')}}">
</script>
<script>
  eval(mod_pagespeed_wgWswYh5Xw);
</script>
<script>
  eval(mod_pagespeed_sl2JyQGBGz);
</script>

<script>
  eval(mod_pagespeed_wm3_o7s$zZ);
</script>

<script src="{{asset('public/assets/web/js/owl.carousel.min.js%2bslick.min.js.pagespeed.jc.putZRIqsHi.js')}}"></script>
<script>
  eval(mod_pagespeed_Z8p6IBxvZj);
</script>
<script>
  eval(mod_pagespeed_zUGINO6$WS);
</script>

<script
  src="{{asset('public/assets/web/js/wow.min.js%2banimated.headline.js%2bjquery.magnific-popup.js.pagespeed.jc.VSpx33NcDV.js')}}">
</script>
<script>
  eval(mod_pagespeed_lRKfZGlzTL);
</script>
<script>
  eval(mod_pagespeed_pyJhampy_m);
</script>
<script>
  eval(mod_pagespeed_muY8yOTmK1);
</script>


<script
  src="{{asset('public/assets/web/js/jquery.nice-select.min.js%2bjquery.sticky.js%2bjquery.counterup.min.js%2bwaypoints.min.js%2bcontact.js%2bjquery.form.js%2bjquery.validate.min.js%2bmail-scri')}}">
</script>
<script>
  eval(mod_pagespeed_QZ_ZBAMe$V);
</script>
<script>
  eval(mod_pagespeed_HOn74EeNO6);
</script>

<script>
  eval(mod_pagespeed_9kKB6A5w6I);
</script>
<script>
  eval(mod_pagespeed_atl908spv3);
</script>

<script>
  eval(mod_pagespeed_RfU_6dbWax);
</script>
<script>
  eval(mod_pagespeed_XhUNFUYZHp);
</script>
<script>
  eval(mod_pagespeed_eqtOxnLk0j);
</script>
<script>
  eval(mod_pagespeed_1NnVDOm$jK);
</script>
<script
  src="{{asset('public/assets/web/js/jquery.ajaxchimp.min.js%2bplugins.js%2bmain.js.pagespeed.jc.-LIkdVV7_j.js')}}">
</script>
<script>
  eval(mod_pagespeed_MtWWN1MSbt);
</script>

<script>
  eval(mod_pagespeed_bcEheDfXrH);
</script>
<script>
  eval(mod_pagespeed_hGUyyqO7BK);
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>

</html>