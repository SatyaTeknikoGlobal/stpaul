@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$courses_id = (isset($courses->id))?$courses->id:'';
$image = (isset($courses->image))?$courses->image:'';
$name = (isset($courses->name))?$courses->name:'';
$status = (isset($courses->status))?$courses->status:'';

$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'course/thumb/';


// pr($storage);
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

                             <input type="hidden" name="id" value="{{$courses_id}}">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $name) }}" id="name" class="form-control"  maxlength="255" placeholder="Enter Course Name" />

                                 @include('snippets.errors_first', ['param' => 'name'])
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
                                           <!-- <img src="{{ url('public/storage/'.$path.'thumb/'.$image) }}" style="width: 100px;"><br> -->
                                           <img src="{{url('storage/app/public/'.$path.'/'.$image)}}" style="width: 100px;"><br>
                                          
                                       </div>
                                       <?php        
                                   }

                                   ?>
                                   <?php
                               }
                               ?>




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
                    <a type="reset" href="{{ route('admin.course.index') }}" class="btn btn-secondary m-l-5">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div><!-- end card-->
</div>






<script type="text/javascript">

</script>

@include('admin.common.footer')
<script>
CKEDITOR.replace( 'description' );
</script>