<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$influencer_id = (isset($influencer->id))?$influencer->id:'';
$image = (isset($influencer->image))?$influencer->image:'';
$name = (isset($influencer->name))?$influencer->name:'';
$description = (isset($influencer->description))?$influencer->description:'';
$status = (isset($influencer->status))?$influencer->status:'';
$location = (isset($influencer->location))?$influencer->location:'';
$priority = (isset($influencer->priority))?$influencer->priority:'';
$email = (isset($influencer->email))?$influencer->email:'';
$mobile = (isset($influencer->mobile))?$influencer->mobile:'';


$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'influencer/';

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


                            <input type="hidden" name="id" value="<?php echo e($influencer_id); ?>">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name', $name)); ?>" id="name" class="form-control"  maxlength="255" />

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="form-group">
                                <label for="emailAddress">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" value="<?php echo e(old('email', $email)); ?>" id="email" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>


                            <div class="form-group">
                                <label for="emailAddress">Phone<span class="text-danger">*</span></label>
                                <input type="text" name="mobile" value="<?php echo e(old('mobile', $mobile)); ?>" id="mobile" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'mobile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>




                            <div class="form-group">
                                <label for="emailAddress">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" value="" id="password" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>






                            <div class="form-group">
                                <label for="emailAddress">Location<span class="text-danger">*</span></label>
                                <input type="text" name="location" value="<?php echo e(old('location', $location)); ?>" id="location" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'location'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>



                            <div class="form-group">
                                <label for="pass1">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control ckeditor" ><?php echo old('description', $description); ?></textarea>    

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <label>Priority</label>
                            <div>
                               <input type="text" name="priority" value="<?php echo e(old('priority', $priority)); ?>" class="form-control">

                               <?php echo $__env->make('snippets.errors_first', ['param' => 'priority'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           </div>
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
                    <a type="reset" href="<?php echo e(route('admin.influencers.index')); ?>" class="btn btn-secondary m-l-5">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div><!-- end card-->
</div>



</div>

</div>
<!-- END container-fluid -->

</div>
<!-- END content -->

</div>
<!-- END content-page -->


<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    CKEDITOR.replace( 'description' );
</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/influencer/form.blade.php ENDPATH**/ ?>