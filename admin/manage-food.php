<?php include('partials/menu.php')?>
    <!-- Main Section Start -->
    <div class="main-content">
      <div class="wrapper">
          <h1>Manage Foods</h1>
          <br>
          <br>
          <!-- Button to add admin -->
          <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary" class="btn-primary">Add Food</a>
          <br>
          <br>
          <?php 
             if(isset($_SESSION['upload']))
             {
               echo $_SESSION['upload']; //displaying session message
               unset ($_SESSION['upload']); //Removing session message
             }
             if(isset($_SESSION['add']))
             {
               echo $_SESSION['add']; //displaying session message
               unset ($_SESSION['add']); //Removing session message
             } 
             if(isset($_SESSION['remove']))
             {
               echo $_SESSION['remove']; //displaying session message
               unset ($_SESSION['remove']); //Removing session message
             } 
             if(isset($_SESSION['delete']))
             {
               echo $_SESSION['delete']; //displaying session message
               unset ($_SESSION['delete']); //Removing session message
             } 
          ?>
          <table class="tbl-full">
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Price($)</th>
              <th>Image Name</th>
              <th>Category ID</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
            <?php 
              //query to get all category
              $sql = "SELECT * FROM tbl_food";
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
                    $description = $rows['description'];
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $featured=$rows['featured'];
                    $active=$rows['active'];
                    $category_id=$rows['category_id'];

                    //display the values in our table
                    ?>

                      <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $price; ?></td>

                        <td>
                          <?php
                            //check whether the image name is available or not
                            if($image_name!="")
                            {
                              //Display the image
                              ?>

                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                              
                              <?php
                            }
                            else
                            {
                              //Display th emsg
                              echo "<div class='error'>Image Not Found</div>";
                            }
                           ?>
                        </td>

                        <td><?php echo $category_id; ?></td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                          <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-sencondary">Update</a>
                          <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> "class="btn-danger"> Delete </a>
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