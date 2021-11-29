<?php echo $__env->make('admin.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
					<?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="card mb-3">
						<div class="card-header">
							<h3> Banners </h3>
							 <?php if(request()->has('back_url')){ $back_url= request('back_url');  ?>
                            <a href="<?php echo e(url($back_url)); ?>" class="btn btn-success btn-sm" style='float: right;'>Back</a><?php } ?>

							<form method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
								<?php echo e(csrf_field()); ?>


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
												<td><?php echo e($i++); ?></td>
												<td>
													<?php
													$image = $banner->banner;
													if(!empty($image)){
														if($storage->exists($path.$image))
															{ ?>
																<div class="col-md-2 image_box">
																	<a target="_blank" href="<?php echo e(url('storage/app/public/'.$path.'/'.$image)); ?>">
																		<img src="<?php echo e(url('storage/app/public/'.$path.'/'.$image)); ?>" style="width: 50px;"><br>
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
													<td><?php echo e($banner->created_at); ?></td>
													<td>


														<a href="<?php echo e(route($routeName.'.banners.delete', $banner->id)); ?>" onclick="return confirm('Are You Want To Delete')"><i class="fa fa-trash"></i></a>
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




		<?php echo $__env->make('admin.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/stpaul/public_html/resources/views/admin/banner/index.blade.php ENDPATH**/ ?>