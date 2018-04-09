     
     <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form  method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="lemail"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="lpassword"/>
          </div>
          
          <p class="forgot"><a href="forgotPass.php">Forgot Password?</a></p>
          
          <input class="button button-block" type="submit" name ="log" />

          </form>
<?php  logData(); ?>



        </div>
                 