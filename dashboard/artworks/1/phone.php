<?php
  define('__CONFIG__', true);
  require_once '../../../inc/config.php';

  if(!isset($_COOKIE['id']) && !isset($_SESSION['id'])) {
    header('location: ../../index.php');
    exit();
  }

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
  <?php include_once '../../header.php' ?>
  <title>VINIYUK - Artwork 1 - All</title>
</head>
<body>
  <nav>
    <div class="container">
      <a href="../../index.php">
        <img src="../../../assets/img/white_viniyuk_name.svg" class="logo">
      </a>
      <i class="fas fa-bars" id="menu-bar"></i>
      <div class="menu">
        <a href="../../index.php" class="active">ទំព័រដើម</a>
        <a href="profile.php">ព័ត៌មានផ្ទាល់ខ្លួន</a>
        <a href="../../../logout.php">ចាកចេញ</a>
      </div>
    </div>
  </nav>

  <main class="container">
    <div class="design-preview">
      <img src="" class="background">
      
      <img src="img/footer.svg" class="footer">
      <div class="contact">
        <div class="phones">
          <div class="phone1"><?php echo $user["phone1"] ?></div>
          <div class="phone2"><?php echo $user["phone2"] ?></div>
        </div>
        <div class="qr"></div>
      </div>

    </div>

    <div class="inputs">
      <input type="file" id="background" accept="image/*">
      <div​ class="buttons">
        <button onclick="download()">ទាញយក Poster</button>
        <button onclick="chooseImage()">ជ្រើសរើសរូបភាព</button>
        <div class="file-name"></div>
      </div​>
      <input type="text" placeholder="ប្រភេទ" class="d-none">
      <input type="text" placeholder="តម្លៃ" class="d-none">
      <input type="text" placeholder="ទីតាំង" class="d-none">
      <input type="text" placeholder="លេខទូរស័ព្ទទី១">
      <input type="text" placeholder="លេខទូរស័ព្ទទី២">
      <input type="text" placeholder="តំណរភ្ចាប់ Telegram" value="<?php echo $user["telegram_link"] ?>" id="qrInput">
    </div>
  </main>

  <div style="position: relative;">
  <div class="design-preview" id="download">
      <img src="" class="background">
      
      <img src="img/footer.svg" class="footer">
      <div class="contact">
        <div class="phones">
          <div class="phone1"><?php echo $user["phone1"] ?></div>
          <div class="phone2"><?php echo $user["phone2"] ?></div>
        </div>
        <div class="qr"></div>
      </div>
    </div>

    <div class="overlay"></div>
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

  <?php include_once '../../footer.php' ?>
</body>
</html>