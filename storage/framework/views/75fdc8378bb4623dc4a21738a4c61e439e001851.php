
<?php echo $__env->make('front.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="slider-area">
    <div class="slider-height2 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap hero-cap2 text-center">
              <h2>Login</h2>
          </div>
      </div>
  </div>
</div>
</div>
</div>

<div class="container-fluid no-padding contactus-section section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="getintouch">

                        <?php echo $__env->make('snippets.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('snippets.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    <h3 style="margin-bottom: 20px;margin-top: 20px;">Login</h3>
                    <form class="contactus-form" id="signupform" method="post"
                    action="<?php echo e(route('home.login')); ?>">

                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="text" required="" placeholder="Email" id="email"
                                class="form-control" name="email">
                            </div>
                            <?php echo $__env->make('snippets.errors_first', ['param' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="password" required="" placeholder="******" id="password"
                                class="form-control" name="password">
                            </div>
                            <?php echo $__env->make('snippets.errors_first', ['param' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-icon">
                                <input type="submit" name="post" title="Send" value="Login"
                                style="position: relative;margin-bottom: 10px;width:100%;">

                                <p class="messege">Not registered? <a href="<?php echo e(route('home.register')); ?>"
                                    title="Create An Account">Create an account</a></p>

                                </div>
                                <div class="form-group text-center">
                                    <a href="<?php echo e(route('home.forgot_password')); ?>" title="Forgot Password">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="alert-msg" id="alert-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php echo $__env->make('front.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/stpaul/public_html/resources/views/front/login.blade.php ENDPATH**/ ?>