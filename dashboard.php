
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .dashboard {
            display: flex;
        }

        .sidebar {
            width: 240px;
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
            text-align: center;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            display: block;
            padding: 10px;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        .taskbar {
            background-color: #ffffff;
            padding: 15px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .taskbar h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .listings {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .listing {
            flex: 1 1 calc(45% - 20px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .listing img {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .listing img:hover {
            transform: scale(1.05);
        }

        .listing h2 {
            font-size: 18px;
            padding: 10px;
            margin: 0;
            background-color: #f8f9fa;
        }

        .fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: contain;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.9);
            cursor: pointer;
        }

        .close-btn {
            position: fixed;
            top: 10px;
            right: 10px;
            color: white;
            font-size: 30px;
            cursor: pointer;
            z-index: 1100;
            display: none;
        }

        .fullscreen + .close-btn {
            display: block;
        }

        @media (max-width: 768px) {
            .listing {
                flex: 1 1 100%;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a href="homepage.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="owner.php">Sell/Rent (Owner)</a></li>
                <li><a href="tenant.php">Buy/Rent (Tenant)</a></li>
                <li><a href="homepage.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header class="taskbar">
                <h2>Types of Houses Found</h2>
            </header>
            <section class="listings">
                <div class="listing">
                    <h2>Beautiful Family House</h2>
                    <img src="../project/familyhou.jpg" alt="Beautiful Family House">
                </div>
                <div class="listing">
                    <h2>Modern Luxury Apartment</h2>
                    <img src="../project/luxuryhou.jpg" alt="Modern Luxury Apartment">
                </div>
                <div class="listing">
                    <h2>Local Apartment</h2>
                    <img src="../project/localhou.jpg" alt="Local Apartment">
                </div>
                <div class="listing">
                    <h2>Commercial Apartment</h2>
                    <img src="../project/house1.jpg" alt="Commercial Apartment">
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const images = document.querySelectorAll(".listings img");
            let closeButton = null;

            images.forEach(img => {
                img.addEventListener("click", () => {
                    images.forEach(img => img.classList.remove("fullscreen"));
                    img.classList.toggle("fullscreen");

                    if (!closeButton) {
                        closeButton = document.createElement('div');
                        closeButton.classList.add('close-btn');
                        closeButton.innerHTML = '&times;';
                        document.body.appendChild(closeButton);

                        closeButton.addEventListener('click', () => {
                            images.forEach(img => img.classList.remove("fullscreen"));
                            closeButton.style.display = 'none';
                        });
                    }

                    if (img.classList.contains('fullscreen')) {
                        closeButton.style.display = 'block';
                    } else {
                        closeButton.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
