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
                        <h2>My Results</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="exTab1" class="container my-5">
    @include('front.common.leftbar')

    <div class="tab-content clearfix text-center">
        <div class="card1">
            <div class="row details mb-3 " style="text-align: justify;    border-bottom: 2px solid #2a2c7f;">
                <div class="col-md-12">
                    <h2 class="details py-5">Top 50 Performance: </h2>


                </div>
            </div>
            <div class="row details mb-3" style="text-align: justify;">
                     <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <h4 class="mb-3">Image</h4>
                     </div>
                      <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <h4 class="mb-3">Name</h4>
                      </div>
                      <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <h4 class="mb-3">Marks</h4>
                      </div>
                       <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3 center">
                        <h4 class="mb-3">Rank</h4>
                       </div>
                    
                </div>

            <?php if(!empty($results)){
                foreach($results as $res){
                    $imgUrl1 = asset('public/assets/web/img/user.png');
                    $user = \App\User::where('id',$res->user_id)->first();
                    if(!empty($user->photo)){
                       if($storage->exists($path.$user->photo)){
                        $imgUrl1=url('storage/app/public/'.$path.'/'.$user->photo);

                    }
                }
                ?>
                <div class="row details mb-3" style="text-align: justify;">
                    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <div class="wrap1">
                            <div class="text">
                                <img src="{{$imgUrl1}}" alt=" " style="width: 40px;height: 40px;border-radius: 100%;margin-top: 10px;border: none;">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">

                        <h4 class="mb-3">{{$user->name ??''}}</h4>
                        <h4>{{date('d M Y',strtotime($res->created_at))}}</h4>
                    </div>
                     <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <h5><b>{{$res->marks ?? ''}}</b></h5>
                    </div>

                    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">
                        <h5><b>#{{$res->rank ?? ''}}</b></h5>
                    </div>

                </div>

            <?php }}?>

            

        </div>



    </div>
</div>

<style type="text/css">
.wrap123 img{
    /*border: 5px solid #F2EFE8;*/
    border-radius: 100%;
    width: 85px;
    height: 85px;
    margin-top: 10px;


}
.wrap123{
  position: absolute;
  top: 6%;
  left: 410px;  
}

.col-sm-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width:25%;
}
.col-sm-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}




.hero-cap{
    text-align: center;
}
.center{
    text-align: center;
}
.proo{
    width: 100%;
    text-align: left;

}
.proo li{
    display: inline-flex;
    color: #000;
    width: 120px;
}
.rank {
    width: 40px;
    position: absolute;
    top: -12px;
    right: 30px;
}

.status {
    position: absolute;
    background: #428bca;
    color: #fff;
    padding: 2px 5px;
    border-radius: 7px;
    font-size: 14px;
    top: 0;
    right: 73px;
}

.wrap1 img {
    width: 100px;
    height: 100px;
    border: 5px solid #2a2c7f5c;
    border-radius: 100%;
    margin-top: 10px;
}

.card {
    box-shadow: rgb(0 0 0 / 15%) 0px 5px 15px 0px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: auto;
}

.green b {
    color: green;

}

.red b {
    color: red;
}

.grey b {
    color: grey;
}
.details .green,
.details .grey,
.details .red{
    text-align: center;
}

.card1 {

    align-items: initial;
    margin-left: 35px;
    margin-right: 35px;
    box-shadow: rgb(0 0 0 / 15%) 0px 5px 15px 0px;
    width: auto;


}
.nav-pills{
    position: sticky;
    top: 110px;
}
.rank-status {
    position: relative;
    left: -1px;
    top: 0px;
}
.rank-status span{
  position: absolute;
  color: #fff;
  bottom: 25px;
  font-size: 36px;
  font-weight: 600;

}
.rank-status span span{
   position: absolute;
   color: #fff;
   top: 3px;
   font-size: 13px;


}

@media (max-width:767px) {

    .center{
        text-align: left;
    }

    .details .green,
    .details .grey,
    .details .red{
        text-align: left;
    }

    .nav-pills{
        position: relative;
        top: 0;
    }
    .status {
        position: relative;
        background: #428bca;
        color: #fff;
        padding: 2px 5px;
        border-radius: 7px;
        font-size: 14px;
        top: 0;
        right: 0;
    }

    .card1 {
        width: auto;
        margin-left: auto;
        margin-right: auto;
    }

    .rank {
        width: 40px;
        position: relative;
        top: -57px;
        right: 30px;
    }


}
</style>

@include('front.common.footer')