<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/admin.css" />
    <title>Dashboard - Written</title>
  </head>
  <body>
    <!-- Top Navigation Bar -->
    <nav class="top-navbar">
      <a href="/">
        <img src="img/logo.png" alt="logo" class="top-navbar-logo" />
      </a>
      <ul class="top-navbar-link-container">
        <li><a href="/">Home</a></li>
        <li><a href="about" class="link-active">About</a></li>
        <li><a href="faq">FAQ</a></li>
        <li><a href="pricing">Pricing Plans</a></li>
      </ul>
    </nav>

    <main class="admin-container">
        @yield('container')
    </main>

    <!-- Footer -->
    <footer class="footer">
      <p>Copyright © 2024 All Rights Reserved by Writeen Media.</p>
      <a
        href="https://www.instagram.com/writeen.id"
        target="_blank"
        class="footer-social-media"
      >
        <img
          src="img/instagram_logo_circle.png"
          alt="social media logo"
        />
      </a>
    </footer>
  </body>
</html>