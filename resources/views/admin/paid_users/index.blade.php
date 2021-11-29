@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'influencer/thumb/';
?>

<div class="content-page">

  <!-- Start content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-12">
          <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Exam Paid User</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Exam Paid User</li>
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
            <h3>Subscription to Users</h3>
          </div>

          <form method="POST" action="" enctype='multipart/form-data'>
            {{csrf_field()}}
          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
              <label>Choose Users</label>
             <select class="form-control select2" name="user_ids[]" multiple>
                <?php if(!empty($users)){
                  foreach($users as $user){
                  ?>
                  <option value="{{$user->id}}">{{$user->name}} - ({{$user->phone}}, {{$user->email}})</option>
                <?php }}?>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
              <label>Choose Exam</label>

            <select class="form-control select2" name="exam_id">
                 <?php if(!empty($exams)){
                foreach($exams as $exam){?>
                <option value="{{$exam->id}}">{{$exam->title}}</option>
              <?php }}?>

              </select>
            </div>

           
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
              <label>&nbsp;&nbsp;&nbsp;</label>
             <button class="btn btn-success">Submit</button>

           </div>

         </div>
         </form>

       </div>

     </div>
   </div>












       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
          <div class="card mb-3">
             <div class="card-header">
              <h3>Choose Exam</h3>
            </div>
            <div class="card-body">
             <select class="form-control select2" id="exam_filter">
              <option value="0" selected>All</option>
              <?php if(!empty($exams)){
                foreach($exams as $exam){?>
                <option value="{{$exam->id}}">{{$exam->title}}</option>
              <?php }}?>

             </select>
            </div>
          </div>
          <!-- end card-->
        </div>
      </div>










      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Exam Paid User List</h3>
              <span class="pull-right">
             <a href="{{ route('admin.paid_user.export')}}" class="btn btn-primary btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i>  Export</a>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Name</th>
                     <th scope="col">Exam Name</th>
                     <th scope="col">Email</th>
                     <th scope="col">Phone</th>
                     <th scope="col">Date Created</th>
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
   ajax: {
          url: '{{ route("admin.paid_user.get_paid_users")}}',
          data: function (d) {
                d.exam_id = $('#exam_filter').val(),
                d.search = $('input[type="search"]').val()
            }
      }, 


   columns: [
   { data: 'id', name: 'id' },
   { data: 'name', name: 'name' ,searchable: false, orderable: false},
   { data: 'exam_name', name: 'exam_name' ,searchable: false, orderable: false},
   { data: 'email', name: 'email' },
   { data: 'phone', name: 'phone' },
   { data: 'created_at', name: 'created_at' },
   ],
});
$('#exam_filter').change(function(){
        table.draw();
    });

function change_status(userid){
  var status = $('#change_status'+userid).val();


   var _token = '{{ csrf_token() }}';

            $.ajax({
                url: "{{ route($routeName.'.users.change_status') }}",
                type: "POST",
                data: {userid:userid, status:status},
                dataType:"JSON",
                headers:{'X-CSRF-TOKEN': _token},
                cache: false,
                success: function(resp){
                    if(resp.success){
                      alert(resp.message);
                    }else{
                      alert(resp.message);
                      
                    }
                }
            });


}

$("#delete_item").click(function(){
  alert("The paragraph was clicked.");
});

</script>