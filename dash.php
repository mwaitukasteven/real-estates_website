<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Dashboard</title>
    <link rel="stylesheet" href="{{url_for('static',filename='dashboard.css')}}">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Real Estate</h2>
            <ul>
                <li><a href="#">upload</a></li>
                <li><a href="{{url_for('selling')}}">Sell Property</a></li>
                <li><a href="#">Rent Property</a></li>
                <li><a href="{{url_for('login')}}">Logout</a></li>
                <li><a href="#">Profile</a></li>
                
            </ul>
        </div>
        <div class="main-content">
            <header>
                <h1>Dashboard</h1>
            </header>
            <section class="listings">
                <div class="listing">
                    <h2>Beautiful Family House</h2>
                    <p>Location: Kibaha(Dar-es-salaam)</p>
                    <p>Price: 1,200,000T.Sh</p>
                    <button>View Details</button>
                </div>
                <div class="listing">
                    <h2>Modern Apartment</h2>
                    <p>Location:Mikocheni(Dar-es-salaam)</p>
                    <p>Rent: 220,000T.Sh/month</p>
                    <button> <a href="{{url_for('view')}}"></a>View Details</button>
                </div>
                <div class="listing">
                    <h2>Local Apartment</h2>
                    <p>Location: Makongo(Dar-es-salaam)</p>
                    <p>Rent: 80,000T.Sh/month</p>
                    <button> <a href="{{url_for('view')}}"></a> View Details</button>

                </div>
                <div class="listing">
                  <h2>Commercial Apartment</h2>
                  <p>Location:Indian Ocean</p>
                  <p>Rent:200,000T.Sh/month</p>
                  <button><a href="{{url_for('view')}}"></a>View Details</button>
                </div>
                <!-- More listings can be added here -->
            </section>
        </div>
    </div>
</body>
</html>

