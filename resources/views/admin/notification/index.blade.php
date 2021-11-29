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
            <h1 class="main-title float-left">Send Notification</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Send Notification</li>
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
            <h3>Send Notification To All</h3>
          </div>

          <form method="POST" action="" enctype='multipart/form-data'>
            {{csrf_field()}}
          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
             <select class="form-control select2" name="user_id1">
              <option value="0">All</option>
              </select>
            </div>

             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
            <input type="text" name="title1" value="Fans Studio" placeholder="Enter Title" class="form-control">
            </div>


             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
             <textarea class="form-control" name="text1" placeholder="Enter Description"></textarea>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
              <input type="file" name="image1" class="form-control" value="" placeholder="Enter Amount">
            </div>

           
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
             <button class="btn btn-success">Submit</button>

           </div>

         </div>
         </form>

       </div>

     </div>
   </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
           <div class="card-header">
            <h3>Send Notification Specific User</h3>
          </div>

          <form method="POST" action="" enctype='multipart/form-data'>
            {{csrf_field()}}
          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
             <select class="form-control select2" name="user_id2[]" multiple="multiple">
              <?php if(!empty($users)){
                foreach($users as $user){?>
                  <option value="{{$user->id}}">{{$user->name}}</option>
                <?php }}?>

              </select>
            </div>
              
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
            <input type="text" name="title2" value="Fans Studio" placeholder="Enter Title" class="form-control">
            </div>

             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
             <textarea class="form-control" name="text2" placeholder="Enter Description"></textarea>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
              <input type="file" name="image2" class="form-control" >
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
             <button class="btn btn-success">Submit</button>

           </div>

         </div>
         </form>

       </div>

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
   ajax: '{{ route("admin.users.get_users")}}',
   columns: [
   { data: 'id', name: 'id' },
  //   {
  //   "render": function() {
  //     return i++;
  //   }
  // },
   { data: 'name', name: 'name' ,searchable: false, orderable: false},
   { data: 'email', name: 'email' },
   { data: 'phone', name: 'phone' },
   { data: 'wallet', name: 'wallet' },
   { data: 'status', name: 'status' },
   { data: 'created_at', name: 'created_at' },
   { data: 'action', searchable: false, orderable: false }

   ],
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