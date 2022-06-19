<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if(isset($_POST)) {

    if(isset($_COOKIE['id'])) {
      $id = $_COOKIE['id'];
    } else if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
    } 

    $username = Filter::String($_POST['username']);
    $fname_kh = Filter::String($_POST['fname_kh']);
    $lname_kh = Filter::String($_POST['lname_kh']);
    $fname_en = Filter::String($_POST['fname_en']);
    $lname_en = Filter::String($_POST['lname_en']);
    $phone1 = Filter::String($_POST['phone1']);
    $phone2 = Filter::String($_POST['phone2']);
    $telegram_link = Filter::String($_POST['telegram_link']);
    $telegram_id = Filter::String($_POST['telegram_id']);

    $updateInfo = $con->prepare('update users set username = :username, fname_kh = :fname_kh, lname_kh = :lname_kh, fname_en = :fname_en, lname_en = :lname_en, phone1 = :phone1, phone2 = :phone2, telegram_link = :telegram_link, telegram_id = :telegram_id where id = :id');
    $updateInfo->bindParam(':username', $username, PDO::PARAM_STR);
    $updateInfo->bindParam(':fname_kh', $fname_kh, PDO::PARAM_STR);
    $updateInfo->bindParam(':lname_kh', $lname_kh, PDO::PARAM_STR);
    $updateInfo->bindParam(':fname_en', $fname_en, PDO::PARAM_STR);
    $updateInfo->bindParam(':lname_en', $lname_en, PDO::PARAM_STR);
    $updateInfo->bindParam(':phone1', $phone1, PDO::PARAM_STR);
    $updateInfo->bindParam(':phone2', $phone2, PDO::PARAM_STR);
    $updateInfo->bindParam(':telegram_link', $telegram_link, PDO::PARAM_STR);
    $updateInfo->bindParam(':telegram_id', $telegram_id, PDO::PARAM_STR);
    $updateInfo->bindParam(':id', $id, PDO::PARAM_STR);
    $updateInfo->execute();

    if(isset($_FILES["profile_img"])) {

      $image = file_get_contents($_FILES['profile_img']['tmp_name']);

      $updateProfileImg = $con->prepare('update users set profile_img = :profile_img where id = :id');
      $updateProfileImg->bindParam(':profile_img', $image, PDO::PARAM_LOB);
      $updateProfileImg->bindParam(':id', $id, PDO::PARAM_STR);
      $updateProfileImg->execute();
    }

    echo 'profile.php';

  } else {
    exit('You can not access this page!');
  }


        // $getOldFileName = $con->prepare("select profile_img_name from users where id = :id");
      // $getOldFileName->bindParam(':id', $id, PDO::PARAM_STR);
      // $getOldFileName->execute();
      // $oldFile = $getOldFileName->fetch(PDO::FETCH_ASSOC);
      // $oldFileName = $oldFile["profile_img_name"];
      // unlink('../uploads/'.$oldFileName);

      // define('UPLOAD_DIR', '../uploads/');
      // $image_parts = explode(";base64,", $_POST['base64']);
      // $image_type_aux = explode("image/", $image_parts[0]);
      // $image_type = $image_type_aux[1];
      // $image_base64 = base64_decode($image_parts[1]);
      // $fileName = uniqid() . '.png';
      // $fileDestination = UPLOAD_DIR . $fileName;
      // file_put_contents($fileDestination, $image_base64);
?>

