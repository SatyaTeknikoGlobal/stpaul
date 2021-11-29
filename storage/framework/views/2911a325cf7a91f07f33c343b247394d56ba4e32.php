<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
            <h1 class="main-title float-left">Exams Questions List</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Exams Questions List</li>
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


           <div class="card-header  d-flex">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
              <h3>Import Questions</h3>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">

             </div>
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <a href="<?php echo e(url('public/assets/uploads/stpaulquestionsample.xlsx')); ?>" class="btn btn-success">Sample</a>
            </div>
          </div>



          <form method="POST" action="" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

              <div class="card-body d-flex">
             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">
            <input type="file" name="importfile" value=""  class="form-control">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
             <button class="btn btn-success">Submit</button>

           </div>

           </div>

         </div>
         </form>

       </div>

     </div>
 
















      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Exams Question List</h3>
              <span class="pull-right">
                <a href="<?php echo e(route('admin.exams.add_question',['exam_id'=>$exam_id, 'back_url'=>$routeName.'/exams/import/'.$exam_id])); ?>" class="btn btn-primary btn-sm"><i class="fas fa-user-plus" aria-hidden="true"></i> Add New Question</a>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">#</th>
                     <th scope="col">Question Title</th>
                     <th scope="col">Option 1</th>
                     <th scope="col">Option 2</th>
                     <th scope="col">Option 3</th>
                     <th scope="col">Option 4</th>
                     <th scope="col">Right Option</th>
                     <th scope="col">Difficulti Level</th>
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
   ajax: '<?php echo e(route("admin.exams.get_exam_question",['exam_id'=>$exam_id])); ?>',
   columns: [
   { data: 'id', name: 'id' },
   { data: 'question_name', name: 'question_name'},
   { data: "option_1",name: 'option_1',},
   { data: "option_2",name: 'option_2',},
   { data: "option_3",name: 'option_3',},
   { data: "option_4",name: 'option_4',},
   { data: "right_option",name: 'right_option',},
   { data: "difficulti_level",name: 'difficulti_level',},
   { data: 'status', name: 'status' },
   { data: 'created_at', name: 'created_at' },
   { data: 'action', searchable: false, orderable: false }

   ],
 });




</script>

<script>
function change_status(exam_id){
  var status = $('#change_status'+exam_id).val();


   var _token = '<?php echo e(csrf_token()); ?>';

            $.ajax({
                url: "<?php echo e(route($routeName.'.exams.change_status')); ?>",
                type: "POST",
                data: {exam_id:exam_id, status:status},
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
</script><?php /**PATH /home/stpaul/public_html/resources/views/admin/exams/import.blade.php ENDPATH**/ ?>