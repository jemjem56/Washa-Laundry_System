<?php
session_start();
include('db_connect.php');

// Redirect to login if not logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }

// Fetch user data
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Washka - Laundry System</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --primary-color: #1b0d63;
             --hover-color: #3d2dd2;
            --white: #ffffff;
            --text-color: #333;
        }

        body {
            background-color: var(--primary-color);
            color: var(--text-color);
            transition: opacity 0.5s ease;
            opacity: 1;
        }
        body.fade-out {
            opacity: 0;
        }
        /* HEADER */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 80px;
            background-color: #fff;
        }

        header img {
            height: 50px;
        }

        header h1 {
            font-size: 1.3rem;
            color: var(--primary-color);
            letter-spacing: 1px;
            font-weight: 600;
        }

        .image-text {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .image-text img {
            width: 50px;
            border-radius: 6px;
        }
        .header-text {
            display: flex;
            flex-direction: column;
            color: var(--main-color);
        }
         header .image-text .header-text {
            display: flex;
            flex-direction: column;
        }
        .header-text .name {
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'Itim', cursive;
            letter-spacing: 1.5px;
            font-size: 1.6rem;
            color: var(--primary-color);
        }
        /* HERO SECTION */
        .hero {
            position: relative;
            background: url('laundry_bg.jpg') center/cover no-repeat;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(9, 9, 33, 0.8); /* #33349b with opacity */
        }

        .hero-content {
            position: relative;
            color: var(--white);
            z-index: 2;
            max-width: 700px;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 0.1rem;
            margin-bottom: 15px;
        }

        .hero-content p {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 25px;
            letter-spacing: 0.1rem;
        }

        .hero-content a {
            display: inline-block;
            background: var(--primary-color);
            color: #fff;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
            letter-spacing: 0.1rem;
        }

        .hero-content a:hover {
            background: var(--hover-color);
        }
        /* FEATURES SECTION */
        .features {
            background: var(--white);
            text-align: center;
            padding: 60px 20px;
        }

        .features h2 {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 40px;
        }

        .feature-boxes {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
        }

        .feature {
            background: #f3f3fb;
            border-radius: 16px;
            width: 250px;
            padding: 30px 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: var(--transition);
            background: var(--primary-color);
        }

        .feature i {
            font-size: 3rem;
            color: var(--main-color);
            margin-bottom: 10px;
             color: var(--white);
        }

        .feature h3 {
            font-size: 1.1rem;
            font-weight: 600;
             color: var(--white);
            margin-bottom: 8px;
        }

        .feature p {
            font-size: 0.9rem;
            color: var(--text-color);
             color: var(--white);
        }

        .feature:hover {
    transform: translateY(-10px);
    background: var(--hover-color);
    color: var(--white);
    transition: all 0.5s ease;
}

/* Fix the icon and heading on hover */
    .feature:hover i,
    .feature:hover h3,
    .feature:hover p {
    color: var(--white);
}

        /* FOOTER */
        footer {
            background: var(--primary-color);
            color: #fff;
            text-align: left;
            padding: 15px 0;
            padding-left: 35px;
            font-size: 0.9rem;
            font-family: 'Itim', cursive;
            letter-spacing: 1.5px;
        }
        footer span {
            text-transform: uppercase;
             font-family: 'Itim', cursive;
        }


        @media (max-width: 768px) {
            header {
                padding: 20px;
            }
            .hero-content h1 {
                font-size: 1.8rem;
            }
            .feature-boxes {
                gap: 40px;
            }
        }
    </style>
</head>
<body>
    <header>
            <div class="image-text">
                <img src="logo.png" alt="Logo">
                <div class="header-text text">
                    <span class="name">Washka?</span>
                </div>
            </div>
        </header>
    <section class="hero">
        <div class="hero-content">
            <h1>Smart Laundry Management<br>& Notifications System</h1>
            <p>Easily manage customers, track laundry status, and send ready-for-pickup notification.</p>
            <a href="index.php">Get Started</a>
        </div>
    </section>

    <section class="features">
        <h2>Features</h2>
        <div class="feature-boxes">
            <div class="feature">
                <i class='bx bx-user'></i>
                <h3>Customer Record Management</h3>
                <p>Maintain a database of customer information</p>
            </div>
            <div class="feature">
                <i class='bx bx-refresh'></i>
                <h3>Laundry Status Tracking</h3>
                <p>Track the laundry from drop off to completion</p>
            </div>
            <div class="feature">
                <i class='bx bx-envelope'></i>
                <h3>We Will Get You Notified</h3>
                <p>You'll receive an SMS when it's ready</p>
            </div>
        </div>
    </section>

    <footer>
        Copyright © 2025 <span> WASHKA? </span>
    </footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('a[href="index.php"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // prevent instant navigation
            document.body.classList.add('fade-out'); // trigger fade
            setTimeout(() => {
                window.location = this.href; // redirect after fade
            }, 500); // 500ms matches CSS transition
        });
    });
});
</script>

</body>
</html>
