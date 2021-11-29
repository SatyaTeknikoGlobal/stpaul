@include('front.common.header')
<div class="slider-area">
   <div class="slider-height2 d-flex align-items-center">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="hero-cap hero-cap2 text-center">
                  <h2>My Results</h2>
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

               <?php if (!empty($attempted)) {
                 foreach ($attempted as $e) {
                   $exam = \App\Exam::where('id',$e->exam_id)->first();
                   $date = date("F d, Y ", strtotime($exam->start_date));
                   $description = mb_strlen(strip_tags($exam->description),'utf-8') > 50 ? mb_substr(strip_tags($exam->description),0,50,'utf-8').'...' : strip_tags($exam->description);

                 ?>

               <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                  <div class="single-cat mb-50 exams">
                     <!-- <div class="cat-icon">
                        <span class="flaticon-web-design"></span>
                        </div> -->
                     <div class="cat-cap">
                        <h5><a href="#">{{$exam->title ??'' }}</a></h5>
                        <h5 ><b class="cat-text">{{$date}}</b></h5>
                        <p>{!!($description)!!}</p>
                        <a href="{{route('home.result_details',['exam_id'=>$exam->id])}}">
                        <button type="submit" class="btn btn-primary">
                        Check Result
                        </button>
                        </a>
                     </div>
                  </div>
               </div>
             <?php } } else{?>


               <p>No Exam Found</p>

             <?php }?>
             
            </div>

         </div>
   </div>
</div>
@include('front.common.footer')
<style>
   
   .categories-area .single-cat .cat-cap a{

   }

   .btn-primary{
      font-size: 14px !important;

   }
</style>