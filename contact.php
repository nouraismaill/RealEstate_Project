<?php require "includes/header.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
  if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $fullname =$_POST['fullname'];
  $email =$_POST['email'];
  $subject =$_POST['subject'];
  $message =$_POST['message'];
  $insert = mysqli_query($conn,"INSERT INTO contacts (user_id,full_name,email,subject,message) VALUES ('$user_id','$fullname','$email','$subject','$message')");
  if($insert){
      echo "<script>alert('Your message is sent successfully!')</script>";
    } else {
      echo "<script>alert('Failed to insert contact information')</script>";
  }
} else {
  echo "<script>alert('Please log in to send your message')</script>";
}
}



?>

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Contact Us</h1>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
  
          <div class="col-md-12 col-lg-8 mb-5">
          
            
          
            <form action="" method="post" class="p-5 bg-white border">

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Full Name</label>
                  <input type="text"  name = "fullname"id="fullname" class="form-control" placeholder="Full Name">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">Email</label>
                  <input type="email" id="email"  name = "email" class="form-control" placeholder="Email Address">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">Subject</label>
                  <input type="text" id="subject"  name = "subject" class="form-control" placeholder="Enter Subject">
                </div>
              </div>
              

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Send your Message"></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit"  name ="submit"value="Send Message" class="btn btn-primary  py-2 px-4 rounded-0">
                </div>
              </div>

  
            </form>
          </div>

          <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h6 text-black mb-3 text-uppercase">Contact Info</h3>
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">homeland@gmail.com</a></p>

            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="site-section bg-light">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7">
        <div class="site-section-title text-center">
          <h2>Our Agents</h2>
          <p>Meet our team of dedicated real estate agents who are ready to assist you in finding your dream home or selling your property. Our agents are committed to delivering exceptional service and expertise.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">
          <img src="images/person_1.jpg" alt="Image" class="img-fluid rounded mb-4">
          <div class="text">
            <h2 class="mb-2 font-weight-light text-black h4">Megan Smith</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Meet Megan Smith, a highly experienced real estate agent dedicated to helping you find the perfect property. With a passion for real estate, Megan ensures a smooth and successful buying or selling process for her clients.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">
          <img src="images/person_2.jpg" alt="Image" class="img-fluid rounded mb-4">
          <div class="text">
            <h2 class="mb-2 font-weight-light text-black h4">Brooke Cagle</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Meet Brooke Cagle, a dedicated real estate professional with a focus on customer satisfaction. Brooke's commitment to excellence and in-depth market knowledge make her an invaluable asset in your real estate journey.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
        <div class="team-member">
          <img src="images/person_3.jpg" alt="Image" class="img-fluid rounded mb-4">
          <div class="text">
            <h2 class="mb-2 font-weight-light text-black h4">Philip Martin</h2>
            <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
            <p>Meet Philip Martin, a seasoned real estate agent with a proven track record of successful transactions. Philip is dedicated to helping clients achieve their real estate goals with professionalism and integrity.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  
  

    <?php require "includes/footer.php";?>