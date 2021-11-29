<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$user_id = (isset($users->id))?$users->id:'';
$image = (isset($users->image))?$users->image:'';
$name = (isset($users->name))?$users->name:'';
$email = (isset($users->email))?$users->email:'';
$phone = (isset($users->phone))?$users->phone:'';
$dob = (isset($users->dob))?$users->dob:'';
$status = (isset($users->status))?$users->status:'';
$location = (isset($users->location))?$users->location:'';
$priority = (isset($users->priority))?$users->priority:'';
$gender = (isset($users->gender))?$users->gender:'';
$id_card = (isset($users->id_card))?$users->id_card:'';


$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'users/';

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


                            <input type="hidden" name="id" value="<?php echo e($user_id); ?>">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name', $name)); ?>" id="name" class="form-control"  maxlength="255" />

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>



                            <div class="form-group">
                                <label for="emailAddress">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?php echo e(old('email', $email)); ?>" id="email" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>


                             <div class="form-group">
                                <label for="emailAddress">Phone<span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="<?php echo e(old('phone', $phone)); ?>" id="phone" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'phone'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>



                               <div class="form-group">
                                <label for="emailAddress">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" value="" id="password" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>






                             <div class="form-group">
                                <label for="emailAddress">DOB<span class="text-danger">*</span></label>
                                <input type="date" name="dob" value="<?php echo e(old('dob', $dob)); ?>" id="dob" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'dob'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </div>


                             <div class="form-group">
                                <label for="emailAddress">Aadhar Card or Pan Number<span class="text-danger">*</span></label>
                                <input type="text" name="id_card" value="<?php echo e(old('id_card', $id_card)); ?>" id="id_card" class="form-control"  maxlength="255" />
                                <?php echo $__env->make('snippets.errors_first', ['param' => 'id_card'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                <label for="emailAddress">Gender<span class="text-danger">*</span></label>
                                     Male: <input type="radio" name="gender" value="male" <?php echo ($gender == 'male')?'checked':''; ?> checked>
                           &nbsp;
                           Female: <input type="radio" name="gender" value="female"  <?php echo ($gender == 'female')?'checked':''; ?> >

                                <?php echo $__env->make('snippets.errors_first', ['param' => 'gender'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
</script><?php /**PATH /home/stpaul/public_html/resources/views/admin/users/form.blade.php ENDPATH**/ ?>