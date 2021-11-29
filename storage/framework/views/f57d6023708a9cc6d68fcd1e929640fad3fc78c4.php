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
            <h1 class="main-title float-left">Subscription</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Subscription</li>
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
              <h3>Subscription List</h3>
              <span class="pull-right">
                <a href="<?php echo e(route('admin.subscription.add', ['back_url'=>$BackUrl])); ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus" aria-hidden="true"></i> Add New Subscription</a>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Name</th>
                     
                     <th scope="col">Description</th>
                     <th scope="col">MRP</th>
                     <th scope="col">Selling Price</th>
                     <th scope="col">Duration (In Days)</th>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subscription to Users </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="">
        <input type="hidden" name="sub_id" id="sub_id" >
        <label>Users</label>
        <div id="users_html">

        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>






<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>

  var i = 1;

  var table = $('#dataTable').DataTable({


   ordering: false,
   processing: true,
   serverSide: true,
   ajax: '<?php echo e(route("admin.subscription.list")); ?>',
   columns: [
   {
    "render": function() {
      return i++;
    }
  },
  { data: 'name', name: 'name' ,searchable: false, orderable: false},
  { data: 'description', name: 'description' },
  { data: 'mrp', name: 'mrp' },
  { data: 'price', name: 'price' },
  { data: 'duration', name: 'duration' },
  { data: 'status', name: 'status' },
  { data: 'created_at', name: 'created_at' },
  { data: 'action', searchable: false, orderable: false }

  ],
});

  function change_subs_status(subid){
    var status = $('#change_subs_status'+subid).val();


    var _token = '<?php echo e(csrf_token()); ?>';

    $.ajax({
      url: "<?php echo e(route($routeName.'.subscription.change_status')); ?>",
      type: "POST",
      data: {subid:subid, status:status},
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

</script>



<?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/subscription/index.blade.php ENDPATH**/ ?>