<?php
require "../includes/header.php";
require "../config/config.php";

$allListings = [];
$allListingsPrice = [];
$allSingleCategory = [];

// Fetch all properties
$select = mysqli_query($conn,"SELECT * FROM props ORDER BY name DESC");

if (!$select) {
    echo "Error: " . $conn->error;
} else {
    // Fetch data using fetch_assoc to get an associative array
    while ($row = $select->fetch_assoc()) {
        $props[] = $row;
    }
}

// Filter by type
if (isset($_GET['type'])) {
    $type = $conn->real_escape_string($_GET['type']);
    $selectQuery = "SELECT * FROM props WHERE type = '$type'";
    $rent = mysqli_query($conn,$selectQuery);

    if ($rent) {
        while ($row = $rent->fetch_assoc()) {
            $allListings[] = $row;
        }
    } else {
        echo "<script>window.location.href='" . APPURL . "/404.php' </script>";
        exit; // Stop script execution
    }
}

// Filter by price
if (isset($_GET['price'])) {
    $price = $conn->real_escape_string($_GET['price']);
    $query = "SELECT * FROM props ORDER BY price $price";
    $price_query =mysqli_query($conn,$query);

    if ($price_query) {
        while ($row = $price_query->fetch_assoc()) {
            $allListingsPrice[] = $row;
        }
    } else {
        echo "<script>window.location.href='" . APPURL . "/404.php' </script>";
        exit;
    }
}

// Filter by name
if (isset($_GET['name'])) {
    $name = $conn->real_escape_string($_GET['name']);
    $singleCategoryQuery = "SELECT * FROM props WHERE home_type = '$name'";
    $singleCategory =mysqli_query($conn,$singleCategoryQuery);

    if ($singleCategory) {
        while ($row = $singleCategory->fetch_assoc()) {
            $allSingleCategory[] = $row;
        }
    } else {
        echo "<script>window.location.href='" . APPURL . "/404.php' </script>";
        exit;
    }
}


?>
   
   <div class="slide-one-item home-slider owl-carousel">
  <?php foreach ($props as $prop) : ?>
    <div class="site-blocks-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/<?php echo $prop['image']; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block bg-<?php if($prop['type'] == "rent") { echo "success"; } else { echo "danger";}?> text-white px-3 mb-3 property-offer-type rounded"><?php echo $prop['type']; ?></span>
            <h1 class="mb-2"><?php echo $prop['name']; ?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">$<?php echo $prop['price']; ?></strong></p>
            <p><a href="<?php echo APPURL;?>/property-details.php?id=<?php echo $prop['id']; ?>" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p>
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
                  <?php foreach($allSingleCategory as $category):?>
                    <option value="<?php echo $category['name'] ?>"><?php echo str_replace('-', ' ', $category['name']); ?></option>
                <?php endforeach;?>
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
    <?php foreach($allSingleCategory as $homeType): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
                <a href="<?php echo APPURL;?>/property-details.php?id=<?php echo $homeType['id']; ?>" class="property-thumbnail">
                    <div class="offer-type-wrap">
                        <span class="offer-type bg-<?php if($homeType['type'] == "rent") { echo "success"; } else { echo "danger";}?>"><?php echo isset($homeType['type']) ? $homeType['type'] : ''; ?></span>
                    </div>
                    <img src="<?php echo APPURL; ?>/images/<?php echo isset($homeType['image']) ? $homeType['image'] : ''; ?>" alt="Image" class="img-fluid thumbnail-image">
                </a>
                <div class="p-4 property-body">
                    <h2 class="property-title"><a href="property-details.php?id=<?php echo $homeType['id']; ?>"><?php echo isset($homeType['name']) ? $homeType['name'] : ''; ?></a></h2>
                    <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> <?php echo isset($homeType['location']) ? $homeType['location'] : ''; ?></span>
                    <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo isset($homeType['price']) ? $homeType['price'] : ''; ?></strong>
                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                        <li>
                            <span class="property-specs">Beds</span>
                            <span class="property-specs-number"><?php echo isset($homeType['beds']) ? $homeType['beds'] : ''; ?></span>
                        </li>
                        <li>
                            <span class="property-specs">Baths</span>
                            <span class="property-specs-number"><?php echo isset($homeType['baths']) ? $homeType['baths'] : ''; ?></span>
                        </li>
                        <li>
                            <span class="property-specs">SQ FT</span>
                            <span class="property-specs-number"><?php echo isset($homeType['sq_ft']) ? $homeType['sq_ft'] : ''; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        
      </div>
    </div>

  

    <?php require "../includes/footer.php";?>