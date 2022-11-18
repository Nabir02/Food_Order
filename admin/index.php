<?php include('partials/menu.php')?>

    <!-- Main Section Start -->
    <div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <?php
            if(isset($_SESSION['login']))
            {
              echo $_SESSION['login']; //displaying session message
              unset ($_SESSION['login']); //Removing session message
            }
          ?>
        <div class="col-4 text-center">
          <h1>5</h1>
          <br>
          categories
        </div>

        <div class="col-4 text-center">
          <h1>5</h1>
          <br>
          categories
        </div>

        <div class="col-4 text-center">
          <h1>5</h1>
          <br>
          categories
        </div>

        <div class="col-4 text-center">
          <h1>5</h1>
          <br>
          categories
        </div>
        <div class="clearfix"></div>

      </div>
    </div>
    <!-- Main Section End -->
<?php include('partials/footer.php')?>

  
