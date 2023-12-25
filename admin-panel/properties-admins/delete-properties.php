<?php
require "../layouts/header.php";
require "../../config/config.php";

if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php' </script>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Delete thumbnail image
        $query = $conn->query("SELECT * FROM props WHERE id = '$id'");
        $fetch_image = $query->fetch_assoc();
        unlink("thumbnails/" . $fetch_image['image']);

        // Delete prop record
        $delete_prop = $conn->query("DELETE FROM props WHERE id = '$id'");

        // Delete related images files from images folder
        $images = $conn->query("SELECT * FROM related_images WHERE prop_id = '$id'");
        $delete_images = $images->fetch_all(MYSQLI_ASSOC);

        foreach ($delete_images as $delete_image) {
            unlink("images/" . $delete_image['image']);
        }

        // Delete related_images records
        $delete_related_images = $conn->query("DELETE FROM related_images WHERE prop_id = '$id'");

        echo "<script>window.location.href='" . ADMINURL . "/properties-admins/show-properties.php' </script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
