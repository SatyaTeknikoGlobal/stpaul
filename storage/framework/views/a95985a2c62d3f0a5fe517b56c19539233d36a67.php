<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
$storage = Storage::disk('public');

    //pr($storage);

$path = 'user/';

$imageUrl = asset('public/assets/images/avatars/avatar.png');
$image_name = Auth::guard('admin')->user()->image; 
 if($storage->exists($path.$image_name)){

    $imageUrl =  url('public/storage/'.$path.'thumb/'.$image_name);
 }

?>


<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">My Profile</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="far fa-user"></i> Profile details</h3>
                        </div>

                        <div class="card-body">


                            <form action="<?php echo e(route('admin.profile')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username (required)</label>
                                            <input class="form-control" name="username" type="text" value="<?php echo e(Auth::guard('admin')->user()->username); ?>" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Valid Email (required)</label>
                                            <input class="form-control" name="email" type="email" value="<?php echo e(Auth::guard('admin')->user()->email); ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" name="phone" value="<?php echo e(Auth::guard('admin')->user()->phone); ?>" type="text" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" value="<?php echo e(Auth::guard('admin')->user()->address); ?>" name="address" type="text" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>

                                


                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Edit profile</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>



                <!-- end col -->

                <style type="text/css">
                #my-file { visibility: hidden; }

            </style>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3><i class="far fa-file-image"></i> Avatar</h3>
                    </div>

                    <div class="card-body text-center">

                        <div class="row">
                            <div class="col-lg-12">
                                <img alt="avatar" class="img-fluid" src="<?php echo e($imageUrl); ?>">
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.upload')); ?>" id="file_upload" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <input type="file" name="file" id="my-file">
                        </form>

                        <div class="row">
                            <div class="col-lg-12">

                                <button type="button" class="btn btn-info btn-block mt-3" id="my-button">Change avatar</button>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- end col -->


        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="far fa-user"></i>Change Password</h3>
                        </div>

                        <div class="card-body">


                            <form action="<?php echo e(route('admin.change_password')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Old Password (required)</label>
                                            <input class="form-control" name="old_password" type="password" value=""/>
                                        </div>
                                    </div>

                                    <?php echo $__env->make('snippets.errors_first', ['param' => 'old_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password (required)</label>
                                            <input class="form-control" name="new_password" type="password" value="" />
                                        </div>
                                    </div>
                                    <?php echo $__env->make('snippets.errors_first', ['param' => 'new_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Confirm Password (required)</label>
                                            <input class="form-control" name="confirm_password" type="password" value=""/>
                                        </div>
                                    </div>
                                    <?php echo $__env->make('snippets.errors_first', ['param' => 'confirm_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- end card-body -->

                    </div>
                    <!-- end card -->

                </div>


        </div>



    </div>
    <!-- END container-fluid -->

</div>
<!-- END content -->

</div>
<!-- END content-page -->







<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<script type="text/javascript">
    $('#my-button').click(function(){
        $('#my-file').click();
    });
    $('#my-file').change(function(){
        $('#file_upload').submit();

    });

</script><?php /**PATH /home/devclub/fansstudio.devclub.co.in/resources/views/admin/profile/index.blade.php ENDPATH**/ ?>