
@include('front.common.header')
<?php  

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
								


						</div>
					
						
					</div>
					
					<a href="{{url('/')}}" class=" btn btn-outline" style="font-size: 19px;">Back to Home</a>
				</div>
			</div>
		</div>
	</section>


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
	