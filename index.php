<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Join Logic with Dilshan Uthpala for the best online and physical classes in Sri Lanka. Learn from experienced teachers.">
  <meta name="keywords" content="Logic online class, Logic physical class, Logic with Dilshan Uthpala, classes in Sri Lanka, A/L tuition, online learning, physical tuition,wins,OASIS,nittambuwa,veyangoda,online,physical,logic,online logic,physical logic,logic class">
  <meta name="author" content="Logic with Dilshan Uthpala">
  <meta property="og:title" content="Logic with Dilshan Uthpala - Online & Physical Classes" />
  <meta property="og:description" content="Best online and physical classes for A/L students in Sri Lanka." />
  <meta property="og:image" content="https://logicwithdilshan.free.nf/c1.png" />
  <meta property="og:url" content="http://logicwithdilshan.free.nf/" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Logic with Dilshan</title>
  <link rel="icon" href="image/logic logo.png" type="image/png" sizes="32x32">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>

  <div id="title" class="background-box">
    <div class="typewriter-multi">
    <h1><span id="typed-text"></span><span class="cursor">|</span></h1>
  </div>
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
        <!-- <button class="signup-button"><a href="Signup.html">Sign Up</a></button> -->
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
  <div class="slideshow-container" id="slideshow">
    <div class="mySlides fade"><div class="numbertext">1 / 3</div><img src="image/c1.png" style="width:100%" /><div class="text">Caption Text</div></div>
    <div class="mySlides fade"><div class="numbertext">2 / 3</div><img src="image/c3.jpg" style="width:100%" /><div class="text">Caption Three</div></div>
    <div class="mySlides fade"><div class="numbertext">3 / 3</div><img src="image/c4.jpg" style="width:100%" /><div class="text">Caption Four</div></div>
  </div>

  <br>
  <div style="text-align:center">
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span> 
  </div>

  <div id="AboutUs" class="content">
    <h4>About Us</h4>
    <p style="text-align: center;"><b><i>Logic with Dilshan Uthpala,</i></b> We believe that logic is not just another subject but a way of thinking, questioning and discovering the world around us that goes beyond that. </p>
    <p style="text-align: center;">Created by a passionate, logical, young law student, this logic platform will help students build a sharper mind, strengthen their reasoning and practice logical thinking.</p>
  </div><hr>

  <div id="Mission" class="content">
    <h4>Our Mission</h4>
    <p style="text-align: center;">Our goal is to simplify the subject of logic, which is considered complex in society, and present it to the student in a fun, intuitive and understandable way.</p>
    <p style="text-align: center;">Our mission is to teach the logic section as well as the scientific method section correctly with equal emphasis.</p>
    <p style="text-align: center;">For this purpose, instead of teaching a mere subject, we will work to instill a rational mindset in the student.</p>
  </div><hr>

 <div id="TimeTable" class="content">
  <h4>Class Time Table</h4><br>

  <div class="tm-grid tm">
    <!-- 2025 A/L -->
    <div class="tm-block">
      <div class="word-textbox"><span class="highlight">2025 A/L</span></div><br>
      <h5>Wins - Veyangoda</h5><br>
      <h6>Revision</h6>
      <p>Saturday | 8.00 A.M to 1.00 P.M</p><hr>
      <h6>Speed Revision</h6>
      <p>Sunday | 7.00 A.M. to 10.00 A.M.</p><hr>
      <h6>Paper Class</h6>
      <p>Saturday | 2.00 P.M. to 5.30 P.M</p>
    </div>

    <!-- 2026 A/L -->
    <div class="tm-block">
      <div class="word-textbox"><span class="highlight">2026 A/L</span></div><br>
      <h5>Wins - Veyangoda</h5>
      <h6>Theory</h6>
      <p>Sunday | 1.00 P.M. to 3.15 P.M.</p><hr>
      <h5>OASIS - Nittambuwa</h5>
      <h6>Theory</h6>
      <p>Saturday | 3.30 P.M. to 6.00 P.M.</p>
    </div>

    <!-- 2027 A/L -->
    <div class="tm-block">
      <div class="word-textbox"><span class="highlight">2027 A/L</span></div><br>
      <h5>Wins - Veyangoda</h5>
      <h6>Theory</h6>
      <h6>Group I</h6>
      <p>Sunday | 10.30 A.M. to 12.30 P.M.</p>
      <h6>Group II</h6>
      <p>Sunday | 3.15 P.M. to 5.15 P.M.</p><hr>
      <h5>OASIS - Nittambuwa</h5>
      <h6>Theory</h6>
      <p>Saturday | 1.30 P.M. to 3.30 P.M.</p>
    </div>

    <div class="tm-block">
      <div class="word-textbox"><span class="highlight">Online Classes</span></div><br>
      <h5>Island Wide</h5>
      <h6>Theory</h6>
      <p>Saturday | 7.30 P.M. to 9.30 P.M.</p><hr>
      <div class="image-hover" tabindex="0" onclick="swapImage(this)">
          <center><img src="image/images.png" alt="Main Image" class="img-front" /></center>
          <center><img src="image/images (1).png" alt="Hover Image" class="img-back" /></center>
      </div>


    </div>
  </div>
