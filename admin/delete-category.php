<?php 
  //include constant.php file here
  include('../config/constant.php');
  // 1.get the id of the admin to be delete

  if(isset($_GET['id']) AND isset($_GET['image_name']))
  {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file if its available  
    if($image_name != "")
    {
      //image is available remove it
      $path = "../images/category/".$image_name;
      //remove the image
      $remove = unlink($path);
      //if failed to remove iamge then add an error msg and stop the process
      if($remove == false)
      {
        //set the seession msg 
        $_SESSION['remove'] = "<div class='error'>Failed to delete Category. </div>";
        //redirect to mange page
        header("location:".SITEURL.'admin/manage-category.php');
        //stop the proceess
        die();
      }
    }

    //delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

  }
  else
  {
    //redirect to manage category page 
    header("location:".SITEURL.'admin/manage-category.php');
  }
  //cheack is it executed sucessfully or not

  if($res==true)
  {
    //Querry Executed Ssucessfully and admin deleted
    // echo "Admin Deleted";
      echo $_SESSION['delete']="<div class='success'> Category Deleted Successfully .</div>"; //displaying session message
      header("location:".SITEURL.'admin/manage-category.php');
    
  }
  else
  {
    //failed to delte admin
    // echo "Failed to Delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete Category. </div>";
      // Redirect page
      header("location:".SITEURL.'admin/manage-category.php');
  }
  // 3.Redirct to manage category page with message


?>