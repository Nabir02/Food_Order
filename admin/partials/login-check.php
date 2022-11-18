<?php 
  //Authorization or Acess Control
  
  //to check whether the user is login or no

  if(!isset($_SESSION['user'])) //if user is not set
  {
    //user is not login
    //redirect to login page
    $_SESSION['no-login-msag'] = "<div class='error'>Please login to access admin panel</div>";
    header("location:".SITEURL.'admin/login.php');
  }

?>