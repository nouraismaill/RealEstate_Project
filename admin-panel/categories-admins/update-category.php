<?php
require "../layouts/header.php";
require "../../config/config.php";

if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php' </script>";
}

$allCategory = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $categoryStmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $categoryStmt->bind_param('i', $id);
    $categoryStmt->execute();
    
    $result = $categoryStmt->get_result();
    
    if ($result->num_rows > 0) {
        $allCategory = $result->fetch_assoc();
    } else {
        echo "Error: " . $conn->error;
    }
    $categoryStmt->close();
}

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        echo "<script>alert('input is empty');</script>";
    } else {
        $name = $_POST['name'];

        $updateStmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $updateStmt->bind_param('si', $name, $id);
        $updateStmt->execute();
        $updateStmt->close();

        echo "<script>window.location.href='" . ADMINURL . "/categories-admins/show-categories.php' </script>";
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                <form method="POST" action="update-category.php?id=<?php echo $allCategory['id']; ?>">
                    <!-- Name input -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" id="form2Example1" value="<?php echo $allCategory['name']; ?>" class="form-control" placeholder="Name">
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
