@include('front.common.header')

<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>My Exams</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="exTab1" class="container my-5">
  @include('front.common.leftbar')

    <div class="tab-content clearfix">
        <div class="categories-area new-cat">
            <div class="row">
               <div class="col-lg-12">
                  <h3 class="mb-5">Test1</h3>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                  <div class="single-cat data mb-50 exams11 ">
                    <div class="row">
                        <div class="col-lg-6 exam-col">
                            <h1 class="mb-3"><a href="#" class="exam1">Exam-211</a></h1>
                            <h5 class="mb-2"><b class="cat-text col1">September 21, 2021 </b></h5>
                            <p>Exam2</p>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary result">
                                <a href="" class="result">View Result</a>
                            </button>
                        </div>
                        
                    </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                  <div class="single-cat data mb-50 exams11 ">
                    <div class="row">
                        <div class="col-lg-6 exam-col">
                            <h1 class="mb-3"><a href="#" class="exam1">Exam-211</a></h1>
                            <h5 class="mb-2"><b class="cat-text col1">September 21, 2021 </b></h5>
                            <p>Exam2</p>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary result">
                                <a href="" class="result">View Result</a>
                            </button>
                        </div>
                        
                    </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                  <div class="single-cat data mb-50 exams11 ">
                    <div class="row">
                        <div class="col-lg-6 exam-col">
                            <h1 class="mb-3"><a href="#" class="exam1">Exam-211</a></h1>
                            <h5 class="mb-2"><b class="cat-text col1">September 21, 2021 </b></h5>
                            <p>Exam2</p>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary result">
                                <a href="" class="result">View Result</a>
                            </button>
                        </div>
                        
                    </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                  <div class="single-cat data mb-50 exams11 ">
                    <div class="row">
                        <div class="col-lg-6 exam-col">
                            <h1 class="mb-3"><a href="#" class="exam1">Exam-211</a></h1>
                            <h5 class="mb-2"><b class="cat-text col1">September 21, 2021 </b></h5>
                            <p>Exam2</p>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary result">
                                <a href="" class="result">View Result</a>
                            </button>
                        </div>
                        
                    </div>
                  </div>
               </div>

            </div>

         </div>
        
        
      
    </div>
</div>

@include('front.common.footer')

<style>
    .result{
       margin-top: 0px;
    font-size: 19px;
    border-radius: 10px;
    }
    .btn-primary {
         font-size: initial !important;
    }
</style>