</div><br>


  <div id="Location" class="content">
    <h4>You Can Find Us Here</h4><br>
    <h3><a href="https://maps.app.goo.gl/44Q1L6UKYFusdd4N9">OASIS-Nittambuwa</a></h3>
    <h3><a href="https://maps.app.goo.gl/53zDfbM3nLfPK8xf9">Wins-Veyangoda</a></h3>

  </div><hr>

  <div id="Contact" class="content">
    <h4>Contact</h4><br>
    <ul>
      <li><a href="tel:+94770224060"><img class="rotate-hover" src="image/speech_3869725.png" alt="Call"></a></li>
      <li><a href="https://wa.me/+94770224060"><img class="rotate-hover" src="image/whatsapp_15015928.png" alt="WhatsApp"></a></li>
      <li><a href="https://www.facebook.com/profile.php?id=100094065144515"><img class="rotate-hover" src="image/facebook_13170340.png" alt="Facebook"></a></li>
      <li><a href="#"><img class="rotate-hover" src="image/social_10090309.png" alt="YouTube"></a></li>
      <li><a href="mailto:dilshanuthpalalogic@gmail.com"><img class="rotate-hover" src="image/envelope_9073062.png" alt="Email"></a></li>
    </ul>
  </div><hr>
  <div>
    <center><img  style="width: 300px; height: auto;" src="image/KDL4.png" alt="QR Code"></center>
  </div>
    <hr>
    <div id="map">
        <iframe class="map-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.741969789723!2d80.05319207566744!3d7.155802897080286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fdd2280dcafb%3A0xfc5301c6a333a004!2sWins!5e0!3m2!1sen!2slk!4v1751099717173!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <iframe class="map-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1979.423317260154!2d80.09445157404214!3d7.143726748241609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fdaa6b4a3149%3A0xdba57acfbadd31ad!2sNittambuwa%20Colour%20Light%20Junction!5e0!3m2!1sen!2slk!4v1751100024715!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<div>
  <footer>
    <p>&copy; 2023 Logic with Dilshan Uthpala. All rights reserved.</p>
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
  </div>

  <script>
  // Animate timetable block on scroll
  window.addEventListener('scroll', function () {
    const timetable = document.querySelector('.tm');
    if (!timetable) return;
    const rect = timetable.getBoundingClientRect();
    const screenHeight = window.innerHeight;

    if (rect.top < screenHeight - 100) {
      timetable.classList.add('animate-timetable');
    }
  });

  // Image click swap
  document.querySelectorAll('.image-hover').forEach(el => {
    el.addEventListener('click', () => {
      el.classList.toggle('active');
    });
  });

  // Typewriter animation
  const textArray = ["Logic with Dilshan Uthpala", "Island wide Online", "Wins-Veyangoda", "OASIS-Nittambuwa"];
  let index = 0;
  let charIndex = 0;
  let currentText = "";
  let isDeleting = false;
  const typingSpeed = 100;
  const erasingSpeed = 50;
  const delayBetweenTexts = 1500;

  function typeLoop() {
    const typedText = document.getElementById("typed-text");
    if (!typedText) return;

    if (!isDeleting) {
      currentText = textArray[index].substring(0, charIndex + 1);
      typedText.textContent = currentText;
      charIndex++;
      if (charIndex === textArray[index].length) {
        isDeleting = true;
        setTimeout(typeLoop, delayBetweenTexts);
      } else {
        setTimeout(typeLoop, typingSpeed);
      }
    } else {
      currentText = textArray[index].substring(0, charIndex - 1);
      typedText.textContent = currentText;
      charIndex--;
      if (charIndex === 0) {
        isDeleting = false;
        index = (index + 1) % textArray.length;
        setTimeout(typeLoop, typingSpeed);
      } else {
        setTimeout(typeLoop, erasingSpeed);
      }
    }
  }

  document.addEventListener("DOMContentLoaded", typeLoop);

  // Navbar show/hide on scroll
let lastScrollTop = 0;
const title = document.getElementById("title");
const menubar = document.getElementById("menubar");
const slideshow = document.getElementById("slideshow");

function adjustLayout() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const titleHeight = title.offsetHeight;
  const menubarHeight = menubar.offsetHeight;

  if (scrollTop > lastScrollTop) {
    // Scrolling down → hide title
    title.style.top = `-${titleHeight}px`;
    menubar.style.top = "0";
    slideshow.style.marginTop = `${menubarHeight}px`;
  } else {
    // Scrolling up → show title
    title.style.top = "0";
    menubar.style.top = `${titleHeight}px`;
    slideshow.style.marginTop = `${titleHeight + menubarHeight}px`;
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
}

// Initialize layout on load and resize
function initLayout() {
  const titleHeight = title.offsetHeight;
  const menubarHeight = menubar.offsetHeight;
  menubar.style.top = `${titleHeight}px`;
  slideshow.style.marginTop = `${titleHeight + menubarHeight}px`;
}

window.addEventListener("scroll", adjustLayout);
window.addEventListener("resize", initLayout);
document.addEventListener("DOMContentLoaded", initLayout);




  // Toggle mobile menu
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

  // Session handling
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
