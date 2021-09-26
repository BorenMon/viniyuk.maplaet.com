<?php

if(!defined('__CONFIG__')) {
  exit('You don not have a config file!');
}

class User {
  static function addUser($username, $email, $fname_kh, $lname_kh, $fname_en, $lname_en, $phone1, $phone2, $telegram_link, $password, $vkey) {
    $con = DB::getConnection();
    $addUser = $con->prepare('insert into users(username, email, fname_kh, lname_kh, fname_en, lname_en, phone1, phone2, telegram_link, password, vkey) values(:username, lower(:email), :fname_kh, :lname_kh, :fname_en, :lname_en, :phone1, :phone2, :telegram_link, :password, :vkey)');
    $addUser->bindParam(':username', $username, PDO::PARAM_STR);
    $addUser->bindParam(':email', $email, PDO::PARAM_STR);
    $addUser->bindParam(':fname_kh', $fname_kh, PDO::PARAM_STR);
    $addUser->bindParam(':lname_kh', $lname_kh, PDO::PARAM_STR);
    $addUser->bindParam(':fname_en', $fname_en, PDO::PARAM_STR);
    $addUser->bindParam(':lname_en', $lname_en, PDO::PARAM_STR);
    $addUser->bindParam(':phone1', $phone1, PDO::PARAM_STR);
    $addUser->bindParam(':phone2', $phone2, PDO::PARAM_STR);
    $addUser->bindParam(':telegram_link', $telegram_link, PDO::PARAM_STR);
    $addUser->bindParam(':password', $password, PDO::PARAM_STR);
    $addUser->bindParam(':vkey', $vkey, PDO::PARAM_STR);
    $addUser->execute();
  }
}