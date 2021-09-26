<?php

define('__CONFIG__', true);
require_once 'inc/config.php';

if(isset($_GET['vkey'])) {
  $con = DB::getConnection();

  $verify = $con->prepare("update users set verified = 1 where vkey = :vkey limit 1");
  $verify->bindParam(':vkey', $_GET['vkey'], PDO::PARAM_STR);
  $verify->execute();

  header('location: succeed.php?msg=គណនីរបស់បានផ្ទៀងផ្ទាត់រួចរាល់។ អ្នកអាចប្រើប្រាស់គណនីរបស់អ្នកបានចាប់ពីពេលនេះទៅ។ អ្នកអាចចូលទៅកាន់គណនីតាមរយះប៊ូតុងខាងក្រោម។');
} else {
  header('location: index.php');
}

exit();