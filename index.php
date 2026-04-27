<?php

$page = $_GET['page'] ?? 'login';

switch($page){

case 'login':
include 'views/auth/login.php';
break;

case 'forgot':
include 'views/auth/forgot.php';
break;

case 'otp':
include 'views/auth/otp.php';
break;

case 'reset':
include 'views/auth/reset.php';
break;

default:
include 'views/auth/login.php';
}
    