<?php include('partials/menu.php')?>

  <div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br> <br>

        <?php 

        //get the id of selected id
          $id=$_GET['id'];
          //create sql id to get the datils
          $sql="SELECT * FROM tbl_admin WHERE id=$id";
          //execute querry
          $res=mysqli_query($conn, $sql);

          //check is it eecute or not
          if($res==true)
          {
            $count = mysqli_num_rows($res);
            //check we have admin data or not

            if($count==1)
            {
              //Get the details
              // echo "Admin Available";
              $row=mysqli_fetch_assoc($res);
              $full_name = $row['full_name'];
              $username = $row['username'];
            }
            else
            {
              //Redirect to mange admin page 
              header("location:".SITEURL.'admin/manage-admin.php');
            }
            
          }
      

        ?>
        <form action="" method="post">
            <table class="tbl-30">
              <tr>
                <td>Full Name: </td>
                <td>
                  <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                </td>
              </tr>
              <tr>
                <td>Username: </td>
                <td>
                  <input type="text" name="username" value="<?php echo $username; ?>"">
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" name="submit" value="Update Admin" class="btn-sencondary">
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
      // echo "Button Cliked";
      //Get all the avlues from form to update
      $id = $_POST['id'];
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];

      //Create a sqlp querry to update

      $sql = "UPDATE tbl_admin SET
      full_name = '$full_name',
      username = '$username'
      WHERE id='$id'
      ";

      //ececute the querry
      $res = mysqli_query($conn, $sql);

      //Checking Result fail or success
      if($res==TRUE)
      {
        // Data Inserted
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully </div>";
        // Redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
      }
      else
      {
        // Failes
        $_SESSION['update'] = "<div class='error'> Failed to Update Sorry </div>";
        // Redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
      }

    }
  ?>

<?php include('partials/footer.php')?>