<?php

class CustomerPhoneController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $phones = $this->model->getAll($search);
        include 'App/Views/customer_phones/list.php';
    }

    public function add() {
        include 'App/Views/customer_phones/add.php';
    }

    public function store() {
        $this->model->create([
            $_POST['phone_number'],
            $_POST['country_code']
        ]);
        header('Location: index.php');
    }

    public function edit() {
        $phone = $this->model->find($_GET['id']);
        include 'App/Views/customer_phones/edit.php';
    }

    public function update() {
        $this->model->update([
            $_POST['phone_number'],
            $_POST['country_code'],
            $_POST['id']
        ]);
        header('Location: index.php');
    }

    public function toggleStatus() {
        $this->model->toggleStatus($_GET['id'], $_GET['status']);
        $this->model->log($_GET['id'], 'Status Changed');
        header('Location: index.php');
    }

    public function verify() {
        $this->model->verify($_GET['id']);
        $this->model->log($_GET['id'], 'Verified');
        header('Location: index.php');
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        $this->model->log($_GET['id'], 'Deleted');
        header('Location: index.php');
    }
}
