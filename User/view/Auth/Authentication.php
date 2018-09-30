<?php include("view/Auth/AuthHeader.php");?>
      <form class="login-form" name="AuthForm" method="POST" action="index.php">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
           <p><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Invalid Username and Password..</div></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" name="email" class="form-control" placeholder="Username" required="" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" name="login_customer" type="submit">Login</button>
            <a href="index.php?auth=Register" class="btn btn-info btn-lg btn-block" type="submit">Signup</a>
        </div>
      </form>
<?php include("view/Auth/AuthFooter.php");?>