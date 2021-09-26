<?php

session_start();
session_destroy();
setcookie("id", '', time() - 7*24*60*60, '/');

header('location: index.php');