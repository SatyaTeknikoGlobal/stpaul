@include('admin.common.header')
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

                             <input type="hidden" name="id" value="{{$events_id}}">


                            <div class="form-group">
                                <label for="userName">Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $title) }}" id="title" class="form-control"  maxlength="255" />

                                 @include('snippets.errors_first', ['param' => 'title'])
                            </div>



                            <div class="form-group">
                                <label for="emailAddress">Location<span class="text-danger">*</span></label>
                                <input type="text" name="location" value="{{ old('location', $location) }}" id="location" class="form-control"  maxlength="255" />
                                @include('snippets.errors_first', ['param' => 'location'])

                            </div>



                            <div class="form-group">
                                <label for="pass1">Influencer Name:<span class="text-danger">*</span></label>
                               <select name="influencers_id" class="form-control">
                   <?php if(!empty($influencers)){
                    foreach($influencers as $infu){
                    ?>
                    <option value="{{$infu->id}}" <?php if($infu->id == $influencers_id) echo "selected"?>>{{$infu->name}}</option>

                <?php }}?>

                </select>

                    @include('snippets.errors_first', ['param' => 'influencers_id'])
                            </div>




                            <div class="form-group">
                                <label for="passWord2">Event Date:<span class="text-danger">*</span></label>
                                <input type="date" name="event_date" value="{{ old('event_date', $event_date) }}" id="event_date" class="form-control" />

                            @include('snippets.errors_first', ['param' => 'event_date'])    


                           </div>



                           <div class="form-group">


                            <label>Start Time:</label>
                            <div>
                              <input type="time" name="start_time" value="{{ old('start_time', $start_time) }}" id="start_time" class="form-control"  maxlength="255" />

                                @include('snippets.errors_first', ['param' => 'start_time'])
                         </div>
                     </div>


                <div class="form-group">


                            <label>End Time:</label>
                            <div>
                              <input type="time" name="end_time" value="{{ old('end_time', $end_time) }}" id="end_time" class="form-control" />

                    @include('snippets.errors_first', ['param' => 'end_time'])
                         </div>
                     </div>











                      <div class="form-group">
                                <label for="pass1">About<span class="text-danger">*</span></label>
                               <textarea name="about" id="description" class="form-control ckeditor" ><?php echo old('about', $about); ?></textarea>    

                    @include('snippets.errors_first', ['param' => 'about'])
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
                                <label for="pass1">Subscription Fee:<span class="text-danger">*</span></label>
                                <input type="text" name="subscription_price" value="{{ old('subscription_price', $subscription_price) }}" class="form-control">
               
                @include('snippets.errors_first', ['param' => 'subscription_price'])
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
                    <a type="reset" href="{{ route('admin.events.index') }}" class="btn btn-secondary m-l-5">
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

                    var _token = '{{ csrf_token() }}';

                    $.ajax({
                        url: "{{ route($routeName.'.influencers.ajax_delete_image') }}",
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

@include('admin.common.footer')
<script>
CKEDITOR.replace( 'description' );
</script>