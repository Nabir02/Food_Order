<?php include('partials/menu.php')?>

    <!-- Main Section Start -->
    <div class="main-content">
      <div class="wrapper">
          <h1>Manage Admin</h1>
          <br>
          <br>

          <?php
            if(isset($_SESSION['add']))
            {
              echo $_SESSION['add']; //displaying session message
              unset ($_SESSION['add']); //Removing session message
            }
          ?>
          <?php
            if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete']; //displaying session message
              unset ($_SESSION['delete']); //Removing session message
            }
          ?>
          <?php
            if(isset($_SESSION['update']))
            {
              echo $_SESSION['update']; //displaying session message
              unset ($_SESSION['update']); //Removing session message
            }
          ?>
          <?php
            if(isset($_SESSION['user-not-found']))
            {
              echo $_SESSION['user-not-found']; //displaying session message
              unset ($_SESSION['user-not-found']); //Removing session message
            }
          ?>
          <?php
            if(isset($_SESSION['password-not-matched']))
            {
              echo $_SESSION['password-not-matched']; //displaying session message
              unset ($_SESSION['password-not-matched']); //Removing session message
            }
          ?>
          <?php
            if(isset($_SESSION['update_password']))
            {
              echo $_SESSION['update_password']; //displaying session message
              unset ($_SESSION['update_password']); //Removing session message
            }
          ?>
          <br>
          <br>
          <!-- Button to add admin -->
          <a href="add-admin.php" class="btn-primary">Add Admin</a>
          <br>
          <br>
          <table class="tbl-full">
            <tr>
              <th>S.N.</th>
              <th>Full Name</th>
              <th>Username</th>
              <th>Actions</th>
            </tr>
            <?php 
              //query to get all admin
              $sql = "SELECT * FROM tbl_admin";
              //execute all admin
              $res = mysqli_query($conn, $sql);

              //check whether the query is qxecuted or not
              if($res==TRUE)
              {
                //count rows to verified
                $count = mysqli_num_rows($res); //Function to get all the rows in dtabase
                //check the num of rows
                $sn=1; //Creat a variable and assign the value

                if($count>0)
                {
                  //We have the datas
                  while($rows=mysqli_fetch_assoc($res))
                  {
                    //using while loop to get all the data from the datbase 
                    //and while loop will execute as long as we have dataa in database

                    //get indivitial data
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];

                    //display the values in our table
                    ?>

                      <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                          <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-sencondary">Update Admin</a>
                          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a></td>
                      </tr>

                    <?php
                  }
                }
                else
                {
                  //we dont have any data
                }
              }
            ?>
          </table>
      </div>
    </div>
    <!-- Main Section End -->

<?php include('partials/footer.php')?>