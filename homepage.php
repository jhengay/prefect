<?php   
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: register.php");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('hephep1.jpg') center center fixed;
            background-size: cover;
            color: #fff;
            overflow-x: hidden;
        }    

        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
            top: 0;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: -110px;
            display: flex;
        }

        .navbar ul li a:hover {
            background: #ff4b5c;
        }

        .logout a {
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            margin-left: 1400px;
            color: #ff4b5c;
            display: flex;
            max-width: 70px;
            margin-top: -130px;
            transition: all 0.3s ease;
        }

        .logout a:hover {
            background: #ff4b5c;
            color: #fff;
        }

        .main-content {
            text-align: center;
            margin-top: 100px;
            padding: 30px;
        }
        .galaw{
            margin-top: 220px;
        }

        .main-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .buttons a {
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            background: #6e8efb;
            color: #fff;
            transition: all 0.3s ease;
            animation: circle 1s ease-in-out;
        }

        .buttons a:hover {
            background: #576dd4;
            transform: scale(1.05);
        }

        .section {
            max-width: 800px;
            text-align: center;
            opacity: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transform: translateX(-100px);
            transition: all 0.6s ease-out;
            padding: 3rem;
        }

        .section.active {
            opacity: 1;
            transform: translateX(0);
        }

        .section h2 {
            font-size: 2rem;
            color: #ffdd57;
            margin-bottom: 20px;
        }

        .section p, .section ul {
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .section ul {
            list-style-type: decimal;
            padding-left: 20px;
            text-align: left;
        }

        .section ul li {
            margin-bottom: 10px;
        }
        .picb{
            height: 100px;
            width: 100px;
        }
        .topp{
            animation: jc .6s ease-in-out;
        }
        @keyframes jc{
            from{
                opacity: 0;
                transform: translateY(-100px);
            }
            to{
                opacity: 1;
                transform: translateY(0px);
            }
        }
    </style>
</head>
<body>
    <div class="topp">
     <img src="galilee-removebg-preview.png" class="picb">
    <nav class="navbar">
        <ul>
            <li><a class="active" href="homepage.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="user_logs.php">User Logs</a></li>
        </ul>
        
    </nav>
            <div class="logout">
            <a href="register.php?logout=true">Logout</a>
        </div>
    </div>
    <div class="galaw">
    <div class="main-content">
        <h1>Welcome to Prefect Discipline<br>Management System</h1>
        <div class="buttons">
            <a href="add_new.php">Add New Prefect</a>
            <a href="trashbin.php">View Deleted Records</a>
        </div>
    </div>
</div>
    <center>
    <div class="section" id="mission">
        <h2>Mission</h2>
        <p>Provide students with top-notch education and skills training combined with spiritual, moral, and personal development.</p>
    </div>

    <div class="section" id="vision">
        <h2>Vision</h2>
        <p>To be an institution that raises citizens ready to face the future strengthened through education, under the guidance of God Almighty.</p>
    </div>

    <div class="section" id="objectives">
        <h2>Objectives</h2>
        <ul>
            <li>To provide relevant, up-to-date, affordable education to all students to prepare them for their chosen career.</li>
            <li>To work with the Department of Education in the successful implementation of goals of the K12 program.</li>
            <li>To work in partnership with establishments in providing students with real-world application of skills and knowledge.</li>
            <li>Employ and train competent teachers to provide students with the best guidance and instruction in developing their skills and increasing their knowledge.</li>
        </ul>
    </div>
</center>

    <script>
        // Intersection Observer for scroll animations
        const sections = document.querySelectorAll('.section');

        const observerOptions = {
            threshold: 0.5, // Trigger when 50% of the section is visible
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        sections.forEach((section) => observer.observe(section));
    </script>
</body>
</html>
