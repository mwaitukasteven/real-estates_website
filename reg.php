<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($number) && !empty($password) && !empty($confirm_password)) {
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // Check if the email already exists
            $checkQuery = "SELECT * FROM register WHERE email='$email'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>alert('These credentials already exist. Please use a different email.');</script>";
            } else {
                // Insert new user
                $query = "INSERT INTO register (fname, lname, email, number, password) VALUES ('$firstname','$lastname','$email','$number','$password')";
                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Registration successful! Please log in.');</script>";
                    header("Location: login.php");
                    die;
                } else {
                    echo "<script>alert('Error in registration. Please try again.');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="reg.css">
    <style>
        .card {
            max-width: 350px;
            margin: auto;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark mt-0 bg-dark fixed-top">
        <a class="navbar-brand" href="homepage.php">home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-0">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Sign Up</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" required>
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="number" id="number" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php">Login Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

