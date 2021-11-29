@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'events/thumb/';
?>


<div class="content-page">

  <!-- Start content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-12">
          <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Events</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Events</li>
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
              <h3>Events List</h3>
              <span class="pull-right">
                <a href="{{ route('admin.events.add', ['back_url'=>$BackUrl]) }}" class="btn btn-primary btn-sm"><i class="fas fa-user-plus" aria-hidden="true"></i> Add New Events</a>
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">#</th>
                     <th scope="col">Title</th>
                     <th scope="col">Image</th>
                     <th scope="col">Influencer Name</th>

                     <th scope="col">Location</th>
                     <th scope="col">About</th>
                     <th scope="col">Date</th>
                     <th scope="col">Start Time</th>
                     <th scope="col">End Time</th>
                     <th scope="col">Subscription Fee</th>

                     <th scope="col">Status</th>
                     <th scope="col">Date Created</th>
                     <th scope="col">Action</th>
                   </tr>
                 </thead>
               </table>
             </div>
             <!-- end table-responsive-->

           </div>
           <!-- end card-body-->

         </div>
         <!-- end card-->

       </div>

     </div>
     <!-- end row-->

   </div>
   <!-- END container-fluid -->

 </div>
 <!-- END content -->

</div>
<!-- END content-page -->



@include('admin.common.footer')

<script>
  var i = 1;

  var table = $('#dataTable').DataTable({
   ordering: false,
   processing: true,
   serverSide: true,
   ajax: '{{ route("admin.events.get_events")}}',
   columns: [
   { data: 'id', name: 'id' },
  //    {
  //   "render": function() {
  //     return i++;
  //   }
  // },
   { data: 'title', name: 'title'},
   { data: "image",name: 'image',

   "render": function(data, type, row) {
    return '<img src="'+data+'" width="50px" />';
  } },

  { data: 'influencers_id', name: 'influencers_id' },
  { data: 'location', name: 'location' },
  { data: 'about', name: 'about' },
  { data: 'event_date', name: 'event_date' },
  { data: 'start_time', name: 'start_time' },
  { data: 'end_time', name: 'end_time' },
  { data: 'subscription_price', name: 'subscription_price' },
  { data: 'status', name: 'status' },
  { data: 'created_at', name: 'created_at' },
  { data: 'action', searchable: false, orderable: false }

  ],
});




</script>

<script>
            $(document).ready(function(){
                $("#selectstatus").change(function(){
                    var statusname = $(this).val();
                    var getid = $(this).attr("status-id");
                    alert(statusname);
                    alert(getid);

                    $.ajax({
                        type:'POST',
                        url:'ajaxreceiver.php',
                        data:{statusname:statusname,getid:getid},
                        success:function(result){
                            $("#display").html(result);
                        }
                    });
                });
            });
        </script>