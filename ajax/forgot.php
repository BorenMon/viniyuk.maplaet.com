<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $return = [];

    $email = Filter::String($_POST['email']);

    $findUser = $con->prepare('select id from users where email = lower(:email) and verified = 1 limit 1');
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();

    if(!($findUser->rowCount())) {
      $return['error'] = 'អ៊ីម៉ែលដែលអ្នកបញ្ចូលមិនមាននៅក្នុងទិន្នន័យទេ!';
    } else {

      $ckey = md5(time().$email);

      $update = $con->prepare("update users set ckey = :ckey where email = :email limit 1");
      $update->bindParam(':ckey', $ckey, PDO::PARAM_STR);
      $update->bindParam(':email', $email, PDO::PARAM_STR);
      $update->execute();

      $message = "
        <a href='https://viniyuk.maplaet.com/reset.php?ckey=$ckey'>ប្ដូរលេខកូដសម្ងាត់</a>
      ";

      Mail::sendMail($email, $message);

      $return['redirect'] = 'sent.php?msg=សូមចូលទៅកាន់ប្រអប់សាររបស់អ្នក រួចធ្វើតាមការណែនាំដើម្បីប្ដូរលេខកូដសម្ងាត់។';

    }

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit('You can not access this page!');
  }
?>