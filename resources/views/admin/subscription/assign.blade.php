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
            <h1 class="main-title float-left">Subscribed Users</h1>
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Subscribed Users</li>
            </ol>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>




      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Assign Subscription</h3>
                <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                        <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>
            </div>

            <form method="POST" action="">
              {{csrf_field()}}
            <div class="card-body">

              <div style="display:flex;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">

                 <select class="form-control select2" name="user_ids[]" id="subscription_filter" multiple="multiple">

                  <?php if(!empty($users)){
                    foreach($users as $user){?>
                      <option value="{{$user->id}}">{{$user->name}}</option>
                    <?php }}?>

                  </select>
                </div>





                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

            </form>


          </div>
          <!-- end card-->
        </div>
      </div>



      <!-- end row -->
      @include('snippets.errors')
      @include('snippets.flash')
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-3">
            <div class="card-header">
              <h3>Subscribed Users List</h3>

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
<script type="text/javascript">
  var i = 1;

  var table = $('#dataTable').DataTable({


   ordering: false,
   processing: true,
   serverSide: true,
   ajax: {
    url: '{{ route("admin.subscription.get_user")}}',
    data: function (d) {
      d.sub_id = '{{$sub_id}}',
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

  ],
});
</script>