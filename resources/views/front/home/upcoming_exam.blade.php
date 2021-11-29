@include('front.common.header')
<div class="slider-area">
   <div class="slider-height2 d-flex align-items-center">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="hero-cap hero-cap2 text-center">
                  <h2>Upcoming Exams</h2>
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

               <?php if (!empty($exams) && count($exams) > 0) {
                 foreach ($exams as $e) {
                  // $exam = \App\Exam::where('id',$e->exam_id)->first();
                  //  $date = date("F d, Y ", strtotime($exam->start_date));
                   $description = mb_strlen(strip_tags($e->description),'utf-8') > 50 ? mb_substr(strip_tags($e->description),0,50,'utf-8').'...' : strip_tags($e->description);
                    $description1 = mb_strlen(strip_tags($e->description),'utf-8') > 5000 ? mb_substr(strip_tags($e->description),0,5000,'utf-8').'...' : strip_tags($e->description);

                 ?>

               <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                  <div class="single-cat mb-50 exams ">
                     <!-- <div class="cat-icon">
                        <span class="flaticon-web-design"></span>
                        </div> -->
                     <div class="cat-cap">
                        <h5><a href="#">{{$e->title ??'' }}</a></h5>
                        <h5 ><b class="cat-text">{{$e->start_date ?? ''}}</b></h5>
                        <p>{!!($description)!!}</p>
                          <a href="#"  data-toggle="modal" data-target="#basicModal{{ $e->id }}">
                        <button type="submit" class="btn btn-primary">
                        <!-- <a href="{{route('home.exam_details',['exam_id'=>$e->id])}}"> -->
                         
                       Details
                        </button>
                        </a>
                         <div class="modal fade" id="basicModal{{$e->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header" style="background: #0d1081b5;">
                                        <h4 class="modal-title" id="myModalLabel" style="color: #fff;">Exam Description #{{$e->title ??''}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <h3 style="text-transform: uppercase;"> {{$e->title ??''}} </h3><br>
                                        <h3> <b>{{date("F d, Y ", strtotime($e->start_date))}}</b></h3>
                                        <hr>
                                       <h4 style="margin-bottom: 0px!important;text-align: justify;font-size: 16px;color: #000;">{!!($description1)!!} </h4>

                                        <br>
                                        <a  href="{{route('home.exam_details',['exam_id'=>$e->id])}}"> <button type="button" class="btn btn-primary">Continue>></button>
                                        </a>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                     </div>
                  </div>
               </div>
             <?php } } else{?>
             <div class="col-md-12">  <h5 class="text-center"><b>No Exam Found</b></h5></div>

             <?php }?>
             
            </div>

         </div>
   </div>
</div>
@include('front.common.footer')