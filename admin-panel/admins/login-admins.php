<?php require "../layouts/header.php"; ?>  
<?php require "../../config/config.php"; ?>  
<?php

  if(isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."' </script>";

  }
   if(isset($_POST['submit'])){
    if(empty($_POST['email']) OR empty($_POST['password'])){
      echo "<script> alert ('some inputs are empty');</script>";
    }
    else{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = "SELECT*FROM admins WHERE  email='$email'";
    $result = $conn->query($login);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      if (password_verify($password, $hashedPassword)) {
         $_SESSION['adminname'] = $row['adminname'];
          $_SESSION['email'] = $email;
          $_SESSION['admin_id'] = $row['id'];

          echo "<script>window.location.href='".ADMINURL."' </script>";

      }

else {
   
   echo "<script> alert ('Email or password is wrong');</script>";

}
      
  }
  else {
   
   echo "<script> alert ('Email or password is wrong');</script>";

}
}
}
?>
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mt-5">Login</h5>
                  <form method="POST" class="p-auto" action="login-admins.php">
                      <!-- Email input -->
                      <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                      
                      </div>

                      
                      <!-- Password input -->
                      <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                        
                      </div>



                      <!-- Submit button -->
                      <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                    
                    </form>

                </div>
          </div>
<?php require "../layouts/footer.php"; ?>     
