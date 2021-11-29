@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$testimonial_id = (isset($testimonial->id))?$testimonial->id:'';
$image = (isset($testimonial->image))?$testimonial->image:'';
$user_name = (isset($testimonial->user_name))?$testimonial->user_name:'';
$text = (isset($testimonial->text))?$testimonial->text:'';
$rating = (isset($testimonial->rating))?$testimonial->rating:'';

$status = (isset($testimonial->status))?$testimonial->status:'';
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'testimonial/thumb/';


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

                            <input type="hidden" name="id" value="{{$testimonial_id}}">



                            <div class="form-group">
                                <label for="userName">Choose User<span class="text-danger">*</span></label>
                                <select name="user_name" class="form-control select2">
                                    <option value="" selected disabled>Select User Name</option>
                                    <?php if(!empty($users)){
                                        foreach($users as $user){
                                            ?>

                                            <option value="{{$user->id}}" <?php if($user->id == $user_name) echo "selected"?>>{{$user->name}}</option>
                                        <?php }}?>
                                    </select>

                                    @include('snippets.errors_first', ['param' => 'name'])
                                </div>


                                
                                <div class="form-group">
                                    <label for="userName">Text<span class="text-danger">*</span></label>
                                    <textarea id="description" name="text" class="form-control">{{old('text', $text)}}</textarea>

                                    @include('snippets.errors_first', ['param' => 'text'])
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
                                <label for="userName">Choose Ratings<span class="text-danger">*</span></label>

                                <div class="rate">
                                    <input type="radio" id="star5" name="rating" value="5" <?php if($rating == 5 ) echo "checked"?>/>
                                    <label for="star5" title="text">5 stars</label>

                                    <input type="radio" id="star4" name="rating" value="4" <?php if($rating == 4 ) echo "checked"?>/>
                                    <label for="star4" title="text">4 stars</label>

                                    <input type="radio" id="star3" name="rating" value="3" <?php if($rating == 3 ) echo "checked"?>/>
                                    <label for="star3" title="text">3 stars</label>

                                    <input type="radio" id="star2" name="rating" value="2" <?php if($rating == 2 ) echo "checked"?>/>
                                    <label for="star2" title="text">2 stars</label>

                                    <input type="radio" id="star1" name="rating" value="1" <?php if($rating == 1 ) echo "checked"?> />
                                    <label for="star1" title="text">1 star</label>
                                </div>

                                @include('snippets.errors_first', ['param' => 'rating'])
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
        <style type="text/css">
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>