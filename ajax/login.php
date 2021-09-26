<?php 
  define('__CONFIG__', true);
  require_once '../inc/config.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // header('Content-Type: application/json');

    $return = [];

    $email = Filter::String($_POST['email']);

    $password = $_POST['password'];

    $remember = $_POST['remember'];

    $findUser = $con->prepare('select id, password from users where email = lower(:email) and verified = 1 limit 1');
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();

    if(!($findUser->rowCount())) {
      // They need to create a new account
      $return['error'] = 'អ៊ីម៉ែលដែលអ្នកបញ្ចូលមិនមាននៅក្នុងទិន្នន័យទេ!';
    } else {
      // User exists, try and sign them in
      $user = $findUser->fetch(PDO::FETCH_ASSOC);

      $id = (int) $user['id'];
      $hash = $user['password'];

      if(password_verify($password, $hash)) {
        // User is signed in
        $return['redirect'] = 'dashboard/index.php';

        if($remember == '1') {
          setcookie('id', $id, time() + 7*24*60*60, '/');
        } else {  
          setcookie("id", $id, time() - 7*24*60*60, '/');
          $_SESSION['id'] = $id;
        }
        
      } else {
        // Password doesn't match with email
        $return['error'] = 'លេខកូដដែលអ្នកបញ្ចូលមិនត្រឹមត្រូវទេ!';
      }

    }

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
  } else {
    exit('You can not access this page!');
  }
?>