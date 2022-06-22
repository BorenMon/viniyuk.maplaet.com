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
<?php include_once '../../template-nav.php' ?>

  <main class="container">
    <div class="design-preview">
      <img src="" class="background">
      
      <img src="img/footer.svg" class="footer">
      <div class="contact">
        <div class="phones">
          <div class="phone1"><?php echo $user["phone1"] ?></div> | 
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
        <button onclick="sendToTelegram()" style="width: 5rem; background-color: #2AABEE; <?php echo isset($user['telegram_id']) && !empty($user['telegram_id']) ? '' : 'opacity: 0.3; cursor: not-allowed;' ?>" <?php echo isset($user['telegram_id']) && !empty($user['telegram_id']) ? '' : 'disabled title="Update your telegram id in profile setting to enable this feature."' ?>><i class="fab fa-telegram-plane" style="color: white;"></i></button>
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
          <div class="phone1"><?php echo $user["phone1"] ?></div> | 
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
  <script>
    // Send to Telegram
    const sendToTelegram = () => {
      domtoimage.toJpeg(document.getElementById('download'), {
        quality: 0.8
      }).then(dataUrl => {
      domtoimage
        .toJpeg(document.getElementById('download'), {
          quality: 0.8
        })
        .then(dataUrl => {
          new Compressor(dataURLtoFile(dataUrl), {
              quality : 0.8,
              maxHeight: 2000,
              maxWidth: 2000,
              success(result) {
                <?php
                  echo "var chat_id = '" . $user['telegram_id'] . "'\n";
                ?>
                var token = "5348766637:AAFS9CRCB1mtG3YirFj-OZV83IDR0LCCgC0"

                var formData = new FormData();
                formData.append('chat_id', chat_id)
                formData.append('document', result, 'poster.jpeg')

                var request = new XMLHttpRequest();
                request.open('POST', `https://api.telegram.org/bot${token}/sendDocument`)
                request.send(formData)
              }
            }
          )
        })
      })
    }
  </script>
</body>
</html>