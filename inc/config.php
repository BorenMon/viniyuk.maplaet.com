<?php
  if(!defined('__CONFIG__')) {
    exit('You don not have a config file!');
  }

  if(!isset($_SESSION)) {
    session_start();
  }

  include_once 'class/DB.php';
  include_once 'class/Filter.php';
  include_once 'class/Page.php';
  include_once 'class/User.php';
  include_once 'class/Mail.php';
  include_once 'function.php';

  $con = DB::getConnection();