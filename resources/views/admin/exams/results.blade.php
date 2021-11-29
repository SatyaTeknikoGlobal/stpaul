@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'exams/thumb/';
?>


<div class="content-page">

  <!-- Start content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-12">
          <div class="breadcrumb-holder">
            <h1 class="main-title float-left">{{$exam->title ?? ''}} Analysis</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">{{$exam->title ?? ''}}</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- end row -->
      @include('snippets.errors')
      @include('snippets.flash')
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>{{$exam->title ?? ''}} Results ({{count($rank)}})</h3>
              <span class="pull-right">

                <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">#</th>
                     <th scope="col">User Name</th>
                     <th scope="col">Correct Answer</th>
                     <th scope="col">Wrong Answer</th>
                     <th scope="col">Skip Answer</th>
                     <th scope="col">Time(In Sec.)</th>
                     <th scope="col">Rank</th>
                     <th scope="col">Obtain Marks</th>
                   </tr>
                 </thead>
               </table>
             </div>
             <!-- end table-responsive-->

           </div>
           <!-- end card-body-->

         </div>
         <!-- end card-->

       </div>

     </div>
     <!-- end row-->

   </div>
   <!-- END container-fluid -->

 </div>
 <!-- END content -->

</div>
<!-- END content-page -->



@include('admin.common.footer')

<script>
  var i = 1;

  var table = $('#dataTable').DataTable({
   ordering: false,
   processing: true,
   serverSide: true,
   ajax: '{{ route("admin.exams.get_result_list",['exam_id'=>$exam->id])}}',
   columns: [
   { data: 'id', name: 'id' },
   { data: 'user_name', name: 'user_name'},
   { data: "correct_ans",name: 'correct_ans',},
   { data: "wrong_ans",name: 'wrong_ans',},
   { data: "skipped_ans",name: 'skipped_ans',},
   { data: 'time_taken', name: 'time_taken' },
   { data: 'rank', name: 'rank' },
   { data: 'marks', name: 'marks' },
   ],
 });




</script>

<script>
 
</script>