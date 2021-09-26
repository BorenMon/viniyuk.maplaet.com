<?php 
  define('__CONFIG__', true);
  require_once 'inc/config.php';

  if(isset($_GET['ckey'])) {
    $ckey = $_GET['ckey'];

    $findUser = $con->prepare("select email from users where ckey = :ckey limit 1");
    $findUser->bindParam(':ckey', $ckey, PDO::PARAM_STR);
    $findUser->execute();

    if($findUser->rowCount()) {
      $email = ($findUser->fetch(PDO::FETCH_ASSOC))['email'];
    } else {
      die();
    }
  } else die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VINIYUK - Reset Password</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <i class="fas fa-key"></i>
  <h2​ class="title">បង្កើតលេខកូដសម្ងាត់សារជាថ្មី</h2​>
  <div class="container">
    <p>អ្នកកំពុងបង្កើតលេខកូដសម្ងាត់សម្រាប់គណនីដែលមានអ៊ីម៉ែល <span id="email"><?php echo $email; ?></span> សារជាថ្មី</p>
    <form class="reset">
      <div>
      <input type="password" id="password" placeholder="លេខកូដសម្ងាត់">
      <i class="fas fa-eye"></i>
      </div>
      <div>
      <input type="password" id="password2" placeholder="ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់">
      <i class="fas fa-eye"></i>
      </div>
      <ul class="error"></ul>
      <button type="submit">ប្ដូរលេខកូដសម្ងាត់សារជាថ្មី</button>
    </form>
  </div>

   
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="assets/js/reset.js"></script>
</body>
</html>