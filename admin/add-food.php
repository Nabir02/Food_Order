<?php include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Food</h1>
    <br> <br>
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
    ?>

    <!-- add category form  Start here-->

    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" placeholder="Enter the title">
          </td>
        </tr>
        <tr>
          <td>Description</td>
          <td>
            <textarea name="description" cols="30" rows="5" placeholder="Enter the Description of the food"></textarea>
          </td>
        </tr>
        <tr>
          <td>Select image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td>price</td>
          <td>
            <input type="num" name="price" placeholder="Enter the price">
          </td>
        </tr>
        <tr>
          <td>Category: </td>
          <td>
            <select name="category">

              <?php 
                  //create php code to display categories from database
                  //1. Create sql to get all active categories from data base
                  $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                  $res = mysqli_query($conn, $sql);

                  ///count rows to check whether we have categories or not

                  $count = mysqli_num_rows($res);

                  if($count>0)
                  {
                    //we have categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                      //get the details of the categories
                      $id = $row['id'];
                      $title = $row['title'];
                      ?>

                      <option value="<?php echo $id;?>"><?php echo $title; ?></option>

                      <?php
                    }
                  }
                  else
                  {
                    //we do not have categories
                    ?>
                    <option value="0">No category found</option>

                    <?php
                  }
                  //display on dropdown
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Featured: </td>
          <td>
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
          </td>
        </tr>
        <tr>
          <td>Active: </td>
          <td>
          <input type="radio" name="active" value="Yes">Yes
          <input type="radio" name="active" value="No">No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Food" class="btn-sencondary">
          </td>
        </tr>
      </table>
    </form>

    <!-- add category form  ends here-->

    <?php 
      //check the submit button cliked or not
      if(isset($_POST['submit']))
      {
        // Button Clicked
        // echo "Button Clicked";
        // Get the data from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];


        //for radio input type we need to whther the button is selected or not

        if(isset($_POST['featured']))
        {
          //get the value from form
          $featured = $_POST['featured'];
        }
        else
        {
          //set the default value
          $featured = "No";
        }



        if(isset($_POST['active']))
        {
          //get the value from form
          $active = $_POST['active'];
        }
        else
        {
          //set the default value
          $active = "No";
        }
        //check whether the image is selected or not and set the value for image name accordingly
        // print_r($_FILES['image']);

        // die(); // break the code here
        if(isset($_FILES['image']['name']))
        {
          // we will upload the image 
          

          $image_name = $_FILES['image']['name'];

          //upload image only if image slected
          if($image_name != "")
          {
            //renaming the image automatic
            //Get the extention of image
            $ext =end(explode('.', $image_name));

            //rename the image
            $image_name = "Food_".rand(0000,9999).'.'.$ext;

            //to upload image we need image name, source path and destination path
            $src = $_FILES['image']['tmp_name'];

            $dst ="../images/food/".$image_name;

            //Finally upload the image
            $upload = move_uploaded_file($src, $dst);

            //check whether the image is uploades  or not
            //and if the image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
              //set message
              $_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";
              // Redirect page
              header("location:".SITEURL.'admin/add-food.php');
              //stop the process
              die();
            }
          }
        }
        else
        {
          //dpnt upload image and set the image name value as blank
          $image_name="";
        }
    
        // SQL to save data to data base
        $sql2 = "INSERT INTO tbl_food SET
          title='$title',
          description='$description',
          price=$price,
          image_name='$image_name',
          category_id=$category,
          featured='$featured',
          active='$active'
        ";
      
        // Executing query and saving data into database
        $res2 = mysqli_query($conn, $sql2);

        //checkk whether the query executed or not
        if($res2==true)
        {
          // Data Inserted
          // echo "Done";
          // create a vaiable to display messahe
          $_SESSION['add'] = "<div class='success'>Food Added Successfully </div>";
          // Redirect page
          header("location:".SITEURL.'admin/manage-food.php');
        }
        else
        {
          // Failes
          // echo "Failed";
          $_SESSION['add'] = "<div class='error'> Failed to add </div>";
          // Redirect page
          header("location:".SITEURL.'admin/add-food.php');
        }


      }
    ?>
  </div>
</div>

<?php include('partials/footer.php');?>