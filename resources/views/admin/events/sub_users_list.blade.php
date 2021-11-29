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
            <h1 class="main-title float-left">Subscribed User List</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Subscribed User List</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- end row -->
      @include('snippets.errors')
      @include('snippets.flash')


        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
          <div class="card mb-3">
             <div class="card-header">
              <h3>Choose Users</h3>

            </div>

            <form method="post">
              {{csrf_field()}}

            <div class="card-body">
              <div style="display:flex;">
             <select class="form-control select2" multiple="multiple" name="user_ids[]">
              <?php if(!empty($users)){
                foreach($users as $user){?>
                <option value="{{$user->id}}">{{$user->name}}</option>
              <?php }}?>

             </select>

             <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </div>
          </form>



          </div>
          <!-- end card-->
        </div>
      </div>



      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Subscribed User List List</h3>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                    <tr>
                     <th scope="col">#</th>
                     <th scope="col">User Name</th>
                     <th scope="col">Event Name</th>
                     <th scope="col">Created At</th>

                     
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
          url: '{{ route("admin.events.get_sub_users")}}',
          data: function (d) {
                d.event_id = '{{$event_id}}',
                d.search = $('input[type="search"]').val()
            }
      },


   columns: [
   { data: 'id', name: 'id' },
   { data: 'name', name: 'name'},
   { data: 'event_name', name: 'event_name'},
  { data: 'created_at', name: 'created_at' },
  

  ],
});

 $('#event_filter').change(function(){
        table.draw();
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