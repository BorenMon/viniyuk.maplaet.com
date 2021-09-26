<?php

if(!defined('__CONFIG__')) {
  exit('You don not have a config file!');
}

class DB {
  protected static $con;

  private function __construct() {

    try {
      self::$con = new PDO('mysql:charset=utf8mb4;host=localhost;port=3306;dbname=mongkulp_viniyuk.maplaet.com', 'mongkulp_boren', 'dEVvAe3].u49~3dH0Z');
    } catch (PDOException $e) {
      echo $e;
      exit;
    }
  }

  public static function getConnection() {
    if(!self::$con) {
      new DB();
    }

    return self::$con;
  }
}