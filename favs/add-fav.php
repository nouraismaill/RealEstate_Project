<?php
require "../includes/header.php";
require "../config/config.php";


if(!isset($_SESSION['username'])) {
    echo "<script>window.location.href='".APPURL."' </script>";

  }
if (isset($_POST['submit'])) {
        $prop_id = mysqli_real_escape_string($conn, $_POST['prop_id']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $insert = $conn->prepare("INSERT INTO favs (prop_id, user_id) VALUES (?, ?)");
        $insert->bind_param("ii",$prop_id, $user_id);

        if ($insert->execute()) {
            echo "<script>window.location.href='".APPURL."/property-details.php?id=$prop_id' </script>";
        } else {
            echo "<script>alert('Error sending request');</script>";
        }
    }

?>
