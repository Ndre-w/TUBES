
<?php
session_start();

if (isset($_SESSION['level'])==1 && isset($_SESSION['level'])==2) {
  header("Location: ../error.php");
  exit();
}

// Sesuaikan dengan informasi koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contoh_db";

// Buat koneksi ke database
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data pengguna dan tim pengontrol dari database
$query = "SELECT * FROM pengguna WHERE level IN (1, 2)"; // Menampilkan pengguna dan tim pengontrol
$result = $koneksi->query($query);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hi Admin</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="../image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

      <style>
        .mx-auto { width:800px }
        .card {margin-top:50px; margin-bottom:30px}

        .button {
          background-color: #ffffff00;
          color: black;
          width: 8.5em;
          height: 2.9em;
          border: #3654ff 0.2em solid;
          border-radius: 11px;
          text-align: right;
          transition: all 0.6s ease;
        }

        .button:hover {
          background-color: #3654ff;
          cursor: pointer;
        }

        .button svg {
          width: 1.6em;
          margin: -0.2em 0.8em 1em;
          position: absolute;
          display: flex;
          transition: all 0.6s ease;
        }

        .button:hover svg {
          transform: translateX(5px);
        }

        .text {
          margin: 0 1.5em
        }
        .btnn {
          position: relative;
          padding: 10px 20px;
          border-radius: 7px;
          border: 1px solid rgb(61, 106, 255);
          font-size: 14px;
          text-transform: uppercase;
          font-weight: 600;
          letter-spacing: 2px;
          background: transparent;
          color: black;
          overflow: hidden;
          box-shadow: 0 0 0 0 transparent;
          -webkit-transition: all 0.2s ease-in;
          -moz-transition: all 0.2s ease-in;
          transition: all 0.2s ease-in;
        }

        .btnn:hover {
          background: rgb(61, 106, 255);
          box-shadow: 0 0 30px 5px rgba(0, 142, 236, 0.815);
          -webkit-transition: all 0.2s ease-out;
          -moz-transition: all 0.2s ease-out;
          transition: all 0.2s ease-out;
        }

        .btnn:hover::before {
          -webkit-animation: sh02 0.5s 0s linear;
          -moz-animation: sh02 0.5s 0s linear;
          animation: sh02 0.5s 0s linear;
        }

        .btnn::before {
          content: '';
          display: block;
          width: 0px;
          height: 86%;
          position: absolute;
          top: 7%;
          left: 0%;
          opacity: 0;
          background: #fff;
          box-shadow: 0 0 50px 30px #fff;
          -webkit-transform: skewX(-20deg);
          -moz-transform: skewX(-20deg);
          -ms-transform: skewX(-20deg);
          -o-transform: skewX(-20deg);
          transform: skewX(-20deg);
        }

        @keyframes sh02 {
          from {
            opacity: 0;
            left: 0%;
          }

          50% {
            opacity: 1;
          }

          to {
            opacity: 0;
            left: 100%;
          }
        }

        .btnn:active {
          box-shadow: 0 0 0 0 transparent;
          -webkit-transition: box-shadow 0.2s ease-in;
          -moz-transition: box-shadow 0.2s ease-in;
          transition: box-shadow 0.2s ease-in;
        }

    </style>


  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="#" class="logo">
        <img src="../assets/images/logo.svg" alt="Ridex logo">
      </a>

      <h1>Hi Admin.</h1>

      <div class="header-actions">

        <button class="btnn" onclick="goToLogOut()">
          LOGOUT
        </button>

        <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </div>

    </div>
  </header>





  <main>
  <div class="mx-auto">
  <div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Data Users</h5>
    <p class="card-text">Explore and manage user information effortlessly. This section provides a comprehensive view of all users
        registered in the system, allowing seamless control and monitoring of each account.</p>
        <div class="d-flex justify-content-center">
        <button class="button" onclick="goToDataUser()">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
          </svg>
          <div class="text">Users</div>
        </button>
      </div>
  </div>
</div>
</div>
<div class="mx-auto">
  <div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Data Control</h5>
    <p class="card-text">Manage administrative controls and settings efficiently. This section provides access to critical controls
        and configurations, ensuring the smooth operation and security of the system. Stay in command with Data Control.</p>
        <div class="d-flex justify-content-center">
        <button class="button">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
          </svg>
          <div class="text">Control</div>
        </button>
      </div>

    </button>
  </div>
</div>
</div>
</main>

  <script>
  function goToDataUser() {
    window.location.href = 'datauser.php';
  }
  function goToLogOut() {
    window.location.href = '../loginreg/logout.php';
  }
</script>
</body>

</html>


