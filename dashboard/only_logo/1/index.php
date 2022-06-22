<?php
  define('__CONFIG__', true);
  require_once '../../../inc/config.php';

  if(!isset($_COOKIE['id']) && !isset($_SESSION['id'])) {
    header('location: ../../index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once '../../header.php' ?>
  <title>VINIYUK - Artwork 1 - All</title>
</head>
<body>
  <?php include_once '../../template-nav.php' ?>

  <div class="buttons container">
    <button onclick="upload()"><i class="fas fa-images"></i> បញ្ចូលរូបភាពចាប់ពីមួយឡើង</button>
    <input type="file" multiple accept="image/*" id="upload" style="display: none;">
    <button onclick="clearPoster()"><i class="fas fa-trash"></i>លុបរូបភាពទាំងអស់</button>
  </div>

  <main class="container">
    <div class="prePoster">
      <!-- <div class="poster-container">
        <div class="poster">
          <img src="logo.svg" alt="">
          <img src="" alt="">
        </div>
        <div class="button">
          <button>ទាញយករូបភាព</button>
        </div>
      </div> -->
    </div>

    <div style="
      position: absolute;
      top: 0;
      left: 0;
      z-index: -7;
    ">
      <div class="downloads">
        <!-- <div class="download d1">
          <img src="logo.svg" alt="">
          <img src="" alt="">
        </div> -->
      </div>

      <div style="
        position: absolute;
        top: 0;
        left: 0;
        background-color: #f5f5f5;
        width: 100%;
        height: 100%;
        z-index: 7;
      "></div>
    </div>
  </main>

  <?php include_once '../../footer.php' ?>
</body>
</html>