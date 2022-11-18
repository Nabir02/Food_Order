<?php include('../config/constant.php') ?>

<html>
  <head>
    <title>Login - Food order System</title> 
    <link rel="stylesheet" href="../css/admin.css">
  </head>
  <body>
    <div class="login">
      <h1 class="text-center">Login</h1> <br> 
      <h4 class="text-center">
        <?php
          if(isset($_SESSION['login']))
          {
            echo $_SESSION['login']; //displaying session message
            unset ($_SESSION['login']); //Removing session message
          }
          if(isset($_SESSION['no-login-msag']))
          {
            echo $_SESSION['no-login-msag']; //displaying session message
            unset ($_SESSION['no-login-msag']); //Removing session message
          }
        ?> </h4> <br>
     

      <!-- login page starts here -->
      <form action="" method="POST" class="text-center">
        Username: 
        <input type="text" name="username" placeholder="Enter Username"> <br> <br>
        Password: 
        <input type="password" name="password" placeholder="Enter Password"> <br> <br>

        <input type="submit" name="submit" value="Login" class="btn-primary">
      </form> <br>
      <!-- login page ends here -->
      <p  class="text-center">Created By- Nabir</p>
    </div>
    
  </body>
</html>

<?php
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
      // echo "Button Cliked";
      //Get all the values from form to form
      $username = $_POST['username'];
      $password = md5($_POST['password']);

      //Create a sql querry to check the pass in database
      $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
      //ececute the querry
      $res = mysqli_query($conn, $sql);

      // count rows to check whether the user exist or not
      $count = mysqli_num_rows($res);

      if($count==1)
      {
        // User available and login sucess
        //sucess msg
        $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
        $_SESSION['user'] = $username; //to check the user is login or not and logouut will unset it

        // Redirect page manage admin
        header("location:".SITEURL.'admin/');
      }
      else
      {
        //user not available login failed
        //Fail msg
        $_SESSION['login'] = "<div class='error'>Login Failed please enter correct details</div>";
        // Redirect page manage admin
        header("location:".SITEURL.'admin/login.php');

      }
    }
  ?>