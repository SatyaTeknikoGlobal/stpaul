
@include('front.common.header')
<?php  
// $storage = Storage::disk('public');
// $imgUrl = asset('public/assets/web/img/user.png');
// $path = 'users/thumb/';
// if(!empty(Auth::guard('appusers')->user()->photo)){
//    $image = Auth::guard('appusers')->user()->photo;
//    if($storage->exists($path.$image)){
//     $imgUrl=url('storage/app/public/'.$path.'/'.$image);

// }

// }
?>
<section class="error bg-gradient pad-tb py-5">
		<div class="container">
			<div class="row justify-content-center ">
				<div class="col-md-8 text-center mt50 mb50">
					<div class=" my-5">
						<div class="error-block">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhJkVg6YHFH46BnZ8w2z-rNV69vciKsC2WNw&usqp=CAU" alt="">
							
						<h1 class="wow fadeInUp my-2" data-wow-delay=".2s">For Your Response! </h1>
						<p class="wow fadeInUp my-2" data-wow-delay=".2s">We will be in contact with you shortly.</p>
								


								<p>Correct - {{$correct_ans}}</p>
								<p>Wrong - {{$wrong_ans}}</p>
								<p>Skip - {{$skipped_ans}}</p>
						</div>
					
						
					</div>
					
					<a href="{{url('/')}}" class=" btn btn-outline" style="font-size: 19px;">Back to Home</a>
				</div>
			</div>
		</div>
	</section>
<!-- 	<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center">
                       <h1>Thank You </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <script>
	$('#input_ar').keyup(function(){
    if ((($(this).val().charCodeAt(0) > 0x600) && ($(this).val().charCodeAt(0) < 0x6FF)) || ($(this).val()=="")) { $('#search_input').css("direction","rtl"); }
    else { $('#search_input').css("direction","ltr"); }
});
</script> -->

<style>
.bg-gradient {
    background: #f6f6f6;
}
.bg-gradient1{
	background: #fefefe;
}
	.fixed-top{
		position: relative;
	}
	.btn:focus, .btn:hover{
		color: #fff !important;
	}
	</style>
	
	<!--scroll to top-->
	<a id="scrollUp" href="#top"></a>
@include('front.common.footer')
	