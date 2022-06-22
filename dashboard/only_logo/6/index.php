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
  <title>VINIYUK</title>
</head>
<body>
 <?php include_once '../../template-nav.php' ?>

  <main class="container">
    <div class="design-preview">
      <div class="background"></div>
      <div class="gradient-overlay"></div>
      <div class="info">
        <div class="upper-info">
          <div class="type"></div>
          <div class="location"></div>
        </div>
        <div class="middle-info">
          <div class="price-tag">តម្លៃ</div>
          <div class="price"></div>
        </div>
        <div class="lower-info">
          <div class="contact"><i class="fas fa-phone-alt"></i><div class="phone"><span class="phone1"><?php echo $user["phone1"] ?></span> | <span class="phone2"><?php echo $user["phone2"] ?></span></div></div>
          <div class="slogan">ទិញដី ទិញផ្ទះ ទិញតាមវិនិយោគ!</div>
        </div>
      </div>

      <img src="../../../assets/img/viniyuk.svg" alt="" class="design-logo">
    </div>

    <div class="inputs">
      <input type="file" id="background" accept="image/*">
      <div class="buttons">
        <button onclick="download()">ទាញយក Poster</button>
        <button onclick="chooseImage()">ជ្រើសរើសរូបភាព</button>
        <button onclick="sendToTelegram()" style="width: 5rem; background-color: #2AABEE; <?php echo isset($user['telegram_id']) && !empty($user['telegram_id']) ? '' : 'opacity: 0.3; cursor: not-allowed;' ?>" <?php echo isset($user['telegram_id']) && !empty($user['telegram_id']) ? '' : 'disabled title="Update your telegram id in profile setting to enable this feature."' ?>><i class="fab fa-telegram-plane" style="color: white;"></i></button>
        <div class="file-name"></div>
      </div>
      <input type="text" placeholder="ប្រភេទ">
      <label for="type-font-size-percentage">Font Size Percentage (%)</label>
      <input type="number" min="0" value="100" id="type-font-size-percentage">
      <input type="text" placeholder="ទីតាំង">
      <input type="text" placeholder="តម្លៃ">
      <label for="price-font-size-percentage">Font Size Percentage (%)</label>
      <input type="number" min="0" value="100" id="price-font-size-percentage">
      <input type="text" placeholder="លេខទូរស័ព្ទទី១">
      <input type="text" placeholder="លេខទូរស័ព្ទទី២">
    </div>
  </main>

  <div style="position: relative;">
  <div class="design-preview" id="download">
  <div class="background"></div>
      <div class="gradient-overlay"></div>
      <div class="info">
        <div class="upper-info">
          <div class="type"></div>
          <div class="location"></div>
        </div>
        <div class="middle-info">
          <div class="price-tag">តម្លៃ</div>
          <div class="price"></div>
        </div>
        <div class="lower-info">
          <div class="contact"><i class="fas fa-phone-alt"></i><div class="phone"><span class="phone1"><?php echo $user["phone1"] ?></span> | <span class="phone2"><?php echo $user["phone2"] ?></span></div></div>
          <div class="slogan">ទិញដី ទិញផ្ទះ ទិញតាមវិនិយោគ!</div>
        </div>
      </div>
      
      <img src="../../../assets/img/viniyuk.svg" alt="" class="design-logo">
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