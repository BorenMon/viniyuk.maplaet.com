<?php
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  Page::forceLogin();

  if(isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
  } else if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
  } 

  $user = $con->prepare('select * from users where id = :id limit 1');
  $user->bindParam(':id', $id, PDO::PARAM_STR);
  $user->execute();
  $user = $user->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VINIYUK - Profile</title>
  <?php
    // For Production
    // include_css('../assets/css/main.css');
    // include_css('../assets/css/nav.css');
    // include_css('../assets/css/change_info.css');
  ?>
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="../assets/css/change_info.css">

  <link rel="stylesheet" href="../assets/css/cropper.min.css">
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

  <div class="container">
  <div class="register-container">
      <h1>ផ្លាស់ប្ដូរព័ត៌មាន</h1>
      <div class="profile">
      <div class="profile-img" style=" background-image: url(
          <?php
            if($user['profile_img'] == '') echo '../assets/img/user.svg';
            else echo 'data:image/png;base64,'.base64_encode( $user['profile_img'] );
          ?>
        );"></div>
        <div class="input">
          <button class="btn" onclick="chooseImg()">ជ្រើសរើសរូប Profile</button>
          <div class="file-name"></div>
        </div>
        <input type="file" accept="image/*" id="upload">
      </div>
      <form class="change" method="POST" action="../ajax/change_info.php">
        <div class="input-container">
          <input type="text" placeholder="ឈ្មោះអ្នកប្រើប្រាស់" id="username" autocomplete="disable"​ value="<?php echo $user['username']; ?>">
          <input type="text" placeholder="តំណភ្ជាប់ Telegram" id="telegram-link" autocomplete="disable"  value="<?php echo $user['telegram_link']; ?>"​>
          <input type="text" placeholder="នាម" id="fname-kh" autocomplete="disable"  value="<?php echo $user['fname_kh']; ?>"​>
          <input type="text" placeholder="គោត្តនាម" id="lname-kh" autocomplete="disable"  value="<?php echo $user['lname_kh']; ?>"​>
          <input type="text" placeholder="First Name" id="fname-en" autocomplete="disable"  value="<?php echo $user['fname_en']; ?>"​>
          <input type="text" placeholder="Last Name" id="lname-en" autocomplete="disable"  value="<?php echo $user['lname_en']; ?>"​>
          <input type="text" placeholder="លេខទូរស័ព្ទទី១" id="phone1" autocomplete="disable"  value="<?php echo $user['phone1']; ?>"​>
          <input type="text" placeholder="លេខទូរស័ព្ទទី២" id="phone2" autocomplete="disable"  value="<?php echo $user['phone2']; ?>"​>
          <input type="text" placeholder="Telegram ID" id="telegram-id" autocomplete="disable"  value="<?php echo $user['telegram_id']; ?>">
        </div>
        <ul class="error">
          
        </ul>
        <div>
          <a class="btn" href="profile.php">មិនមានការផ្លាស់ប្ដូរ</a>
          <button class="btn" type="submit">ផ្លាស់ប្ដូរ</button>
        </div>
      </form>
    </div>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../assets/js/cropper.min.js"></script>

  <?php
    include_javascript('../assets/js/nav.js');
    include_javascript('../assets/js/change_info.js');
  ?>
  <!-- <script src="../assets/js/nav.js"></script>
  <script src="../assets/js/dashboard.js"></script>-->
</body>
</html>