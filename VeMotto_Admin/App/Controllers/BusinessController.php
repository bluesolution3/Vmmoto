<?php

require_once __DIR__ . '/../Models/BusinessModel.php';

class BusinessController
{
    private BusinessModel $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new BusinessModel($pdo);
    }

    public function index()
    {
        $businesses = $this->model->getAllBusinesses();
        require __DIR__ . '/../Views/business/index.php';
    }

    public function add()
    {
        $members = $this->model->getMembers();
        $categories = $this->model->getCategories();
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'business_name' => trim($_POST['business_name']),
                'member_id' => (int)$_POST['member_id'],
                'category_id' => (int)$_POST['category_id'],
                'subcategory_id' => (int)$_POST['subcategory_id'],
            ];

            if (in_array('', $data, true)) {
                $error = 'All fields are required';
            } else {
                $this->model->insertBusiness($data);
                $success = 'Business added successfully';
            }
        }

        require __DIR__ . '/../Views/business/add.php';
    }

    public function getSubcategories()
    {
        $categoryId = (int)$_GET['category_id'];
        echo json_encode($this->model->getSubcategoriesByCategory($categoryId));
        exit;
    }

    public function toggleStatus()
    {
        $id = (int)$_POST['id'];
        $this->model->toggleStatus($id);
        echo json_encode(['success' => true]);
        exit;
    }
}
