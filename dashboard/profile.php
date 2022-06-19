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
  <meta name="format-detection" content="telephone=no">
  <title>VINIYUK - Profile</title>
  <?php
    // For Production
    // include_css('../assets/css/main.css');
    // include_css('../assets/css/nav.css');
    // include_css('../assets/css/profile.css');
  ?>
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="../assets/css/profile.css">
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
    <div class="profile-container">
      <div class="part part1">
        <div class="profile-img" style=" background-image: url(
          <?php
            if($user['profile_img'] == '') echo '../assets/img/user.svg';
            else echo 'data:image/png;base64,'.base64_encode( $user['profile_img'] );
          ?>
        );"></div>
        <div class="value"><?php echo $user['username']; ?></div>
      </div>
      <div class="part part2">
        <ul>
          <li><label>អ៊ីម៉ែល</label>: <span class="value"><?php echo $user['email']; ?></span></li>
          <li><label>នាម</label>: <span class="value"><?php echo $user['fname_kh']; ?></span></li>
          <li><label>គោត្តនាម</label>: <span class="value"><?php echo $user['lname_kh']; ?></span></li>
          <li><label>First Name</label>: <span class="value"><?php echo $user['fname_en']; ?></span></li>
          <li><label>Last Name</label>: <span class="value"><?php echo $user['lname_en']; ?></span></li>
          <li><label>លេខទូរស័ព្ទទី១</label>: <span class="value"><?php echo $user['phone1']; ?></span></li>
          <li><label>លេខទូរស័ព្ទទី២</label>: <span class="value"><?php echo $user['phone2']; ?></span></li>
          <li><label>តំណភ្ចាប់ Telegram</label>: <span class="value"><?php echo $user['telegram_link']; ?></span></li>
          <li><label>Telegram ID</label>: <span class="value"><?php echo $user['telegram_id']; ?></span></li>
          <li>
            <button class="btn"><a href="change_info.php">ផ្លាស់ប្ដូរព័ត៌មាន</a></button>
            <button class="btn"><a href="change_password.php">ផ្លាស់ប្ដូរលេខកូដសម្ងាត់</a></button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <?php
    // For Production
    // include_javascript('../assets/js/nav.js');
  ?>
  <script src="../assets/js/nav.js"></script>
  <script>
    const values = document.querySelectorAll('.value')

    values.forEach(value => {
      if(!value.innerText.trim()) value.innerText = 'មិនមាន'
    })
  </script>
</body>
</html>