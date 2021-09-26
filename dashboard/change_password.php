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
  <title>VINIYUK - Profile</title>
  <?php
    include_css('../assets/css/main.css');
    include_css('../assets/css/nav.css');
    include_css('../assets/css/change_password.css');
  ?>
  <link rel="stylesheet" href="../assets/css/cropper.min.css">
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

  <div class="container change-password">
    <h1>ផ្លាស់ប្ដូរលេខកូដសម្ងាត់</h1>
    <form class="change">
      <div class="password-container">
        <input type="password" placeholder="លេខកូដសម្ងាត់ចាស់" id="old-pwd">
        <i class="fas fa-eye"></i>
      </div>
      <div class="password-container">
        <input type="password" placeholder="លេខកូដសម្ងាត់ថ្មី" id="new-pwd">
        <i class="fas fa-eye"></i>
      </div>
      <div class="password-container">
        <input type="password" placeholder="ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់ថ្មី" id="verify-pwd">
        <i class="fas fa-eye"></i>
      </div>
      <ul class="error">
        
      </ul>
      <div>
        <a class="btn" href="profile.php">មិនមានការផ្លាស់ប្ដូរ</a>
        <button class="btn" type="submit">ផ្លាស់ប្ដូរ</button>
      </div>
    </form>
  </div>

  <div id="cropperModal" class="modal">
    <div class="modal-content">
      <h2>កាត់រូបភាព</h2>
      <i class="fas fa-times closeBtn"></i>
      <div style="position: relative; width: 100%; margin: 15px 0;">
        <img src="" id="preImg">
      </div>
      <button class="cropBtn">យល់ព្រមកាត់</button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="../assets/js/cropper.min.js"></script>

  <?php
    include_javascript('../assets/js/nav.js');
    include_javascript('../assets/js/change_password.js');
  ?>
  <!-- <script src="../assets/js/nav.js"></script>
  <script src="../assets/js/dashboard.js"></script>-->
</body>
</html>