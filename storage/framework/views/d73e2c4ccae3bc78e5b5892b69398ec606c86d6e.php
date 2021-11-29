<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
            <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
           <div class="card-header">
            <h3>Send Notification To All</h3>
          </div>

          <form method="POST" action="" enctype='multipart/form-data'>
            <?php echo e(csrf_field()); ?>

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
            <?php echo e(csrf_field()); ?>

          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
             <select class="form-control select2" name="user_id2[]" multiple="multiple">
              <?php if(!empty($users)){
                foreach($users as $user){?>
                  <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
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


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
           <div class="card-header">
            <h3>Send Notification Event Wise</h3>
          </div>

          <form method="POST" action="" enctype='multipart/form-data'>
            <?php echo e(csrf_field()); ?>

          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
             <select class="form-control select2" name="user_id3">
              <?php if(!empty($events)){
                foreach($events as $event){?>
                  <option value="<?php echo e($event->id); ?>"><?php echo e($event->title); ?></option>
                <?php }}?>

              </select>
            </div>

             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
            <input type="text" name="title3" value="Fans Studio" placeholder="Enter Title" class="form-control">
            </div>




            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
             <textarea class="form-control" name="text3" placeholder="Enter Description"></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
              <input type="file" name="image3" class="form-control" value="" placeholder="Enter Amount">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
             <button class="btn btn-success">Submit</button>

           </div>

         </div>
         </form>

       </div>

     </div>
   </div>





      <div class="row" style="display:none;">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Users List</h3>
              <span class="pull-right">
                  <a href="<?php echo e(route('admin.users.add', ['back_url'=>$BackUrl])); ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus" aria-hidden="true"></i> Add New Users</a>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Name</th>
                     <!-- <th scope="col">Image</th> -->
                     <th scope="col">Email</th>
                     <th scope="col">Phone</th>
                     <th scope="col">Wallet</th>
                     <th scope="col">Status</th>
                     <th scope="col">Date Created</th>
                     <th scope="col">Action</th>
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



<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>


  var i = 1;
  var table = $('#dataTable').DataTable({
   ordering: false,
   processing: true,
   serverSide: true,
   ajax: '<?php echo e(route("admin.users.get_users")); ?>',
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


   var _token = '<?php echo e(csrf_token()); ?>';

            $.ajax({
                url: "<?php echo e(route($routeName.'.users.change_status')); ?>",
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

</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/notification/index.blade.php ENDPATH**/ ?>