<?php

class Page {
  static function forceLogin() {
    if(!isset($_COOKIE['id']) && !isset($_SESSION['id'])) {
      header('location: ../index.php');
      exit();
    }
  }
  static function forceDashboard() {
    if(isset($_COOKIE['id']) || isset($_SESSION['id'])) {
      header('location: dashboard');
      exit();
    }
  }
}