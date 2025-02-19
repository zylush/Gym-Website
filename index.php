<?php
session_start();  // Start the session to store user data
include 'database/db.php'; // Include the database connection

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Retrieve email as username
    $password = trim($_POST['password']); // Retrieve password

    // Fetch user from the database using email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        //var_dump($user['password']); // Should display the hashed password
        //var_dump($password);  
        // Validate the password w/o using hash
        if ($password === $user['password']) {
            // Password is correct; set session and redirect to dashboard
            $_SESSION['user'] = $user['email'];  // Store user email in session
            header("Location: dashboard.php");   // Redirect to dashboard
            exit;
        } else {
            //echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with that email. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dstars Fitness Gym</title>
    <style>
        /* General Styles */
        .index-body {
            background: linear-gradient(to right, black, red, black);
            font-family: 'Arial', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
        }
    
        /* Header */
        .index-header {
            background: rgba(0, 0, 0, 0.9);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
    
        .index-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
    
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: red;
        }
    
        .nav ul {
            display: flex;
            list-style: none;
        }
    
        .nav ul li {
            margin-left: 1.5rem;
        }
    
        .nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
    
        .nav ul li a:hover {
            color: red;
        }
    
        /* Section Styles */
        section {
            padding: 3rem 1rem;
            text-align: center;
            display: none; /* Initially hidden */
        }
    
        section.active {
            display: block; /* Visible when active */
        }
    
        /* Hero Section */
        .hero {
            padding: 5rem 1rem;
            background: linear-gradient to right, black, rgba(255, 0, 0, 0.😎, black);
        }
    
        .hero h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    
        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
    
        .hero .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: red;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }
    
        .hero .btn:hover {
            background: darkred;
        }
    
        /* Login Section */
        .login {
            background: rgba(0, 0, 0, 0.9);
            margin: 2rem auto;
            border-radius: 10px;
            max-width: 500px;
            padding: 2rem; /* Added padding to ensure content fits */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            height: auto; /* Allowing it to grow with content */
        }
    
        .login h2 {
            font-size: 2rem;
            color: red;
            margin-bottom: 1rem;
        }
    
        .login form {
            margin-top: 1rem;
        }
    
        .login label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
    
        .login input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 1rem;
        }
    
        .login input:focus {
            outline: none;
            border: 1px solid red;
        }
    
        .login button {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            background: red;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
            font-size: 1rem;
        }
    
        .login button:hover {
            background: darkred;
        }
    
        /* About, Services, and Contact Section - Adjusting font size */
        #about, #services, #contact {
            font-size: 1.5rem; /* Match font size of body in 'Home' */
        }
    
        /* Footer */
        .index-footer {
            background: black;
            padding: 1rem;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body class="index-body">
    <header class="index-header">
        <div class="container">
            <h1 class="logo">Dstars Fitness Gym</h1>
            <nav class="nav">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home" class="hero active">
        <h2>Push Your Limits</h2>
        <p>Join the best fitness community and achieve your goals with Dstars Fitness Gym!</p>
        <a href="#contact" class="btn">Get Started</a>
        <div class="login">
            <h2>Login</h2>
            <p>Access your personalized fitness plan and stay on track.</p>
            <form action="index.php" method="POST">
                <label for="Username">Email:</label>
                <input type="text" id="fname" name="username" placeholder="Enter your email">
                
                <label for="Password">Password:</label>
                <input type="text" id="lname" name="password" placeholder="Enter your password">
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>

    <section id="about">
        <h2>About Us</h2>
        <p>At Dstars Fitness Gym, we redefine fitness with top-notch equipment, expert trainers, and a welcoming atmosphere. Transform your body and mind today!</p>
    </section>

    <section id="services">
        <h2>Our Services</h2>
        <ul>
            <li>Strength Training</li>
            <li>High-Intensity Workouts</li>
            <li>Yoga and Mindfulness</li>
            <li>Personalized Coaching</li>
        </ul>
    </section>

    <section id="contact">
        <h2>Get in Touch</h2>
        <p>Email: <strong>info@dstarsfitnessgym.com</strong></p>
        <p>Phone: <strong>+1 555-123-4567</strong></p>
        <p>Visit us: <strong>Brgy. Lagao (fronting Robinsons Malls)</strong></p>
    </section>

    <footer class="index-footer">
        <p>&copy; 2024 Dstars Fitness Gym. Built to inspire and achieve!</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav ul li a');

            function showSection(id) {
                sections.forEach(section => {
                    section.classList.toggle('active', section.id === id);
                });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    showSection(targetId);
                });
            });
        });
    </script>
</body>
</html>