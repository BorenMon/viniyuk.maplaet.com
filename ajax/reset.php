<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $return = [];

    $email = Filter::String($_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $update = $con->prepare("update users set password = :password where email = :email limit 1");
    $update->bindParam(':email', $email, PDO::PARAM_STR);
    $update->bindParam(':password', $password, PDO::PARAM_STR);
    $update->execute();

    $return['redirect'] = 'succeed.php?msg=ការបង្កើតលេខកូដសម្ងាត់សារជាថ្មីរបស់អ្នកបានជោគជ័យ ចាប់ពីពេលនេះអ្នកអាចចូលទៅកាន់​គណនីដោយប្រើលេខកូដសម្ងាត់ថ្មីបានហើយ។';

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit('You can not access this page!');
  }
?>