<?php
require "../includes/header.php";
require "../config/config.php";

if (isset($_POST['submit'])) {
   
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone'])) {
        echo "<script>alert('Some inputs are empty');</script>";
        echo "<script>window.location.href='" . APPURL . "' </script>";
    } else {
        
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $prop_id = mysqli_real_escape_string($conn, $_POST['prop_id']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $author = mysqli_real_escape_string($conn, $_POST['admin_name']);

        // Use prepared statements to prevent SQL injection
        $insert = $conn->prepare("INSERT INTO requests (name, email, phone, prop_id, user_id, author) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("sssiis", $name, $email, $phone, $prop_id, $user_id, $author);

        if ($insert->execute()) {
            echo "<script>alert('Request sent successfully');</script>";
        } else {
            echo "<script>alert('Error sending request');</script>";
        }

        $insert->close();
        echo "<script>window.location.href='" . APPURL . "/property-details.php?id=$prop_id' </script>";
    }
}
?>
