<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // header('Content-Type: application/json');

    $return = [];

    $email = (string) Filter::String($_POST['email']);

    $username = Filter::String($_POST['username']);
    $fname_kh = Filter::String($_POST['fname_kh']);
    $lname_kh = Filter::String($_POST['lname_kh']);
    $fname_en = Filter::String($_POST['fname_en']);
    $lname_en = Filter::String($_POST['lname_en']);
    $phone1 = Filter::String($_POST['phone1']);
    $phone2 = Filter::String($_POST['phone2']);
    $telegram_link = Filter::String($_POST['telegram_link']);
    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $vkey = md5(time().$username);
    $to = $email;
    $message = "
      <a href='https://viniyuk.maplaet.com/verify.php?vkey=$vkey'>ផ្ទៀងផ្ទាត់អាស័យដ្ឋានអុីម៉ែល</a>
    ";

    // Make sure the user does not exist

    $findUser = $con->prepare('select verified from users where email = lower(:email) limit 1');
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();
    $user = $findUser->fetch(PDO::FETCH_ASSOC);

    if($findUser->rowCount() == 1 && $user['verified'] == 0) {
      $deleteUser = $con->prepare("delete from users where email = :email and verified = 0");
      $deleteUser->bindParam(':email', $email, PDO::PARAM_STR);
      $deleteUser->execute();
    } 
    
    if($findUser->rowCount() == 0 || ($findUser->rowCount() == 1 && $user['verified'] == 0)) {

      User::addUser($username, $email, $fname_kh, $lname_kh, $fname_en, $lname_en, $phone1, $phone2, $telegram_link, $password, $vkey);

      // Send Email
      Mail::sendMail($to, $message);

      $return['redirect'] = 'sent.php?msg=អរគុណសម្រាប់ការចុះឈ្មោះ។​ សូមចូលទៅកាន់ប្រអប់សាររបស់អ្នក រួចធ្វើតាមការណែនាំដើម្បីផ្ទៀងផ្ទាត់គណនី។';
    } else {
      // User exists
      $return['error'] = 'អ៊ីម៉ែលត្រូវបានប្រើប្រាស់រួចហើយ!';
    }

    // Make sure the user can be added and is added

    // Return the proper information back to JavaScript to redirect us.

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit('You can not access this page!');
  }
?>