<?php 
include('dbConnection.php');
include('insertForgotPass.php');
global  $collectionRecovery;
  $collectionRecovery =$GLOBALS['db']->selectCollection("recoverykeys");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >	
</head>
<body>
<div class="container">
 
<div class="row">
 
<div class="col-lg-4">
 
<form class="form-horizontal" role="form" method="post">
 
<h2>Forgot Password</h2>
 
<p>
 
Forgot your password? No problem, we will fix it. Just type your email below and we will send you password recovery instruction to your email. Follow easy steps to get back to your account.
 
</p>
 
<div class="row">
 
<div class="col-lg-12">
 
<label class="control-label">Your Email</label>
 
</div>
 
</div>
 
 
 
<div class="row">
 
<div class="col-lg-12">
 
<input class="form-control" name="uemail" type="email" placeholder="Enter your email here..." required>
 
</div>
 
</div>
 
 
 
<div class="row">
 
<div class="col-lg-12">
 
<button class="btn btn-success btn-block" name="submit" style="margin-top:8px;">Submit</button>
 
</div>
 
</div>
 
</form>
 
</div>
 
 
 
</div>
 
</div>
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

 
