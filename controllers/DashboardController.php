<?php
require_once __DIR__.'/BaseController.php'; require_once __DIR__.'/../models/Admin.php'; class DashboardController extends BaseController{ public function index(){ if(empty($_SESSION['admin_id'])){ $this->redirect('/login'); } $m=new Admin($this->pdo); $admin=$m->findById($_SESSION['admin_id']); $this->view('dashboard/index.php',['admin'=>$admin]); } }
