<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$subscription_id = (isset($subscription->id))?$subscription->id:'';

$name = (isset($subscription->name))?$subscription->name:'';
$description = (isset($subscription->description))?$subscription->description:'';
$status = (isset($subscription->status))?$subscription->status:1;
$mrp = (isset($subscription->mrp))?$subscription->mrp:'';
$price = (isset($subscription->price))?$subscription->price:'';
$duration = (isset($subscription->duration))?$subscription->duration:'';



$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'subscription/';

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


                            <input type="hidden" name="id" value="<?php echo e($subscription_id); ?>">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name', $name)); ?>" id="name" class="form-control"  maxlength="255" />

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>



                            <div class="form-group">
                                <label for="emailAddress">MRP<span class="text-danger">*</span></label>
                                <input type="text" name="mrp" value="<?php echo e(old('mrp', $mrp)); ?>" id="mrp" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'mrp'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>


                            <div class="form-group">
                                <label for="emailAddress">Selling Price<span class="text-danger">*</span></label>
                                <input type="text" name="price" value="<?php echo e(old('price', $price)); ?>" id="price" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>



                            <div class="form-group">
                                <label for="emailAddress">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="description"><?php echo e(old('description', $description)); ?></textarea>
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>

                            <div class="form-group">
                                <label for="emailAddress">Duration(In Days)<span class="text-danger">*</span></label>
                                <input type="text" name="duration" value="<?php echo e(old('duration', $duration)); ?>" id="duration" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'duration'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/subscription/form.blade.php ENDPATH**/ ?>