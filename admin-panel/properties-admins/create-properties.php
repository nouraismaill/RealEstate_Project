<?php
require "../layouts/header.php";
require "../../config/config.php";


if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php' </script>";
}

$categories = mysqli_query($conn, "SELECT * FROM categories");

if (!$categories) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$allCategories = [];

while ($prop = mysqli_fetch_assoc($categories)) {
    $allCategories[] = $prop;
}

$id = '';

if (isset($_POST['submit'])) {

    if (empty($_POST['name']) || empty($_POST['location']) || empty($_POST['price']) ||
        empty($_POST['beds']) || empty($_POST['baths']) || empty($_POST['sq_ft']) ||
        empty($_POST['home_type']) || empty($_POST['year_built']) || empty($_POST['type']) ||
        empty($_POST['description']) || empty($_POST['price_sqft'])) {

        echo "<script>alert('Some inputs are empty');</script>";

    } else {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $price = $_POST['price'];
        $beds = $_POST['beds'];
        $baths = $_POST['baths'];
        $sq_ft = $_POST['sq_ft'];
        $home_type = $_POST['home_type'];
        $year_built = $_POST['year_built'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $price_sqft = $_POST['price_sqft'];
        $adminname = $_SESSION['adminname'];
        $image = $_FILES['thumbnail']['name'];

        $dir = "thumbnails/" . basename($image);

        $insert = mysqli_query($conn, "INSERT INTO props(name, location, price, beds, baths,
            sq_ft, home_type, year_built, type, description, price_sqft, admin_name, image) 
            VALUES ('$name', '$location', '$price', '$beds', '$baths','$sq_ft','$home_type', 
           '$year_built', '$type', '$description',' $price_sqft', '$adminname', '$image')");

        if ($insert) {
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $dir)) {
                echo "<script>alert('Property created successfully');</script>";
            } else {
                echo "<script>alert('Error uploading thumbnail');</script>";
            }

            $id = mysqli_insert_id($conn);

            foreach ($_FILES['image']['tmp_name'] as $key => $value) {
                $filename = $_FILES['image']['name'][$key];
                $filename_tmp = $_FILES['image']['tmp_name'][$key];
                echo '<br>';
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $finalimg = '';
                $filename = str_replace('.', '-', basename($filename, $ext));
                $newfilename = $filename . time() . "." . $ext;
                move_uploaded_file($filename_tmp, 'images/' . $newfilename);
                $finalimg = $newfilename;
                $insertqry = mysqli_query($conn, "INSERT INTO `related_images` (`image`, `prop_id`) VALUES ('$finalimg', '$id')");

                if (!$insertqry) {
                    echo "Error inserting image: " . mysqli_error($conn);
                    exit;
                }
            }

            // Redirect after the loop has finished
            echo "<script>window.location.href='" . ADMINURL . "/properties-admins/show-properties.php' </script>";
        } else {
            echo "<script>alert('Error creating property');</script>";
        }
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="location" id="form2Example1" class="form-control" placeholder="location" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="beds" id="form2Example1" class="form-control" placeholder="beds" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="baths" id="form2Example1" class="form-control" placeholder="baths" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="sq_ft" id="form2Example1" class="form-control" placeholder="SQ/FT" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="year_built" id="form2Example1" class="form-control" placeholder="Year Build" />
                    </div>
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="price_sqft" id="form2Example1" class="form-control" placeholder="Price Per SQ FT" />
                    </div>

                    <select name="home_type" class="form-control form-select" aria-label="Default select example">
                        <option selected>Select Home Type</option>
                        <?php foreach ($allCategories as $category) : ?>
                            <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="type" class="form-control mt-3 mb-4 form-select" aria-label="Default select example">
                        <option selected>Select Type</option>
                        <option value="Rent">Rent</option>
                        <option value="Sale">Sale</option>
                    </select>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea placeholder="Description" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Property Thumbnail</label>
                        <input name="thumbnail" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Gallery Images</label>
                        <input name="image[]" class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
