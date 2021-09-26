<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_COOKIE['id'])) {
      $id = $_COOKIE['id'];
    } else if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
    } 

    $return = [];

    $old_pwd = $_POST['old_pwd'];

    $get_pwd = $con->prepare('select password from users where id = :id');
    $get_pwd->bindParam(':id', $id, PDO::PARAM_STR);
    $get_pwd->execute();
    $pwd = $get_pwd->fetch(PDO::FETCH_ASSOC);
    $hash = $pwd['password'];

    if(password_verify($old_pwd, $hash)) {
      $new_pwd = password_hash($_POST['new_pwd'], PASSWORD_DEFAULT);
      $change_pwd = $con->prepare('update users set password = :new_pwd where id = :id');
      $change_pwd->bindParam(':new_pwd', $new_pwd, PDO::PARAM_STR);
      $change_pwd->bindParam(':id', $id, PDO::PARAM_STR);
      $change_pwd->execute();
      $return['redirect'] = 'profile.php';
    } else {
      $return['error'] = 'លេខកូដសម្ងាត់ចាស់មិនត្រឹមត្រូវ!';
    }

    // Return the proper information back to JavaScript to redirect us.

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit('You can not access this page!');
  }
?>