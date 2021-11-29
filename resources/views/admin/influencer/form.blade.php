@include('admin.common.header')
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
                        <h1 class="main-title float-left">{{ $page_heading }}</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">{{ $page_heading }}</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            @include('snippets.errors')
            @include('snippets.flash')


            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="far fa-hand-pointer"></i>{{ $page_heading }}</h3>

                            <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                            <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>
                        </div>

                        <div class="card-body">

                         <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{$influencer_id}}">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $name) }}" id="name" class="form-control"  maxlength="255" />

                                @include('snippets.errors_first', ['param' => 'name'])
                            </div>

                            <div class="form-group">
                                <label for="emailAddress">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" value="{{ old('email', $email) }}" id="email" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'email'])

                            </div>


                            <div class="form-group">
                                <label for="emailAddress">Phone<span class="text-danger">*</span></label>
                                <input type="text" name="mobile" value="{{ old('mobile', $mobile) }}" id="mobile" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'mobile'])

                            </div>




                            <div class="form-group">
                                <label for="emailAddress">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" value="" id="password" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'password'])

                            </div>






                            <div class="form-group">
                                <label for="emailAddress">Location<span class="text-danger">*</span></label>
                                <input type="text" name="location" value="{{ old('location', $location) }}" id="location" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'location'])

                            </div>



                            <div class="form-group">
                                <label for="pass1">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control ckeditor" ><?php echo old('description', $description); ?></textarea>    

                                @include('snippets.errors_first', ['param' => 'description'])
                            </div>




                            <div class="form-group">
                                <label for="passWord2">Image<span class="text-danger">*</span></label>
                                <input type="file" id="image" name="image"/>

                                @include('snippets.errors_first', ['param' => 'image'])

                                <?php
                                if(!empty($image)){
                                    if($storage->exists($path.$image))
                                    {
                                        ?>
                                        <div class="col-md-2 image_box">
                                         <img src="{{ url('public/storage/'.$path.'thumb/'.$image) }}" style="width: 100px;"><br>
                                         <a href="javascript:void(0)" data-id="{{ $id }}" data='image' class="del_image">Delete</a>
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
                               <input type="text" name="priority" value="{{ old('priority', $priority) }}" class="form-control">

                               @include('snippets.errors_first', ['param' => 'priority'])
                           </div>
                       </div>
                       <div class="form-group">
                        <label>Status</label>
                        <div>
                         Active: <input type="radio" name="status" value="1" <?php echo ($status == '1')?'checked':''; ?> checked>
                         &nbsp;
                         Inactive: <input type="radio" name="status" value="0" <?php echo ( strlen($status) > 0 && $status == '0')?'checked':''; ?> >

                         @include('snippets.errors_first', ['param' => 'status'])
                     </div>
                 </div>



                 <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                    <a type="reset" href="{{ route('admin.influencers.index') }}" class="btn btn-secondary m-l-5">
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


@include('admin.common.footer')
<script>
    CKEDITOR.replace( 'description' );
</script>