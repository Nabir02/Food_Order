<?php include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
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
          <td>Select Image: </td>
          <td>
            <input type="file" name="image">
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
            <input type="submit" name="submit" value="Add Catergory" class="btn-sencondary">
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
              header("location:".SITEURL.'admin/add-category.php');
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
        $sql = "INSERT INTO tbl_category SET
          title='$title',
          image_name='$image_name',
          featured='$featured',
          active='$active'
    
        ";
      
        // Executing query and saving data into database
        $res = mysqli_query($conn, $sql);

        //checkk whether the query executed or not
        if($res==true)
        {
          // Data Inserted
          // echo "Done";
          // create a vaiable to display messahe
          $_SESSION['add'] = "<div class='success'>Category Added Successfully </div>";
          // Redirect page
          header("location:".SITEURL.'admin/manage-category.php');
        }
        else
        {
          // Failes
          // echo "Failed";
          $_SESSION['add'] = "<div class='error'> Failed to add </div>";
          // Redirect page
          header("location:".SITEURL.'admin/add-category.php');
        }


      }
    ?>
  </div>
</div>

<?php include('partials/footer.php');?>