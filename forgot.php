<?php 
  define('__CONFIG__', true);
  require_once 'inc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VINIYUK - Forgot Password</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/forgot.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <i class="fas fa-user-lock"></i>
  <h2​ class="title">ប្ដូរលេខកូដសម្ងាត់សារជាថ្មី</h2​>
  <div class="container">
    <p>បញ្ចូលអ៊ីមែលរបស់អ្នក ខាងយើងនឹងធ្វើការផ្ញើរតំណរភ្ជាប់សម្រាប់ការប្ដូរលេខកូដសម្ងាត់សារជាថ្មី</p>
    <form class="forgot">
      <input type="email" id="email" placeholder="បញ្ចូលអ៊ីមែលរបស់អ្នកនៅទីនេះ">
      <div class="error"></div>
      <button type="submit">ប្ដូរលេខកូដសម្ងាត់សារជាថ្មី</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="assets/js/forgot.js"></script>
</body>
</html>