<?php include('partials/menu.php')?>
    <!-- Main Section Start -->
    <div class="main-content">
      <div class="wrapper">
          <h1>Add Admin</h1>
          <br>
          <br>
          <?php
            if(isset($_SESSION['add'])) //checking the session is ser or not
            {
              echo $_SESSION['add']; //displaying session message
              unset ($_SESSION['add']); //Removing session message
            }
          ?>

          <form action="" method="post">
            <table class="tbl-30">
              <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter your name"></td>
              </tr>
              <tr>
                <td>Username: </td>
                <td>
                  <input type="text" name="username" placeholder="Enter your username">
                </td>
              </tr>
              <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Enter your password"></td>
              </tr>

              <tr>
                <td colspan="2">
                  <input type="submit" name="submit" value="Add Admin" class="btn-sencondary">
                </td>
              </tr>
            </table>
          </form>
      </div>
    </div>
    <!-- Main Section End -->
<?php include('partials/footer.php')?>

<?php 
  // process the value form and save it in databasse
  // Check whether the button is clicked or not

  if(isset($_POST['submit']))
  {
    // Button Clicked
    // echo "Button Clicked";
    // Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    // password is encrypted with md5

    // SQL to save data to data base
    $sql = "INSERT INTO tbl_admin SET
      full_name='$full_name',
      username='$username',
      password='$password'

    ";
  
    // Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Check wether the data inserted or not and display appropiate message

    if($res==TRUE)
    {
      // Data Inserted
      // echo "Done";
      // create a vaiable to display messahe
      $_SESSION['add'] = "<div class='success'>Admin Added Successfully </div>";
      // Redirect page
      header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
      // Failes
      // echo "Failed";
      $_SESSION['add'] = "<div class='error'> Failed to add Sorry </div>";
      // Redirect page
      header("location:".SITEURL.'admin/manage-admin.php');
    }
  }
?>