@include('front.common.header')
<?php  
$storage = Storage::disk('public');
$imgUrl = asset('public/assets/web/img/user.png');
$path = 'users/thumb/';
if(!empty(Auth::guard('appusers')->user()->photo)){
   $image = Auth::guard('appusers')->user()->photo;
   if($storage->exists($path.$image)){
    $imgUrl=url('storage/app/public/'.$path.'/'.$image);

}

}
?>
<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                        <h2>My profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('snippets.errors')

@include('snippets.flash')


<div id="exTab1" class="container my-5">
  @include('front.common.leftbar')

  <div class="tab-content clearfix">
    <div class="user">
        <div class="tab-pane active" id="1a">
            <center class="profile-card">
              <div class="card1">
                <div class="text">
                    <img src="{{$imgUrl}}" alt="" class="main-profile-img">

                    
                    <h1 style="color: #2a2c7f;">{{Auth::guard('appusers')->user()->name}}</h1>
                    <br>
                    <div class="row details my-4">
                        <div class="col-md-12">
                            <h2 class="details"> <b>Email:</b>  <b>{{Auth::guard('appusers')->user()->email}}</b></h2>

                        </div>
                        
                        
                    </div>
                    <div class="row details my-4">
                        <div class="col-md-12">
                            <h2 class="details"> <b>Phone:</b> <b>+91-{{Auth::guard('appusers')->user()->phone}}</b> </h2>
                        </div>
                        
                        
                    </div>
                    <div class="row details my-4">
                        <div class="col-md-12">
                            <h2 class="details"> <b>Referral Code:  </b> <strong>{{Auth::guard('appusers')->user()->referral_code}}</strong></h2>
                        </div>
                        
                        
                    </div>
                    
                    
                </div>
                
            </div>
        </center>
    </div>
    
</div>


</div>
</div>
<style type="text/css">



.card1{
   box-shadow: none;
   width: auto;
}
.details{
    text-align: left;
}
.details b
 {
   /* margin-left: 30px;*/
    color: grey;
    font-weight: 400;
    line-height: 30px;
}

.details b:nth-of-type(2){
     margin-left: 83px;
     text-align: left;
     color: #000;
      font-weight: 500;

}
.details b:nth-of-type(4){
     margin-left: 100px;
     text-align: left;
     color: #000;
      font-weight: 500;

}

.details strong{
    
     text-align: left;
   color: #2a2c7f;
      font-weight: 500;
          margin-left: 42px;

}
@media (max-width:767px) {
    .details b,
    .details b:nth-of-type(2),
    .details b:nth-of-type(4){
        margin-left: 0px;
    }
    .details strong{
         margin-left: 1px;
         
    }
    .card1 .text{
        padding: 0px;
    }

}
</style>
@include('front.common.footer')