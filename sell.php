<?php
// File: seller.php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $phone = $_POST['phone'];

    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = '';
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES["photo"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (in_array($fileType, $allowedTypes)) {
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                echo "<script>alert('Error uploading file.');</script>";
                $fileName = '';
            }
        } else {
            echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
            $fileName = '';
        }
    }

    if ($fileName) {
        $query = "INSERT INTO houses (photo, description, location, price, phone) VALUES ('$fileName', '$description', '$location', '$price', '$phone')";
        mysqli_query($con, $query);
        header("location: tenant.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller House Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">House Marketplace</a>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">Post a House for Sale/Rent</h2>
    <form enctype="multipart/form-data" method="POST">
        <div class="mb-3">
            <label for="photo" class="form-label">Upload Photo</label>
            <input type="file" id="photo" name="photo" accept="image/*" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Tshs)</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
