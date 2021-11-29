<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$events_id = (isset($events->id))?$events->id:'';
$image = (isset($events->image))?$events->image:'';
$title = (isset($events->title))?$events->title:'';
$influencers_id = (isset($events->influencers_id))?$events->influencers_id:'';
$event_date = (isset($events->event_date))?$events->event_date:'';
$subscription_price = (isset($events->subscription_price))?$events->subscription_price:'';
$start_time = (isset($events->start_time))?$events->start_time:'';
$end_time = (isset($events->end_time))?$events->end_time:'';
$about = (isset($events->about))?$events->about:'';




$status = (isset($events->status))?$events->status:'';
$location = (isset($events->location))?$events->location:'';
$priority = (isset($events->priority))?$events->priority:'';


$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'events/';

?>



<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"><?php echo e($page_heading); ?></h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active"><?php echo e($page_heading); ?></li>
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
                            <h3><i class="far fa-hand-pointer"></i><?php echo e($page_heading); ?></h3>

                            <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                            <a href="<?php echo e(url($back_url)); ?>" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>
                        </div>

                        <div class="card-body">

                           <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
                            <?php echo e(csrf_field()); ?>


                             <input type="hidden" name="id" value="<?php echo e($events_id); ?>">


                            <div class="form-group">
                                <label for="userName">Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" value="<?php echo e(old('title', $title)); ?>" id="title" class="form-control"  maxlength="255" />

                                 <?php echo $__env->make('snippets.errors_first', ['param' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>



                            <div class="form-group">
                                <label for="emailAddress">Location<span class="text-danger">*</span></label>
                                <input type="text" name="location" value="<?php echo e(old('location', $location)); ?>" id="location" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'location'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>



                            <div class="form-group">
                                <label for="pass1">Influencer Name:<span class="text-danger">*</span></label>
                               <select name="influencers_id" class="form-control">
                   <?php if(!empty($influencers)){
                    foreach($influencers as $infu){
                    ?>
                    <option value="<?php echo e($infu->id); ?>" <?php if($infu->id == $influencers_id) echo "selected"?>><?php echo e($infu->name); ?></option>

                <?php }}?>

                </select>

                    <?php echo $__env->make('snippets.errors_first', ['param' => 'influencers_id'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>




                            <div class="form-group">
                                <label for="passWord2">Event Date:<span class="text-danger">*</span></label>
                                <input type="date" name="event_date" value="<?php echo e(old('event_date', $event_date)); ?>" id="event_date" class="form-control" />

                            <?php echo $__env->make('snippets.errors_first', ['param' => 'event_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    


                           </div>



                           <div class="form-group">


                            <label>Start Time:</label>
                            <div>
                              <input type="time" name="start_time" value="<?php echo e(old('start_time', $start_time)); ?>" id="start_time" class="form-control"  maxlength="255" />

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'start_time'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         </div>
                     </div>


                <div class="form-group">


                            <label>End Time:</label>
                            <div>
                              <input type="time" name="end_time" value="<?php echo e(old('end_time', $end_time)); ?>" id="end_time" class="form-control" />

                    <?php echo $__env->make('snippets.errors_first', ['param' => 'end_time'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         </div>
                     </div>











                      <div class="form-group">
                                <label for="pass1">About<span class="text-danger">*</span></label>
                               <textarea name="about" id="description" class="form-control ckeditor" ><?php echo old('about', $about); ?></textarea>    

                    <?php echo $__env->make('snippets.errors_first', ['param' => 'about'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>






                            <div class="form-group">
                                <label for="passWord2">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" name="image"/>

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'image'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php
                                if(!empty($image)){
                                    if($storage->exists($path.$image))
                                    {
                                        ?>
                                        <div class="col-md-2 image_box">
                                           <img src="<?php echo e(url('public/storage/'.$path.'thumb/'.$image)); ?>" style="width: 100px;"><br>
                                           <a href="javascript:void(0)" data-id="<?php echo e($id); ?>" data='image' class="del_image">Delete</a>
                                       </div>
                                       <?php        
                                   }

                                   ?>
                                   <?php
                               }
                               ?>




                           </div>






                            <div class="form-group">
                                <label for="pass1">Subscription Fee:<span class="text-danger">*</span></label>
                                <input type="text" name="subscription_price" value="<?php echo e(old('subscription_price', $subscription_price)); ?>" class="form-control">
               
                <?php echo $__env->make('snippets.errors_first', ['param' => 'subscription_price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>










                     <div class="form-group">
                        <label>Status</label>
                        <div>
                           Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                           &nbsp;
                           Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                           <?php echo $__env->make('snippets.errors_first', ['param' => 'status'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       </div>
                   </div>



                   <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                    <a type="reset" href="<?php echo e(route('admin.events.index')); ?>" class="btn btn-secondary m-l-5">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div><!-- end card-->
</div>






<script type="text/javascript">

    $(document).ready(function(){

        $(".del_image").click(function(){

            var current_sel = $(this);

            var image_id = $(this).attr('data-id');

            var type = $(this).attr('data');

                //alert(type); return false;

                conf = confirm("Are you sure to Delete this Image?");

                if(conf){

                    var _token = '<?php echo e(csrf_token()); ?>';

                    $.ajax({
                        url: "<?php echo e(route($routeName.'.influencers.ajax_delete_image')); ?>",
                        type: "POST",
                        data: {image_id , type},
                        dataType:"JSON",
                        headers:{'X-CSRF-TOKEN': _token},
                        cache: false,
                        beforeSend:function(){
                         $(".ajax_msg").html("");
                     },
                     success: function(resp){
                        if(resp.success){
                            $(".ajax_msg").html(resp.msg);
                            current_sel.parent('.image_box').remove();
                        }
                        else{
                            $(".ajax_msg").html(resp.msg);
                        }

                    }
                });
                }

            });

    });
</script>

<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
CKEDITOR.replace( 'description' );
</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/events/form.blade.php ENDPATH**/ ?>