<?php 
  define('__CONFIG__', true);
  require_once 'inc/config.php';

  Page::forceDashboard();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="mobile-wep-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="viniyuk">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="manifest" href="manifest.json">
  <link rel="stylesheet" href="add_to_homescreen/style/addtohomescreen.css">
</head>
<body>
  <div class="container">
    <div class="image"></div>
    <div class="login-container">
      <div class="login-elements">
        <img src="assets/img/viniyuk.svg" alt="logo" class="logo">
        <h1>ចូលទៅកាន់គណនី</h1>
        <form class="login">
          <input type="email" placeholder="អ៊ីម៉ែល" id="email">
          <div class="password-container">
            <input type="password" placeholder="លេខកូដសម្ងាត់" id="password">
            <i class="fas fa-eye"></i>
          </div>
          <div class="optional">
            <div class="remember">
              <input type="checkbox" id="remember">
              <label for="remember"><i class="fas fa-check-square"></i> ចងចាំ</label>
            </div>
            <a href="forgot.php" class="forget">ភ្លេចលេខសម្ងាត់?</a>
          </div>
          <ul class="error">

          </ul>
          <button type="submit">ចូលគណនី</button>
        </form>
        <div class="no-account">មិនទាន់មានគណនី? <a href="register.php">បង្កើតគណនីថ្មី</a></div>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="assets/js/index.js"></script>
  <script>
    if ('serviceWorker' in navigator) {
	  window.addEventListener('load', function() {
	    navigator.serviceWorker.register('sw.js').then(function(registration) {
	      // Registration was successful
	      console.log('ServiceWorker registration successful with scope: ', registration.scope);
	    }, function(err) {
	      // registration failed :(
	      console.log('ServiceWorker registration failed: ', err);
	    });
	  });
	}
  </script>
  <script src="add_to_homescreen/src/addtohomescreen.js"></script>
  <script>
    // if the website is not opened in app mode show (i.e. i browser) the add to homescreen prompt
    if (
      (('standalone' in window.navigator) && !window.navigator.standalone) // ios
      ||
      ( !window.matchMedia('(display-mode: standalone)').matches ) // android
    ) {
      addToHomescreen()
    }
  </script>
</body>
</html>