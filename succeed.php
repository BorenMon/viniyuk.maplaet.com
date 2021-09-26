<?php

if(isset($_GET['msg'])) $msg = $_GET['msg'];
else die();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VINIYUK - Message</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-family: 'Krasar-Regular', 'Lato', sans-serif;
      height: 100vh;
      width: 100vw;
      padding: 155px;
      text-align: center;
    }
    i {
      font-size: 115px;
      color: #7C141F;
    }
    p {
      font-size: large;
      line-height: 40px;
    }
    button {
      border: none;
      background-color: #7C141F;
      padding: 0.5rem 2rem;
      font-family: inherit;
      font-size: large;
      border-radius: 15px;
    }
    button a {
      color: white;
      text-decoration: none;
    }
    button:active {
      transform: scale(0.98);
    }
    @media(max-width: 700px) {
      body {
        padding: 50px;
      }
    }
  </style>
</head>
<body>
  <i class="fas fa-check-circle"></i>
  <p><?php echo $msg; ?></p>
  <button><a href="index.php">ចូលទៅកាន់គណនី</a></button>
</body>
</html>