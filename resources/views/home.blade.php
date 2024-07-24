<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <title>Home — Writeen</title>
    <style>
      /* Style untuk pop-out card */
      .login-card-container {
        display: none; /* Awalnya disembunyikan */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 1000;
      }

      .login-card {
        width: 300px;
        background-color: #FEFBE8; /* Background color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 50px;
        border-radius: 25px; /* Rounded corners */
      }

      .login-card-container.active {
        display: block;
      }

      .login-card h2 {
        margin-top: 0;
        text-align: center;
      }

      .login-card form {
        display: flex;
        flex-direction: column;
      }

      .login-card label {
        margin: 10px 0 5px;
        font-weight: bold;
      }

      .login-card input[type="text"],
      .login-card input[type="email"],
      .login-card input[type="password"] {
        padding: 16px 20px;
        border: 1px solid #ccc;
        border-radius: 100px;
        font-size: 14px;
      }

      .login-card input[type="text"]:focus,
      .login-card input[type="email"]:focus,
      .login-card input[type="password"]:focus {
        outline: none;
        border-color: #ffbf23; /* Focus color */
      }

      .password-container {
        position: relative;
      }

      .password-container input {
        width: 100%;
        box-sizing: border-box;
      }

      .password-container .toggle-password {
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        cursor: pointer;
      }

      .login-card a {
        text-align: right;
        font-size: 14px;
        color: #000;
        text-decoration: none;
        margin: 10px 0;
      }

      .login-card button {
        padding: 12px;
        background-color: #FDC412; /* Button color */
        color: black;
        border: none;
        border-radius: 15px;
        font-size: 20px;
        cursor: pointer;
        margin-top: 28px;
      }
      
      .login-card button:hover {
        background-color: #e1ad0f; /* Button color */
      }

      .login-card p {
        text-align: center;
        font-size: 14px;
        margin-top: 10px;
      }

      .login-card p a {
        font-weight: bold;
        color: #000;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
      }

      .overlay.active {
        display: block;
      }

      /* Efek blur */
      .content.blur {
        filter: blur(5px);
        transition: filter 0.3s;
        will-change: filter; /* Mencegah perubahan tata letak */
      }

      .content.blur .home-header {
        margin-top: 0;
        padding-top: 294px;
      }

      /* Keyframes for bounce to bottom */
      @keyframes bounceInUp {
        0%,
        60%,
        75%,
        90%,
        100% {
          transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        0% {
          opacity: 0;
          transform: translate3d(0, 3000px, 0);
        }
        60% {
          opacity: 1;
          transform: translate3d(0, -20px, 0);
        }
        75% {
          transform: translate3d(0, 10px, 0);
        }
        90% {
          transform: translate3d(0, -5px, 0);
        }
        100% {
          transform: translate3d(0, 0, 0);
        }
      }

      /* Applying animation to the login card */
      .animated-bounce {
        animation: bounceInUp 1s;
      }
    </style>
  </head>
  <body>
    <!-- Pop-out login card -->
    <div class="overlay" id="overlay"></div>
    <div class="login-card-container" id="loginCardContainer">
      <img
        src="img/icons/written_logo.png"
        height="100"
        style="margin-bottom: 1rem"
        alt="Company Logo"
        class="company-logo animated-bounce"
      />
      <!-- Tambahkan logo perusahaan di sini -->
      <div class="login-card animated-bounce" id="loginCard">
        <form action="{{ route('login-user') }}" method="post">
          @csrf
          <label for="email" style="text-align: left">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
            required
          />
          <label for="password" style="text-align: left">Password</label>
          <div class="password-container">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
            />
            <i class="far fa-eye toggle-password"></i>
          </div>
          <button type="submit" style="border: 1px solid black">Login</button>
        </form>
        <p id="register">Don't have account yet? <a href="#">Register</a></p>
      </div>
    </div>

    <div class="login-card-container" id="registerCardContainer">
      <img
        src="img/icons/written_logo.png"
        height="100"
        style="margin-bottom: 1rem"
        alt="Company Logo"
        class="company-logo animated-bounce"
      />
      <!-- Tambahkan logo perusahaan di sini -->
      <div class="login-card animated-bounce" id="loginCard">
        <form action="{{ route('register-user') }}" method="post">
          @if (Session::has('success'))
              <script>alert({{ Session::get('success') }})</script>
          @endif
          @if (Session::has('fail'))
              <script>alert({{ Session::get('fail') }})</script>
          @endif
          @csrf
          <label for="name" style="text-align: left">Full Name</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your full name"
            required
          />
          <label for="email_register" style="text-align: left">Email</label>
          <input
            type="email"
            id="email_register"
            name="email_register"
            placeholder="Enter your email"
            required
          />
          <label for="password_register" style="text-align: left">Password</label>
          <div class="password-container">
            <input
              type="password"
              id="password_register"
              name="password_register"
              placeholder="Enter your password"
              required
            />
            <i class="far fa-eye toggle-password"></i>
          </div>
          <button type="submit" style="border: 1px solid black">Register</button>
          <p id="login2">Already have an account? <a href="#">Login</a></p>
        </form>
      </div>
    </div>

    <div class="content">
      <!-- Top Navigation Bar -->
      <nav class="top-navbar">
        <a href="index.html">
          <img src="img/logo.png" alt="logo" class="top-navbar-logo" />
        </a>
        <ul class="top-navbar-link-container">
          <li><a href="/index" class="link-active">Home</a></li>
          <li><a href="/about">About</a></li>
          <li><a href="/faq">FAQ</a></li>
          <li><a href="/pricing">Pricing Plans</a></li>
          <li>
            <a href="#" id="login"
              ><img src="img/icons/icon_user.png" alt=""
            /></a>
          </li>
        </ul>
      </nav>

      <!-- Header -->
      <header class="home-header">
        <h1 class="home-header-title">
          <div class="blue-circle-1"></div>
          <div class="blue-circle-2"></div>
          <div class="yellow-circle-1"></div>
          <div class="yellow-circle-2"></div>
          Semua Orang Bisa Jago Nulis<br />Dengan Media Yang tepat.
        </h1>
      </header>

      <!-- Main -->
      <main>
        <!-- Why Us -->
        <div class="whyus">
          <img src="img/graphic_1.png" alt="graphic" />
          <div class="whyus-content">
            <h2 class="whyus-title">Why Us?</h2>
            <p class="whyus-desc">
              You must start learning to write with Writeen now. Embark on this
              exciting journey of words today!
            </p>
            <ul class="whyus-list-container">
              <li class="whyus-list-item">
                <img src="img/icons/Frame.png" alt="icon" />
                <p>Creative Learning</p>
              </li>
              <li class="whyus-list-item">
                <img src="img/icons/Group.png" alt="icon" />
                <p>Easy To Use Modul</p>
              </li>
              <li class="whyus-list-item">
                <img src="img/icons/Frame-1.png" alt="icon" />
                <p>Inkubator Hasil Karya</p>
              </li>
            </ul>
          </div>
        </div>

        <!-- Our Selling -->
        <div class="ourselling">
          <h2 class="ourselling-title">
            Meningkatkan peluang karier<br />dengan Kelas Intermediate.
          </h2>
          <p class="ourselling-desc">
            Kelas Intermediate di Writeen dirancang untukmu yang ingin
            mengembangkan kemampuan menulismu untuk menunjang karir profesional.
            Kelas ini akan mengajarkanmu teknik menulis profesional, seperti
            copywriting, content writing, dan essay writing.
          </p>
          <div class="ourselling-card-container">
            <div class="ourselling-card">
              <img
                src="img/selling_1.jpg"
                alt="selling image"
                class="ourselling-card-image"
              />
              <h3 class="ourselling-card-title">
                Cara Cerdas Menulis Script Konten
              </h3>
              <p class="ourselling-card-desc">
                Zaman konten kreator untuk bersinar sangat besar, tapi kamu
                masih bingung cara nulis script untuk membuat konten yang
                berkualitas? Series ini untuk kamu!
              </p>
            </div>
            <div class="ourselling-card">
              <img
                src="img/selling_2.jpg"
                alt="selling image"
                class="ourselling-card-image"
              />
              <h3 class="ourselling-card-title">
                Cara Cerdas Menulis Script Konten
              </h3>
              <p class="ourselling-card-desc">
                Zaman konten kreator untuk bersinar sangat besar, tapi kamu
                masih bingung cara nulis script untuk membuat konten yang
                berkualitas? Series ini untuk kamu!
              </p>
            </div>
            <div class="ourselling-card">
              <img
                src="img/selling_3.jpg"
                alt="selling image"
                class="ourselling-card-image"
              />
              <h3 class="ourselling-card-title">
                Cara Cerdas Menulis Script Konten
              </h3>
              <p class="ourselling-card-desc">
                Zaman konten kreator untuk bersinar sangat besar, tapi kamu
                masih bingung cara nulis script untuk membuat konten yang
                berkualitas? Series ini untuk kamu!
              </p>
            </div>
            <div class="ourselling-card">
              <img
                src="img/selling_4.jpg"
                alt="selling image"
                class="ourselling-card-image"
              />
              <h3 class="ourselling-card-title">
                Cara Cerdas Menulis Script Konten
              </h3>
              <p class="ourselling-card-desc">
                Zaman konten kreator untuk bersinar sangat besar, tapi kamu
                masih bingung cara nulis script untuk membuat konten yang
                berkualitas? Series ini untuk kamu!
              </p>
            </div>
          </div>
        </div>

        <!-- Our Mentor -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1440 320"
          class="ourmentor-wave"
        >
          <path
            fill="#00C2CB"
            fill-opacity="1"
            d="M0,128L48,117.3C96,107,192,85,288,74.7C384,64,480,64,576,101.3C672,139,768,213,864,213.3C960,213,1056,139,1152,106.7C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
          ></path>
        </svg>
        <div class="ourmentor">
          <h2 class="ourmentor-title">
            Mulai Perjalanan Professional Kamu<br />Bersama Tutor Expert!
          </h2>
          <p class="ourmentor-desc">
            Sudah belajar dari Basic tapi masih perlu bimbingan advanced? Don't
            Worry, Zenteen! Writeen sudah bekerjasama dengan tutor expert
            dibidangnya yang dapat membantu meningkatkan karir professional kamu
            meningkat!
          </p>
          <div class="ourmentor-banner-container">
            <img
              src="img/ourmentor_1.png"
              alt="banner our mentor"
              class="ourmentor-banner ourmentor-banner-front"
            />
            <img
              src="img/ourmentor_2.png"
              alt="banner our mentor"
              class="ourmentor-banner ourmentor-banner-right"
            />
            <img
              src="img/ourmentor_3.png"
              alt="banner our mentor"
              class="ourmentor-banner ourmentor-banner-bottom"
            />
            <img
              src="img/ourmentor_4.png"
              alt="banner our mentor"
              class="ourmentor-banner ourmentor-banner-left"
            />
          </div>
        </div>

        <!-- Testimoni -->
        <div class="testimoni">
          <h2 class="testimoni-title">Kata Mereka Tentang Writeen?</h2>
          <div class="testimoni-card-container">
            <div class="testimoni-card">
              <div class="testimoni-card-header">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
              </div>
              <p class="testimoni-card-desc">
                "Websitenya bagus bangettt, gampang diakses, tampilannya
                menarik, dan ada kelas belajar menulis gratisnya jadi bisa
                belajar menyenai penulisan tanpa biaya, Makasih Writeen"
              </p>
              <div class="testimoni-card-footer">
                <img
                  src="img/flower_1.svg"
                  alt="flower illustration"
                />
                <p class="testimoni-card-person">Indah Kusuma</p>
                <p class="testimoni-card-person-position">Freelancer</p>
              </div>
            </div>
            <div class="testimoni-card">
              <div class="testimoni-card-header">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
              </div>
              <p class="testimoni-card-desc">
                "jujur materi belajarnya bagus banget, emang bener-bener
                diajarin dari pondasi belajar nulis dan ada mentor yang beneran
                berpengalaman juga buat belajar, joss banget pokoknya. sukses
                selalu writeen"
              </p>
              <div class="testimoni-card-footer">
                <img
                  src="img/flower_2.svg"
                  alt="flower illustration"
                />
                <p class="testimoni-card-person">Istna Ainatul</p>
                <p class="testimoni-card-person-position">Mahasiswi</p>
              </div>
            </div>
            <div class="testimoni-card">
              <div class="testimoni-card-header">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
              </div>
              <p class="testimoni-card-desc">
                "dari dulu emang udah nyari banget e-course yang ngajarin nulis
                buat ngajarin jadi penulis, eh ga sengaja liat writeen dari
                Tiktok dan tertarik buat cek websitenya dan beneran membantu
                banget. good job writeen"
              </p>
              <div class="testimoni-card-footer">
                <img
                  src="img/flower_3.svg"
                  alt="flower illustration"
                />
                <p class="testimoni-card-person">Nadia Putri</p>
                <p class="testimoni-card-person-position">Creator</p>
              </div>
            </div>
          </div>
        </div>
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
    </div>
  </body>
  <script>
    const loginButton = document.getElementById("login");
    const loginButton2 = document.getElementById("login2");
    const loginCard = document.getElementById("loginCardContainer");
    loginButton
      .addEventListener("click", function (event) {
        event.preventDefault();
        registerCard.classList.remove("active");
        loginCard.classList.add("active");
        document.getElementById("overlay").classList.add("active");
        document.querySelector(".content").classList.add("blur");
      });
    loginButton2
      .addEventListener("click", function (event) {
        event.preventDefault();
        registerCard.classList.remove("active");
        loginCard.classList.add("active");
        document.getElementById("overlay").classList.add("active");
        document.querySelector(".content").classList.add("blur");
      });

    const registerButton = document.getElementById("register");
    const registerCard = document.getElementById("registerCardContainer");
    registerButton
      .addEventListener("click", function (event) {
        event.preventDefault();
        loginCard.classList.remove("active");
        registerCard.classList.add("active");
        document.getElementById("overlay").classList.add("active");
        document.querySelector(".content").classList.add("blur");
      });

    document.getElementById("overlay").addEventListener("click", function () {
      loginCard.classList.remove("active");
      registerCard.classList.remove("active");
      document.getElementById("overlay").classList.remove("active");
      document.querySelector(".content").classList.remove("blur");
    });

    document
      .querySelector(".toggle-password")
      .addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const type =
          passwordInput.getAttribute("type") === "password"
            ? "text"
            : "password";
        passwordInput.setAttribute("type", type);
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
      });
  </script>
</html>
