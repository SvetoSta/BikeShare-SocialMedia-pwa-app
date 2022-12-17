<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>PikaBike</title>
  <meta name="author" content="Viktor Kalinkov">
  <meta name="description" content="Safe way to travel with your bike!">
  <meta name="keywords" content="pwa,workshop,fontys,smart mobile">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js"></script>
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js">
  </script>
<script src="https://kit.fontawesome.com/ab0609896a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet"
    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
    type="text/css">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <!-- <link href="../assets/css/styleMainPage.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="../css/stylesheet.css" type="text/css">


</head>

<body>

  <body>

    <nav class="navbar navbar-expand-custom navbar-mainbg">
    <img src="https://i.ibb.co/Bt2WnJW/logo.png" class="img-fluid" style="width: 5%; max-width: 30%;" alt="">
      <a class="navbar-brand navbar-logo" href="dashboard.php">PikaBike</a>
      <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <div class="hori-selector">
            <div class="left"></div>
            <div class="right"></div>
          </div>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="map.php"><i class="fa-solid fa-map-pin"></i>Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="leaderboard.php"><i class="fa-solid fa-address-book"></i>Leaderboard</a>
          </li>

          <?php $user = new User(); 
          if ($user->isLoggedIn()) { ?>
          <li class="nav-item">
            <a class="nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><i class="fa-solid fa-user"></i>Profile
              <?php echo escape($user->data()->name); ?></a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
          </li>
          <?php }
          else { ?>
          <li class="nav-item">
            <a class="nav-link" href="register.php"><i class="fa-solid fa-user-plus"></i>Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php"><i class="fa-solid fa-right-to-bracket"></i>Log In</a>
          </li>
          <?php } ?>

        </ul>
      </div>
    </nav>