<?php include('partials/menu.php')?>
    <!-- Main Section Start -->
    <div class="main-content">
      <div class="wrapper">
          <h1>Manage Category</h1>
          <br>
          <br>
          <!-- Button to add admin -->
          <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
          <br>
          <br>
          <?php
            if(isset($_SESSION['add']))
            {
              echo $_SESSION['add']; //displaying session message
              unset ($_SESSION['add']); //Removing session message
            }
            if(isset($_SESSION['upload']))
            {
              echo $_SESSION['upload']; //displaying session message
              unset ($_SESSION['upload']); //Removing session message
            }
            if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete']; //displaying session message
              unset ($_SESSION['delete']); //Removing session message
            }
            if(isset($_SESSION['remove']))
            {
              echo $_SESSION['remove']; //displaying session message
              unset ($_SESSION['remove']); //Removing session message
            }
            if(isset($_SESSION['no-cat-found']))
            {
              echo $_SESSION['no-cat-found']; //displaying session message
              unset ($_SESSION['no-cat-found']); //Removing session message
            }
            if(isset($_SESSION['update']))
            {
              echo $_SESSION['update']; //displaying session message
              unset ($_SESSION['update']); //Removing session message
            }
            if(isset($_SESSION['upload']))
            {
              echo $_SESSION['upload']; //displaying session message
              unset ($_SESSION['upload']); //Removing session message
            }
            if(isset($_SESSION['failed_remove']))
            {
              echo $_SESSION['failed_remove']; //displaying session message
              unset ($_SESSION['failed_remove']); //Removing session message
            }
          ?>
          <br>
          <table class="tbl-full">
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
            <?php 
              //query to get all category
              $sql = "SELECT * FROM tbl_category";
              //execute all category
              $res = mysqli_query($conn, $sql);

              //check whether the query is executed or not
              if($res==TRUE)
              {
                //count rows to verified
                $count = mysqli_num_rows($res); //Function to get all the rows in database
                //check the num of rows
                $sn=1; //Creat a variable and assign the value

                if($count>0)
                {
                  //We have the datas
                  while($rows=mysqli_fetch_assoc($res))
                  {
                    //using while loop to get all the data from the datbase 
                    //and while loop will execute as long as we have dataa in database

                    //get individual data
                    $id=$rows['id'];
                    $image_name = $rows['image_name'];
                    $title = $rows['title'];
                    $featured=$rows['featured'];
                    $active=$rows['active'];

                    //display the values in our table
                    ?>

                      <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                          <?php
                            //check whether the image name is available or not
                            if($image_name!="")
                            {
                              //Display the image
                              ?>

                              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                              
                              <?php
                            }
                            else
                            {
                              //Display th emsg
                              echo "<div class='error'>Image Not Found</div>";
                            }
                           ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                          <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-sencondary">Update Category</a>
                          <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> "class="btn-danger"> Delete Category</a>
                        </td>
                      </tr>

                    <?php
                  }
                }
                else
                {
                  //we dont have any data
                  //we will deisplay the msg in the table
                  ?>
                    <tr>
                      <td colspan="2"> <div class="error">No Category Found</div></td>
                    </tr>
                  <?php
                }
              }
            ?>
          </table>
      </div>
    </div>
    <!-- Main Section End -->
<?php include('partials/footer.php')?>