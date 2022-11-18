<?php 
  //imclude constant to php for url
  include('../config/constant.php');
  // destroy yhe session
  session_destroy(); //on set $sessoin and user
  
  // redirect to login page
  header("location:".SITEURL.'admin/login.php');
?>