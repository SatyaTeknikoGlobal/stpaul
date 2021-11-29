@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'influencer/thumb/';
?>

<div class="content-page">

  <!-- Start content -->
  <div class="content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-12">
          <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Users</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- end row -->




      


       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
          <div class="card mb-3">
             <div class="card-header">
              <h3>Choose Subscription</h3>

            </div>


            <div class="card-body">
             <select class="form-control select2" id="subscription_filter">
              <option value="0" selected>All</option>
              <?php if(!empty($subscriptions)){
                foreach($subscriptions as $subscription){?>
                <option value="{{$subscription->id}}">{{$subscription->name}}</option>
              <?php }}?>

             </select>
            </div>
          </div>
          <!-- end card-->
        </div>
      </div>





      @include('snippets.errors')
      @include('snippets.flash')
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Users List</h3>
              <span class="pull-right">
               <!--  <a href="{{ route('admin.subscription.add', ['back_url'=>$BackUrl]) }}" class="btn btn-primary btn-sm"><i class="fas fa-user-plus" aria-hidden="true"></i> Add New Subscription</a> -->
              </span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">ID</th>
                     <th scope="col">User Name</th>
                     <th scope="col">Subscription Name</th>
                     <th scope="col">Start Date</th>
                     <th scope="col">End Date</th>
                     <th scope="col">Status</th>
                     <th scope="col">Date Created</th>
                     <!-- <th scope="col">Action</th> -->
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
   ajax: {
          url: '{{ route("admin.subscription.get_user")}}',
          data: function (d) {
                d.sub_id = $('#subscription_filter').val(),
                d.search = $('input[type="search"]').val()
            }
      }, 
   columns: [
   {
    "render": function() {
      return i++;
    }
  },
  { data: 'name', name: 'name' ,searchable: false, orderable: false},
  { data: 'subscription', name: 'subscription' },
  { data: 'start_date', name: 'start_date' },
  { data: 'end_date', name: 'end_date' },
  { data: 'status', name: 'status' },
  { data: 'created_at', name: 'created_at' },
  // { data: 'action', searchable: false, orderable: false }

  ],
});



 $('#subscription_filter').change(function(){
        table.draw();
    });





  function change_subs_status(subid){
    var status = $('#change_subs_status'+subid).val();


    var _token = '{{ csrf_token() }}';

    $.ajax({
      url: "{{ route($routeName.'.subscription.change_status') }}",
      type: "POST",
      data: {subid:subid, status:status},
      dataType:"JSON",
      headers:{'X-CSRF-TOKEN': _token},
      cache: false,
      success: function(resp){
        if(resp.success){
          alert(resp.message);
        }else{
          alert(resp.message);
          
        }
      }
    });


  }

  $("#delete_item").click(function(){
    alert("The paragraph was clicked.");
  });
 $(document).on('ready',function() {
            $('.select2').select2();
        });
</script>