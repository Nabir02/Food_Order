<?php include('partials/menu.php')?>

  <div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>

        <?php 

        if(isset($_GET['id']))
        {
          //get the id ad all other detail
          //get the id of selected id
          $id=$_GET['id'];

          //create sql id to get the datils
          $sql="SELECT * FROM tbl_category WHERE id=$id";

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
               $title = $row['title'];
               $current_image = $row['image_name'];
               $featured = $row['featured'];
               $active = $row['active'];
             }
             else
             {
               //Redirect to mange admin page 
                // Failes
               $_SESSION['no-cat-found'] = "<div class='error'> No Category found </div>";
               header("location:".SITEURL.'admin/manage-category.php');
             }
             
           }
        }
        else
        {
          //redirect to manage page
          header("location:".SITEURL.'admin/manage-category.php');
        }
  ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
              <tr>
                <td>Title: </td>
                <td>
                  <input type="text" name="title" value="<?php echo $title ?>">
                </td>
              </tr>
              <tr>
                <td>Current image: </td>
                <td>
                  <?php 
                    if($current_image != "")
                    {
                      //display image
                      ?> 
                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">
                      <?php

                    }
                    else
                    {
                      //display msg
                      echo "<div class='error'> Image not added</div>";
                    }
                  ?>
                </td>
              </tr>
              <tr>
                <td>New Image: </td>
                <td><input  type="file" name="image" ></td>
              </tr>
              <tr>
                <td>Feautured: </td>
                <td>
                  <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                  <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
              </tr>
              <tr>
                <td>Active: </td>
                <td>
                  <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                  <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" name="submit" value="update Category" class="btn-sencondary">
                </td>
              </tr>
            </table>
          </form>
          <?php
            //check whether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
              // echo "Button Cliked";
              //Get all the values from form to update
              $id = $_POST['id'];
              $title = $_POST['title'];
              $current_image = $_POST['current_image'];
              $featured = $_POST['featured'];
              $active = $_POST['active'];

              //updating new image  if selected
              //check whether the image is selected or not
              if(isset($_FILES['image']['name']))
              {
                //get the image details
                $image_name = $_FILES['image']['name'];
                //check whether the image is availabe or npt
                if($image_name!= "")
                {
                  //image available
                  //upload the new image
                  //renaming the image automatic
                  //Get the extention of image


                  $ext = end(explode('.', $image_name)); 

                  //rename the image
                  $image_name = "Food_category_".rand(000,999).'.'.$ext;

                  //to upload image we need image name, source path and destination path
                  $source_path = $_FILES['image']['tmp_name'];

                  $destination_path ="../images/category/".$image_name;

                  //Finally upload the image
                  $upload = move_uploaded_file($source_path, $destination_path);

                  //check whether the image is uploades  or not
                  //and if the image is not uploaded then we will stop the process and redirect with error message
                  if($upload==false)
                  {
                    //set message
                    $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";
                    // Redirect page
                    header("location:".SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
                  }
                  //remove the current image if available
                  if($current_image != "")
                  {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
                    if($remove==false)
                    {
                      //failed to delete admin
                      // echo "Failed to Delete admin";
                      $_SESSION['failed_remove'] = "<div class='error'>Unable to remove old image </div>";
                      // Redirect page
                      header("location:".SITEURL.'admin/manage-category.php');
                      die();
                    }
                  }
                  
                }
                else
                {
                  //image name will be current name
                  $image_name = $current_image;
                }
              }
              else{
                $image_name = $current_image;
              }
              
              //Create a sqlp querry to update

              $sql2 = "UPDATE tbl_category SET
              title = '$title',
              image_name = '$image_name',
              featured = '$featured',
              active = '$active'
              WHERE id=$id
              ";

              //ececute the querry
              $res2 = mysqli_query($conn, $sql2);

              //Checking Result fail or success
              if($res2==TRUE)
              {
                // Data Inserted
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully </div>";
                // Redirect page
                header("location:".SITEURL.'admin/manage-category.php');
              }
              else
              {
                // Failes
                $_SESSION['update'] = "<div class='error'> Failed to Update Sorry </div>";
                // Redirect page
                header("location:".SITEURL.'admin/manage-category.php');
              }

            }
          ?>
    </div>
  </div>
<?php include('partials/footer.php')?>