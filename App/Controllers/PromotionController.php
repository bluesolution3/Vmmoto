<?php

require_once __DIR__ . '/../Models/PromotionModel.php';

class PromotionController {

    private $model;

    public function __construct($pdo) {
        $this->model = new PromotionModel($pdo);
    }

    public function index() {

        $businesses = $this->model->getBusinesses();
        $selectedBusiness = $_GET['business_id'] ?? null;
        $promotions = [];

        if ($selectedBusiness) {
            $promotions = $this->model->getPromotionsByBusiness($selectedBusiness);
        }

        include __DIR__ . '/../Views/promotion/index.php';
    }

    public function create() {
        $businesses = $this->model->getBusinesses();
        include __DIR__ . '/../Views/promotion/create.php';
    }

    public function store() {

        $business_id = $_POST['business_id'];
        $message = substr($_POST['message'], 0, 320);

        $subscribers = $this->model->getSubscribersByBusiness($business_id);

        $total = count($subscribers);
        $success = 0;
        $failure = 0;

        $promotion_id = $this->model->createPromotion($business_id, $message);

        foreach ($subscribers as $subscriber) {

            // 🔹 Simulated SMS sending
            $status = 'success';

            if ($status == 'success') {
                $success++;
            } else {
                $failure++;
            }

            $this->model->insertLog(
                $promotion_id,
                $subscriber['id'],
                $subscriber['mobile'],
                $status
            );
        }

        $this->model->updatePromotionCounts(
            $promotion_id,
            $total,
            $success,
            $failure
        );

        header("Location: index.php?controller=promotion&action=index&business_id=" . $business_id);
        exit;
    }
}
