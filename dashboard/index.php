<?php
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  Page::forceLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VINIYUK - Dashboard</title>
  <?php
    include_css('../assets/css/main.css');
    include_css('../assets/css/nav.css');
    include_css('../assets/css/dashboard.css');
  ?>
  <!-- <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <nav>
    <div class="container">
      <img src="../assets/img/white_viniyuk_name.svg" class="logo">
      <i class="fas fa-bars" id="menu-bar"></i>
      <div class="menu">
        <a href="index.php" class="active">ទំព័រដើម</a>
        <a href="profile.php">ព័ត៌មានផ្ទាល់ខ្លួន</a>
        <a href="../logout.php">ចាកចេញ</a>
      </div>
    </div>
  </nav>

  <div class="artworks container">
    
  </div>

  <?php
    include_javascript('../assets/js/nav.js');
    include_javascript('../assets/js/dashboard.js');
  ?>
  <!-- <script src="../assets/js/nav.js"></script>
  <script src="../assets/js/dashboard.js"></script>-->
</body>
</html>