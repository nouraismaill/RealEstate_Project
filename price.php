<?php require "includes/header.php";?>
<?php require "config/config.php";?>

<?php
$select = $conn->query("SELECT * FROM props ORDER BY name DESC");
$allListingsPrice = [];
if ($select) {
    // Fetch data using fetch_assoc to get an associative array
    $props = [];
    while ($row = $select->fetch_assoc()) {
        $props[] = $row;
    }
  } else {

    echo "Error: " . $conn->error;
  }
  
if (isset($_GET['price'])) {
    $price = $_GET['price'];
    $Query= "SELECT * FROM props ORDER BY price $price ";
    $price_query = mysqli_query($conn,$Query);
    if ($price_query) {
        while ($row = $price_query->fetch_assoc()) { 
            $allListingsPrice[] = $row;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
else{
  echo "<script>window.location.href='".APPURL."/404.php' </script>";
}


$conn->close();

?>
   
   <div class="slide-one-item home-slider owl-carousel">
  <?php foreach ($props as $prop) : ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/<?php echo $prop['image']; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block bg-<?php if($prop['type'] == "rent") { echo "success"; } else { echo "danger";}?> text-white px-3 mb-3 property-offer-type rounded"><?php echo $prop['type']; ?></span>
            <h1 class="mb-2"><?php echo $prop['name']; ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo $prop['price']; ?></strong></p>
            <p><a href="property-details.php?id=<?php echo $prop['id']; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>



    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
          <form class="form-search col-md-12" method="POST" action = "search.php" style="margin-top: -100px;">
            <div class="row  align-items-end">
              <div class="col-md-3">
                <label for="list-types">Listing Types</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="types" id="list-types" class="form-control d-block rounded-0">
                  <?php foreach($allCategories as $category) : ?>
                      <option value="<?php echo $category['name']; ?>"><?php echo str_replace('-', ' ', $category['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="offer-types">Offer Type</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="offers" id="offer-types" class="form-control d-block rounded-0">
                    <option value="sale">sale</option>
                    <option value="rent">rent</option>
                    <option value="lease">lease</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <label for="select-city">Select City</label>
                <div class="select-wrap">
                  <span class="icon icon-arrow_drop_down"></span>
                  <select name="cities" id="select-city" class="form-control d-block rounded-0">
                  <option value="new york">New York</option>
                    <option value="brooklyn">Brooklyn</option>
                    <option value="london">London</option>
                    <option value="japan">Japan</option>
                    <option value="australia">Australia</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <input type="submit" name="submit" class="btn btn-success text-white btn-block rounded-0" value="Search">
              </div>
            </div>
          </form>
        </div>  

        <div class="row">
          <div class="col-md-12">
            <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
           
              <div class="ml-auto d-flex align-items-center">
                <div>
                  <a href="<?php echo APPURL; ?>" class="view-list px-3 border-right active">All</a>
                  <a href="rent.php?id=rent" class="view-list px-3 border-right">Rent</a>
                  <a href="sale.php?type=sale" class="view-list px-3">Sale</a>
                  <a href="price.php?price=ASC" class="view-list px-3">Price Ascending</a>
                  <a href="price.php?price=DESC" class="view-list px-3">Price Descending</a>

                </div>


               
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
      <div class="row mb-5">
    <?php foreach($allListingsPrice as $allListing): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
            <a href="property-details.php?id=<?php echo isset($allListing['id']) ? $allListing['id'] : ''; ?>" class="property-thumbnail">
                    <div class="offer-type-wrap">
                        <span class="offer-type bg-<?php if($allListing['type'] == "rent") { echo "success"; } else { echo "danger";}?>"><?php echo isset($allListing['type']) ? $allListing['type'] : ''; ?></span>
                    </div>
                    <img src="images/<?php echo isset($allListing['image']) ? $allListing['image'] : ''; ?>" alt="Image" class="img-fluid thumbnail-image">
                </a>
                <div class="p-4 property-body">
                <h2 class="property-title"><a href="property-details.php?id=<?php echo $allListing['id']; ?>"><?php echo isset($allListing['name']) ? $allListing['name'] : ''; ?></a></h2>
                    <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo isset($allListing['location']) ? $allListing['location'] : ''; ?></span>
                    <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo isset($allListing['price']) ? $allListing['price'] : ''; ?></strong>
                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                        <li>
                            <span class="property-specs">Beds</span>
                            <span class="property-specs-number"><?php echo isset($allListing['beds']) ? $allListing['beds'] : ''; ?></span>
                        </li>
                        <li>
                            <span class="property-specs">Baths</span>
                            <span class="property-specs-number"><?php echo isset($allListing['baths']) ? $allListing['baths'] : ''; ?></span>
                        </li>
                        <li>
                            <span class="property-specs">SQ FT</span>
                            <span class="property-specs-number"><?php echo isset($allListing['sq_ft']) ? $allListing['sq_ft'] : ''; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        
      </div>
    </div>

    <div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          <h2>Why Choose Us?</h2>
        </div>
        <p>Discover the reasons why Homeland Realty is your top choice for real estate services. Our commitment to excellence, customer satisfaction, and industry expertise sets us apart.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-house"></span>
          <h2 class="service-heading">Research Suburbs</h2>
          <p>Explore and analyze different suburbs with our comprehensive research tools. Make informed decisions about your next property investment.</p>
         
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-sold"></span>
          <h2 class="service-heading">Sold Houses</h2>
          <p>Discover success stories with our sold houses. Join the satisfied homeowners who have successfully sold their properties with Homeland Realty.</p>
         
        </a>
      </div>
      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
          <span class="icon flaticon-camera"></span>
          <h2 class="service-heading">Security Priority</h2>
          <p>Your security is our top priority. Learn about our advanced security measures that ensure the protection of your property and personal information.</p>
          
        </a>
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