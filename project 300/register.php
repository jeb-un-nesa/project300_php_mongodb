<?php

include('header.php');
include('InsertDataFromForm.php');


?>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
         
          
          <form  method="POST" >
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="firstName" />

            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="lastName"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off"  name ="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name ="password"/>
          </div>

           <div class="field-wrap">
            <label>
              Confirm Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name="cpassword"/>
          </div>
          
          <input type="submit"  value = "submit" class="button button-block"  name="submit"/>
          
          </form>

  <?php  insert();  ?>

        </div>
        
        <?php include('log.php'); ?>

        
        
      </div><!-- tab-content -->
  
</div> <!-- /form -->
  

<?php include('footer.php'); ?>
 