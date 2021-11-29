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
            <h1 class="main-title float-left">Users Transactions</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Users Transactions</li>
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
            <h3>Credit/Debit User Wallet</h3>
          </div>

          <form method="POST" action="">
            <?php echo e(csrf_field()); ?>

          <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
             <select class="form-control select2" name="user_id">
              <option value="" disabled selected>Select User</option>
              <?php if(!empty($users)){
                foreach($users as $user){?>
                  <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php }}?>

              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
              <select name="type" class="form-control">
                <option value="CREDIT">CREDIT</option>
                <option value="DEBIT">DEBIT</option>
              </select>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
              <input type="text" name="amount" class="form-control" value="" placeholder="Enter Amount">
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
              <textarea name="description" class="form-control" placeholder="Enter Any Description"></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
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
          <h3>Filter By Users</h3>
        </div>

      <div class="card-body d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">

         <select class="form-control select2" id="user_transactions">
          <option value="0" selected>All</option>
          <?php if(!empty($users)){
            foreach($users as $user){?>
              <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
            <?php }}?>

          </select>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">

               <select name="type" class="form-control" id="type_change">
                <option selected value="" disabled>Select Type</option>
                <option value="CREDIT">CREDIT</option>
                <option value="DEBIT">DEBIT</option>
              </select>
        </div>




        </div>
      </div>
      <!-- end card-->
    </div>
  </div>


  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="card mb-3">
        <div class="card-header">
          <h3>Users Transactions List</h3>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
              <thead>
                <tr>
                 <th scope="col">ID</th>
                 <th scope="col">Name</th>
                 <th scope="col">Type</th>
                 <th scope="col">Amount</th>
                 <th scope="col">Description</th>
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



<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>


  var i = 1;
  var table = $('#dataTable').DataTable({
   ordering: false,
   processing: true,
   serverSide: true,

   ajax: {
    url: '<?php echo e(route("admin.transactions.get_transactions")); ?>',
    data: function (d) {
      d.user_id = $('#user_transactions').val(),
      d.type = $('#type_change').val(),
      d.search = $('input[type="search"]').val()
    }
  },


  columns: [
  { data: 'id', name: 'id' },
  { data: 'name', name: 'name' ,searchable: false, orderable: false},
  { data: 'type', name: 'type' },
  { data: 'amount', name: 'amount' },
  { data: 'description', name: 'description' },
  { data: 'created_at', name: 'created_at' },


  ],
});

  $('#user_transactions').change(function(){
    table.draw();
  });

  $('#type_change').change(function(){
    table.draw();
  });



</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/transaction/index.blade.php ENDPATH**/ ?>