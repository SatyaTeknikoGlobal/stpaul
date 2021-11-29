@include('front.common.header')
<div class="slider-area">
   <div class="slider-height2 d-flex align-items-center">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="hero-cap hero-cap2 text-center">
                  <h2>User Dashboard</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="exTab1" class="container my-5">
   @include('front.common.leftbar')
   <div class="tab-content clearfix">
      <div class="user">
         <div class="col-12 col-sm-6 col-md-4">
            <div class="card card-purple-blue text-white mb-3 mb-md-0">
               <div class="card-body d-flex justify-content-between align-items-end">
                  <div class="row">
                     <div class="col-md-3 col-sm-12">
                        <i class="fa fa-book" aria-hidden="true"></i>
                     </div>
                     <div class="col-md-9 col-sm-12">
                        <strong class="heading-card">
                           <h2>Total Courses</h2>
                        </strong>
                     </div>
                     <br>
                     <div class="col-md-1 col-sm-12">
                     </div>
                     <div class="col-md-11 col-sm-12">
                        <center>
                           <h1>{{$course ?? 0}}</h1>
                        </center>
                        <br>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4">
            <div class="card card-salmon-pink text-white">
               <div class="card-body d-flex justify-content-between align-items-end">
                  <div class="row">
                     <div class="col-md-3 col-sm-12">
                        <i class="fa fa-user" aria-hidden="true"></i>
                     </div>
                     <div class="col-md-9 col-sm-12">
                        <strong class="heading-card">
                           <h2>Total Exams</h2>
                        </strong>
                     </div>
                     <br>
                     <div class="col-md-1 col-sm-12">
                     </div>
                     <div class="col-md-11 col-sm-12">
                        <center>
                           <h1>{{$exam ?? 0}}</h1>
                        </center>
                        <br>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4">
            <div class="card card-blue-green text-white">
               <div class="card-body d-flex justify-content-between align-items-end">
                  <div class="row">
                     <div class="col-md-3 col-sm-12">
                      <i class="fa fa-book" aria-hidden="true"></i>
                   </div>
                   <div class="col-md-9 col-sm-12">
                     <strong class="heading-card">
                        <h2>Total Attend Exam</h2>
                     </strong>
                  </div>
                  <br>
                  <div class="col-md-1 col-sm-12">
                  </div>
                  <div class="col-md-11 col-sm-12">
                     <center>
                        <h1>{{$attempt_exam ?? 0}}</h1>
                     </center>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </div>
     <!--  <div class="col-12 col-sm-6 col-md-4">
         <div class="card card-purple-pink text-white">
            <div class="card-body d-flex justify-content-between align-items-end">
               <div class="row">
                  <div class="col-md-3 col-sm-12">
                     <i class="fa fa-book" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-9 col-sm-12">
                     <strong class="heading-card">
                        <h2>Total Subjects</h2>
                     </strong>
                  </div>
                  <br>
                  <div class="col-md-1 col-sm-12">
                  </div>
                  <div class="col-md-11 col-sm-12">
                     <center>
                        <h1>100</h1>
                     </center>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
     <!--  <div class="col-12 col-sm-6 col-md-4">
         <div class="card card-blue-green text-white">
            <div class="card-body d-flex justify-content-between align-items-end">
               <div class="row">
                  <div class="col-md-3 col-sm-12">
                     <i class="fa fa-book" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-9 col-sm-12">
                     <strong class="heading-card">
                        <h2>Total Subjects</h2>
                     </strong>
                  </div>
                  <br>
                  <div class="col-md-1 col-sm-12">
                  </div>
                  <div class="col-md-11 col-sm-12">
                     <center>
                        <h1>100</h1>
                     </center>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
     <!--  <div class="col-12 col-sm-6 col-md-4">
         <div class="card card-purple-blue text-white mb-3 mb-md-0">
            <div class="card-body d-flex justify-content-between align-items-end">
               <div class="row">
                  <div class="col-md-3 col-sm-12">
                     <i class="fa fa-book" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-9 col-sm-12">
                     <strong class="heading-card">
                        <h2>Total Subjects</h2>
                     </strong>
                  </div>
                  <br>
                  <div class="col-md-1 col-sm-12">
                  </div>
                  <div class="col-md-11 col-sm-12">
                     <center>
                        <h1>100</h1>
                     </center>
                     <br>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
   </div>
</div>
</div>
<!-- <style type="text/css">
   
@media (min-width:992px) {
    .container {
        max-width: 960px
    }
      .dropdown-item{
    margin-bottom: 14px;
  }
}
</style> -->
@include('front.common.footer')