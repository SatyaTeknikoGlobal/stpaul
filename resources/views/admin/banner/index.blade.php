@include('admin.common.header')

<?php
$BackUrl = CustomHelper::BackUrl();
$routeName = CustomHelper::getAdminRouteName();


$storage = Storage::disk('public');
$path = 'banner/thumb/';
?>



<div class="content-page">

	<!-- Start content -->
	<div class="content">

		<div class="container-fluid">

			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left"> Banners</h1>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item active"> Banners</li>
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
							<h3> Banners <span style="color: red;">( Web banners size should be 2000 X 1333 *)</span> </h3>
							 <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                            <a href="{{ url($back_url)}}" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>

							<form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
								{{ csrf_field() }}

								<div class="row">

									<div class="col-sm-12 col-md-2">
										<select class="form-control" name="type">
											<option value="app">App</option>
											<option value="web">Web</option>
											
										</select>
									</div>
									<div class="col-sm-12 col-md-4">
										<input type="text" name="link" value="" class="form-control" placeholder="Enter Link">
									</div>



									<div class="col-sm-12 col-md-4">
										<div class="input-group mb-3">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupFileAddon01">Upload</span></div>
											<div class="custom-file">
												<input class="custom-file-input" id="inputGroupFile01" type="file" aria-describedby="inputGroupFileAddon01" multiple name="image[]">
												<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
											</div>
										</div>
									</div>

									<span class="pull-right">
										<button class="btn btn-primary" type="submit">Submit</button>
									</span>

								</div>

							</form>



						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table id="dataTable" class="table table-bordered table-hover display" style="width:100%">
									<thead>
										<tr>
												<th scope="col">#</th>

										<th scope="col">Image</th>
										<th scope="col">Type</th>

										<th scope="col">Status</th>
										<th scope="col">Date Created</th>
										<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
									if(!empty($banners)){
										$storage = Storage::disk('public');
										$path = 'banner/thumb/';
										$i =1;
										foreach ($banners as $banner){
											?>

											<tr>
												<td>{{$i++}}</td>
												<td>
													<?php
													$image = $banner->banner;
													if(!empty($image)){
														if($storage->exists($path.$image))
															{ ?>
																<div class="col-md-2 image_box">
																	<a target="_blank" href="{{ url('storage/app/public/'.$path.'/'.$image) }}">
																		<img src="{{ url('storage/app/public/'.$path.'/'.$image) }}" style="width: 50px;"><br>
																	</a>
																</div>
															<?php }
														}
														?>
													</td>
													<td>
														<?php  echo ($banner->type=='app')?'App':'Web';  ?>
															
														</td>

													<td>
														<?php  echo ($banner->status==1)?'Active':'Inactive';  ?>
															
														</td>
													<td>{{$banner->created_at}}</td>
													<td>


														<a href="{{ route($routeName.'.banners.delete', $banner->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
												<?php
											}}
											?>


											</tbody>
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




		@include('admin.common.footer')
