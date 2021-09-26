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
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container">
    <div class="image">
      <img src="assets/img/viniyuk_logo.svg" alt="logo" class="logo">
    </div>
    <div class="register-container">
      <h1>ចុះឈ្មោះគណនី</h1>
      <form class="register">
        <div class="input-container">
          <input type="text" placeholder="ឈ្មោះអ្នកប្រើប្រាស់" id="username" autocomplete="disable">
          <input type="email" placeholder="អ៊ីម៉ែល" id="email" autocomplete="disable">
          <input type="text" placeholder="នាម" id="fname-kh" autocomplete="disable">
          <input type="text" placeholder="គោត្តនាម" id="lname-kh" autocomplete="disable">
          <input type="text" placeholder="First Name" id="fname-en" autocomplete="disable">
          <input type="text" placeholder="Last Name" id="lname-en" autocomplete="disable">
          <input type="text" placeholder="លេខទូរស័ព្ទទី១" id="phone1" autocomplete="disable">
          <input type="text" placeholder="លេខទូរស័ព្ទទី២" id="phone2" autocomplete="disable">
          <div class="password-container" autocomplete="disable">
            <input type="password" placeholder="លេខកូដសម្ងាត់" id="password1" autocomplete="disable">
            <i class="fas fa-eye" autocomplete="disable"></i>
          </div>
          <div class="password-container" autocomplete="disable">
            <input type="password" placeholder="ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់" id="password2" autocomplete="disable">
            <i class="fas fa-eye" autocomplete="disable"></i>
          </div>
          <input type="text" placeholder="តំណភ្ជាប់ Telegram" id="telegram-link" autocomplete="disable">
        </div>
        <ul class="error" autocomplete="disable">
          
        </ul>
        <button type="submit">បង្កើតគណនី</button>
      </form>
      <div class="has-account">មានគណនីរួចហើយ? <a href="index.php">ចូលទៅកាន់គណនី</a></div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="assets/js/register.js"></script>
</body>
</html>