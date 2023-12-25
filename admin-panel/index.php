<?php require "layouts/header.php"; ?>     
<?php require "../config/config.php"; ?>     
<?php 

  if(!isset($_SESSION['adminname'])) {
   echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";

 }
 $propsResult = mysqli_query($conn, "SELECT COUNT(*) AS num_props FROM props");
 $allProps = mysqli_fetch_assoc($propsResult);
 
 
 $categoriesResult = mysqli_query($conn, "SELECT COUNT(*) AS num_categories FROM categories");
 $allCategories = mysqli_fetch_assoc($categoriesResult);

 $adminsResult = mysqli_query($conn, "SELECT COUNT(*) AS num_admins FROM admins");
 $allAdmins = mysqli_fetch_assoc($adminsResult);
 $requestsResult = mysqli_query($conn, "SELECT COUNT(*) AS num_requests FROM requests");
 $allRequests = mysqli_fetch_assoc($requestsResult);
?>            
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Properties</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of properties: <?php echo $allProps['num_props']; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $allCategories['num_categories']; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $allAdmins['num_admins']; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Requests</h5>
              
              <p class="card-text">number of requests: <?php echo $allRequests['num_requests']; ?></p>
              
            </div>
          </div>
        </div>
 <?php require "layouts/footer.php"; ?>     