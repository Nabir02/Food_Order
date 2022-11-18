<?php 
  //include constant.php file here
  include('../config/constant.php');
  // 1.get the id of the admin to be delete
  $id = $_GET['id'];
  // 2.Create a sql query yo delete admin 

  $sql = "DELETE FROM tbl_admin WHERE id=$id";

  // execute the query
  $res = mysqli_query($conn, $sql);

  //cheack is it executed sucessfully or not

  if($res==true)
  {
    //Querry Executed Ssucessfully and admin deleted
    // echo "Admin Deleted";
      echo $_SESSION['delete']="<div class='success'> Admin Deleted Successfully .</div>"; //displaying session message
      header("location:".SITEURL.'admin/manage-admin.php');
    
  }
  else
  {
    //failed to delte admin
    // echo "Failed to Delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. </div>";
      // Redirect page
      header("location:".SITEURL.'admin/manage-admin.php');
  }
  // 3.Redirct to manage admin page with message


?>