<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'events/thumb/';
$labels = [];

$rightans = [];
$wrongans = [];

if(!empty($questions) && count($questions) > 0){
  $i =  1;
  foreach($questions as $que){
    $labels[] = $i++;
    $right = 0;
    $wrong = 0;
    $answers = \App\EventQuestionAnswer::where('question_id',$que->id)->where('event_id',$event_id)->get();
    if(!empty($answers)){
      foreach($answers as $ans){
        if($ans->option_id == $que->right_option){
         $right+=1;
       }else{
        $wrong+=1;
      }
    }

  }
  $rightans[] = $right;
  $wrongans[] = $wrong;


}




}



$labels = implode(", ", $labels);
$rightans =implode(', ', $rightans);
$wrongans =  implode(', ', $wrongans);


//echo $labels;




?>


<div class="content-page">

  <!-- Start content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-12">
          <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Q & A Analysis</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Q & A Analysis</li>
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
              <h3>Q & A Analysis - <?php echo e($event->title ?? ''); ?></h3>
              <h6>Total Joined User - <?php echo e($event_users); ?></h6>
              <span class="pull-right">
               <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
               <a href="<?php echo e(url($back_url)); ?>" class="btn btn-success btn-sm" style='float: right;'>Back</a>
             <?php } ?>
           </span>
         </div>

         <div class="card-body">

          <div class="row">
            <?php if(!empty($questions) && count($questions) > 0){?>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <canvas id="question_answer_analysis"></canvas>

                  </div>
                </div>
              <?php }else{?>
                <p>No Questions Found</p>
              <?php }?>



              <!-- end card-->
            </div>

          </div>
          <!-- end row -->

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

  var ctx_combo_bar = document.getElementById("question_answer_analysis").getContext('2d');
  var question_answer_analysis = new Chart(ctx_combo_bar, {
    type: 'bar',
    data: {
    // labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    labels: [<?php echo e($labels); ?>],



    datasets: [

    {
      type: 'bar',
      label: 'Right',
      backgroundColor: '#059BFF',
      data: [<?php echo e($rightans); ?>],
      borderColor: 'white',
      borderWidth: 0
    }, {
      type: 'bar',
      label: 'Wrong',
      backgroundColor: '#FF6B8A',
      data: [<?php echo e($wrongans); ?>],
    },



    ], 
    borderWidth: 1
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero:true
        }
      }]
    }
  }
});


</script>
<?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/events/analysis.blade.php ENDPATH**/ ?>