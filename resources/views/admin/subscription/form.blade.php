@include('admin.common.header')
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

                            <input type="hidden" name="id" value="{{$subscription_id}}">


                            <div class="form-group">
                                <label for="userName">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $name) }}" id="name" class="form-control"  maxlength="255" />

                                @include('snippets.errors_first', ['param' => 'name'])
                            </div>



                            <div class="form-group">
                                <label for="emailAddress">MRP<span class="text-danger">*</span></label>
                                <input type="text" name="mrp" value="{{ old('mrp', $mrp) }}" id="mrp" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'mrp'])

                            </div>


                            <div class="form-group">
                                <label for="emailAddress">Selling Price<span class="text-danger">*</span></label>
                                <input type="text" name="price" value="{{ old('price', $price) }}" id="price" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'price'])

                            </div>



                            <div class="form-group">
                                <label for="emailAddress">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="description">{{ old('description', $description) }}</textarea>
                                @include('snippets.errors_first', ['param' => 'password'])

                            </div>

                            <div class="form-group">
                                <label for="emailAddress">Duration(In Days)<span class="text-danger">*</span></label>
                                <input type="text" name="duration" value="{{ old('duration', $duration) }}" id="duration" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'duration'])

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