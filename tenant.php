<?php
session_start();
include("db.php");

// Simulate user ID for demonstration (replace with actual session user ID in production)
$user_id = $_SESSION['user_id'] ?? 1; 

// Fetch houses from the database
$query = "SELECT * FROM houses ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
    $house_id = $_POST['house_id'];

    // Verify the house belongs to the logged-in user
    $checkQuery = "SELECT * FROM houses WHERE id = '$house_id' AND id = '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Delete the house
        $deleteQuery = "DELETE FROM houses WHERE id = '$house_id'";
        mysqli_query($conn, $deleteQuery);
        echo "<script>alert('House deleted successfully!'); window.location.href='tenant.php';</script>";
    } else {
        echo "<script>alert('Unauthorized action!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            color: #333;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .full-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .full-screen img {
            max-width: 90%;
            max-height: 90%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <a class="navbar-brand" href="#">House Marketplace</a>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Available Houses</h2>
    <div class="row">
        <?php while ($house = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="uploads/<?php echo $house['photo']; ?>" class="card-img-top img-thumbnail" alt="House Image" onclick="toggleFullScreen(this)">
                    <div class="card-body">
                        <h5 class="card-title">Location: <?php echo $house['location']; ?></h5>
                        <p class="card-text">Description: <?php echo $house['description']; ?></p>
                        <p class="card-text">Price: Tshs <?php echo $house['price']; ?></p>
                        <p class="card-text">Phone: <?php echo $house['phone']; ?></p>
                        
                            <form method="POST" class="mt-3">
                                <input type="hidden" name="house_id" value="<?php echo $house['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger w-100">Delete</button>
                            </form>
                        
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div id="fullScreenView" class="full-screen" style="display: none;" onclick="toggleFullScreen()">
    <img id="fullScreenImage" src="" alt="Full Screen">
</div>
<script>
    function toggleFullScreen(img = null) {
        const fullScreenDiv = document.getElementById('fullScreenView');
        const fullScreenImg = document.getElementById('fullScreenImage');
        if (img) {
            fullScreenImg.src = img.src;
            fullScreenDiv.style.display = 'flex';
        } else {
            fullScreenDiv.style.display = 'none';
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
