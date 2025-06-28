<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logic with Dilshan</title>
  <link rel="icon" href="image/logic logo.png" type="image/png" sizes="32x32">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>

  <div id="title">
    <img src="image/logic logo.png" alt="Logo" />
    <h1>Logic with Dilshan Uthpala</h1>
  </div>

  <div id="menubar">
    <nav class="navbar">
      <button class="menu-toggle" onclick="toggleMenu()">☰</button>
      <ul class="menu" id="menu">
        <li><a href="#">Home</a></li>
        <li><a href="#TimeTable">Time Table</a></li>
        <li><a href="classpage.php">Note & Papers</a></li>
        <li><a href="#Contact">Contact</a></li>
        <li><a href="#">Announcement</a></li>
      </ul>

      <!-- Guest buttons -->
      <div id="authButtons" style="display: block;">
        <button class="signup-button"><a href="login.html">Login</a></button>
        <button class="signup-button"><a href="Signup.html">Sign Up</a></button>
      </div>

      <!-- User profile (hidden by default) -->
      <div id="userProfile" style="display: none;">
        <span id="welcomeText"></span>
        <a href="dashboard.php">Profile</a> |
        <a href="logout.php">Logout</a>
      </div>
    </nav>
  </div>

  <!-- Slideshow -->
  <div class="slideshow-container">
    <div class="mySlides fade"><div class="numbertext">1 / 4</div><img src="image/c1.png" style="width:100%" /><div class="text">Caption Text</div></div>
    <div class="mySlides fade"><div class="numbertext">2 / 4</div><img src="image/c2.jpeg" style="width:100%" /><div class="text">Caption Two</div></div>
    <div class="mySlides fade"><div class="numbertext">3 / 4</div><img src="image/c3.jpg" style="width:100%" /><div class="text">Caption Three</div></div>
    <div class="mySlides fade"><div class="numbertext">4 / 4</div><img src="image/c4.jpg" style="width:100%" /><div class="text">Caption Four</div></div>
  </div>

  <br>
  <div style="text-align:center">
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span> 
  </div>

  <div id="AboutUs" class="content">
    <h4>About Us</h4>
    <p>Lorem Ipsum is dummy text...</p>
  </div>

  <div id="Mission" class="content">
    <h4>Our Mission</h4>
    <p>Lorem Ipsum is dummy text...</p>
  </div>

  <div id="TimeTable" class="content">
    <h4>Class Time Table</h4>
    <p>Lorem Ipsum is dummy text...</p>
  </div>

  <div id="Contact" class="content">
    <h4>Contact</h4>
    <ul>
      <li><a href="tel:+94770224060"><img src="image/speech_3869725.png" alt="Call"></a></li>
      <li><a href="https://wa.me/+94770224060"><img src="image/whatsapp_15015928.png" alt="WhatsApp"></a></li>
      <li><a href="https://www.facebook.com/profile.php?id=100094065144515"><img src="image/facebook_13170340.png" alt="Facebook"></a></li>
      <li><a href="#"><img src="image/social_10090309.png" alt="YouTube"></a></li>
      <li><a href="mailto:dilshanuthpalalogic@gmail.com"><img src="image/envelope_9073062.png" alt="Email"></a></li>
    </ul>
  </div>

  <footer>
    <p>&copy; 2023 Logic with Dilshan. All rights reserved.</p>
    <p>Author: Shashika Piyumal</p>
    <ul>
      <li><a href="tel:+94771080809"><img src="image/speech_3869725.png" alt="Call" width="30px"></a></li>
      <li><a href="https://wa.me/+94771080809"><img src="image/whatsapp_12635043.png" alt="WhatsApp" width="30px"></a></li>
      <li><a href="https://www.facebook.com/shashika.piyumal.18"><img src="image/communication_15047435.png" alt="Facebook" width="30px"></a></li>
      <li><a href="mailto:lakruwanshashika21@gmail.com"><img src="image/email_5508700.png" alt="Email" width="30px"></a></li>
      <li><a href="https://github.com/Lakruwanshashika21"><img src="image/github_1051326.png" alt="GitHub" width="30px"></a></li>
      <li><a href="https://www.linkedin.com/in/lakruwan-shashika-541661258"><img src="image/linkedin_1377213.png" alt="LinkedIn" width="30px"></a></li>
    </ul>
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById("menu").classList.toggle("show");
    }

    // Slideshow
    let slideIndex = 0;
    function showSlides() {
      const slides = document.getElementsByClassName("mySlides");
      const dots = document.getElementsByClassName("dot");
      if (slides.length === 0) return;

      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }

      slideIndex++;
      if (slideIndex > slides.length) slideIndex = 1;

      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }

      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";

      setTimeout(showSlides, 2000);
    }

    document.addEventListener("DOMContentLoaded", showSlides);

    // Check session and toggle login/profile
    document.addEventListener("DOMContentLoaded", function () {
      fetch("session_data.php")
        .then(res => res.json())
        .then(data => {
          if (data.logged_in) {
            document.getElementById("authButtons").style.display = "none";
            document.getElementById("userProfile").style.display = "inline-block";
            document.getElementById("welcomeText").innerText = `👋 Hello, ${data.name}`;
          }
        })
        .catch(error => console.error("Session check failed:", error));
    });
  </script>

</body>
</html>
