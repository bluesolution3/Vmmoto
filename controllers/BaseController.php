<?php
class BaseController{
  protected $config; protected $pdo;
  public function __construct(){ $this->config = require __DIR__.'/../../config/config.php'; $db = $this->config['db']; $this->pdo = new PDO($db['dsn'],$db['user'],$db['pass'],$db['options']); session_name($this->config['app']['session_name']); session_start(); }
  protected function view($path,$data=[]){ extract($data); require __DIR__.'/../views/'.$path; }
  protected function redirect($url){ header('Location: '.$url); exit; }
}
