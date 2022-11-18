<?php include('partials/menu.php')?>

    <div class="main-content">
      <div class="wrapper">
          <h1>Change Password</h1>
          <br><br>
          <?php 
            if(isset($_GET['id']))
            {
              $id=$_GET['id'];
            }
          ?>
          <form action="" method="post">
            <table class="tbl-30">
              <tr>
                <td>Current Password: </td>
                <td><input type="password" name="current_password" placeholder="Enter your current password"></td>
              </tr>
              <tr>
                <td>New Password: </td>
                <td>
                  <input type="password" name="new_password" placeholder="Enter your new password">
                </td>
              </tr>
              <tr>
                <td>Confirm Password: </td>
                <td><input type="password" name="confirm_password" placeholder="Please confirm your password"></td>
              </tr>

              <tr>
                <td colspan="2">
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="submit" name="submit" value="Change_Password" class="btn-sencondary">
                </td>
              </tr>
            </table>
          </form>
      </div>
    </div>



    <?php
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
      // echo "Button Clicked";
      //Get all the vlues from form to update
      $id = $_POST['id'];
      $current_password = md5($_POST['current_password']);
      $new_password = md5($_POST['new_password']);
      $confirm_password = md5($_POST['confirm_password']);

      //Check whether the user with current ID and Current Password Exists or not

      $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

      //ececute the querry
      $res = mysqli_query($conn, $sql);

      //Checking Result fail or success
      if($res==TRUE)
      {
        //Check whether the data available or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
          //USer exist and password can be changed
          //Check the new password and confirm password match or not
          if($new_password==$confirm_password)
          {
            //update the password
            $sql2 = "UPDATE tbl_admin SET
            password = '$new_password'
            WHERE id=$id
            ";
            //ececute the querry
            $res2 = mysqli_query($conn, $sql2);
            //Checking Result fail or success
            if($res2==TRUE)
            {
              // Data Inserted
              $_SESSION['update_password'] = "<div class='success'>Password updated Successfully </div>";
              // Redirect page
              header("location:".SITEURL.'admin/manage-admin.php');
            }
            else
            {
              // Failes
              $_SESSION['update_password'] = "<div class='error'> Failed to Update password </div>";
              // Redirect page
              header("location:".SITEURL.'admin/manage-admin.php');
            }
          }
          else
          {
            //redirect to manage admin
            $_SESSION['password-not-matched'] = "<div class='error'>Password not matched </div>";
            // Redirect page
            header("location:".SITEURL.'admin/manage-admin.php');
          }
          
        }
        else
        {
          //user does not exist send message redirect
          // Data Inserted
          $_SESSION['user-not-found'] = "<div class='error'>User Not Found </div>";
          // Redirect page
          header("location:".SITEURL.'admin/manage-admin.php');

        }
      }

      //Create a sqlp querry to update

     

      

      

    }
  ?>

<?php include('partials/footer.php')?>