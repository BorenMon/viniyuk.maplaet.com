<?php

if(!defined('__CONFIG__')) {
  exit('You don not have a config file!');
}

class Mail {
  static function sendMail($to, $message) {
    $from = "support@viniyuk.maplaet.com";
    $subject = "VINIYUK Email Verification";
    
    $headers = "From:" . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type:text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);
  }
}