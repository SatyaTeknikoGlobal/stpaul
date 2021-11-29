@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'category/';
?>



<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Settings</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active" aria-current="page">Settings List</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="card mb-4">
    <!-- Card header -->
    <div class="card-header">
      <h3 class="mb-0">Settings</h3>
    </div>

    <div class="card-body">

      <!-- Form groups used in grid -->
      <form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
        {{ csrf_field() }}

        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label" for="">Referal Amount</label>
                <input type="text" name="refer" class="form-control" value="{{$settings->refer ??''}}">
            

              </div>
            </div>

          </div>
          

           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label" for="">Radius</label>
                <input type="text" name="radius" class="form-control" value="{{$settings->radius ??''}}">
               

              </div>
            </div>

          </div>




           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label" for="">Max Count Coupon Redeem</label>
                <input type="text" name="max_count_coupon_redeem" class="form-control" value="{{$settings->max_count_coupon_redeem ??''}}">
               

              </div>
            </div>

          </div>



           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label" for="">Privacy Policy</label>
              <textarea class="form-control" name="privacy" id="privacy">{{$settings->privacy ??''}}</textarea>

               

              </div>
            </div>

          </div>

           <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label" for="">Terms</label>
                
                <textarea class="form-control" name="terms" id="terms">{{$settings->terms ??''}}</textarea>

              </div>
            </div>

          </div>













          <button class="btn btn-primary" type="submit">Submit form</button>

        </form>


      </div>
    </div>
  </div>


  @include('admin.common.footer')

 <script>
              CKEDITOR.replace( 'privacy' );
              CKEDITOR.replace( 'terms' );
          </script>