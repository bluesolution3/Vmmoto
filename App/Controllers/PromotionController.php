<?php

require_once __DIR__ . '/../Models/PromotionModel.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use Twilio\Rest\Client;

class PromotionController {

    private $model;

    public function __construct($pdo) {
        $this->model = new PromotionModel($pdo);
    }

    // Show promotion page
    public function index() {

        $businesses = $this->model->getBusinesses();
    
        $selectedBusiness = $_GET['business_id'] ?? null;
    
        $promotions = [];
    
        if ($selectedBusiness) {
            $promotions = $this->model->getPromotionsByBusiness($selectedBusiness);
        }
    
        include __DIR__ . '/../Views/promotion/index.php';
    }

    // Send SMS via Twilio
    public function send() {

        $business_id = $_POST['business_id'] ?? null;
        $message     = $_POST['message'] ?? '';

        if (!$business_id || empty($message)) {
            die("Invalid request.");
        }

        if (strlen($message) > 320) {
            die("Message exceeds 320 characters.");
        }

        $subscribers = $this->model->getSubscribersByBusiness($business_id);

        if (empty($subscribers)) {
            die("No subscribers found.");
        }

        $twilio = $this->model->getTwilioConfig();

        $account_sid = $twilio['account_sid'] ?? '';
        $auth_token  = $twilio['auth_token'] ?? '';
        $from_number = $twilio['from_number'] ?? '';

        if (!$account_sid || !$auth_token || !$from_number) {
            die("Twilio configuration missing.");
        }

        $client = new Client($account_sid, $auth_token);

        // Create promotion entry first
        $promotion_id = $this->model->createPromotion($business_id, $message);

        $success = 0;
        $failure = 0;

        foreach ($subscribers as $subscriber) {

            try {
                $client->messages->create(
                    $subscriber['mobile'],
                    [
                        'from' => $from_number,
                        'body' => $message
                    ]
                );

                $this->model->insertLog(
                    $promotion_id,
                    $subscriber['id'],
                    $subscriber['mobile'],
                    'success'
                );

                $success++;

            } catch (Exception $e) {

                $this->model->insertLog(
                    $promotion_id,
                    $subscriber['id'],
                    $subscriber['mobile'],
                    'failed'
                );

                $failure++;
            }
        }

        // Update counts
        $this->model->updatePromotionCounts(
            $promotion_id,
            count($subscribers),
            $success,
            $failure
        );

        header("Location: index.php?controller=promotion&action=index&business_id=" . $business_id . "&sent=1");
        exit;
    }

    public function create() {

        $businesses = $this->model->getBusinesses();
    
        include __DIR__ . '/../Views/promotion/create.php';
    }
}
