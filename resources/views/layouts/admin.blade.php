<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/admin.css" />
    <title>Dashboard - Written</title>
    <style>
        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 10px;
        }
    </style>
  </head>
  <body>
    <!-- Top Navigation Bar -->
    <nav class="top-navbar">
      <a href="/">
        <img src="img/logo.png" alt="logo" class="top-navbar-logo" />
      </a>
      <ul class="top-navbar-link-container">
        <li><a href="/">Home</a></li>
        <li><a href="/logout" class="logout-button">Logout</a></li>
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