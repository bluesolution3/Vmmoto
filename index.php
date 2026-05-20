<?php

$page = $_GET['page'] ?? 'home';

switch($page){

case 'home':
include __DIR__.'/views/pages/home.php';
break;

case 'about':
include __DIR__.'/views/pages/about.php';
break;

case 'contact':
include __DIR__.'/views/pages/contact.php';
break;

default:
include __DIR__.'/views/pages/home.php';
}
