<?php
include_once "../controller/userC.php";
include_once "../config.PHP";

$userC = new UserC();

// Check if 'name' is provided in the URL query string
if (isset($_GET['name'])) {
    $username = $_GET['name'];

    echo `<script>alert('$username');</script>`;
    // Attempt to delete the user
    if ($userC->delete($username)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='tables.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user.'); window.location.href='tables.php';</script>";
    }
} else {
    header("Location: tables.php");
}
?>
