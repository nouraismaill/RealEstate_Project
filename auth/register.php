<?php include "../includes/header.php"; ?>
<?php include "../config/config.php"; ?>
<?php
if(isset($_SESSION['username'])){
  header("location: ".APPURL.""); 
}
if(isset($_POST['submit'])){
  if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])){
    echo "<script> alert ('some inputs are empty');</script>";
  }
  else{
$username = $_POST['username'];
$email = $_POST['email'];
$checkEmail =mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
if($checkEmail && mysqli_num_rows($checkEmail)>0){
  echo "<script> alert('Email already exists.Please choose another one.');</script>";
}
else{
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
$insert ="INSERT INTO users(username,email,password) VALUES ('$username','$email','$password')";
if ($conn->query($insert)) {
  echo "<script>window.location.href='".APPURL."/auth/login.php' </script>";
  } else {
      echo "Error: " . mysqli_error($conn);
  }
}
}
}
?>
  <div class="site-loader"></div>
  
  <div class="site-wrap">

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo APPURL;?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Register</h1>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <h3 class="h4 text-black widget-title mb-3">Register</h3>
            <form  action="register.php" method ="POST" class="form-contact-agent">

            <div class="form-group">
                <label for="email">Username</label>
                <input type="username" name="username" id="username" class="form-control" require>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" require>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password"  name="password" class="form-control" require>
            </div>
            <div class="form-group">
                <input type="submit" id="phone" name ="submit" class="btn btn-primary" value="Register" >
            </div>
            </form>
          </div>
         
        </div>
      </div>
      <?php include "../includes/footer.php";?>