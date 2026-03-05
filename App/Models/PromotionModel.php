
<?php

class PromotionModel {

    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Get active businesses
    public function getBusinesses() {
        return $this->db->query("
            SELECT id, business_name 
            FROM businesses 
            WHERE status = 1
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get promotions by business
    public function getPromotionsByBusiness($business_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM promotions 
            WHERE business_id = ? 
            ORDER BY id DESC
        ");
        $stmt->execute([$business_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get subscribers for selected business
    public function getSubscribersByBusiness($business_id) {
        $stmt = $this->db->prepare("
            SELECT id, mobile 
            FROM subscribers 
            WHERE business_id = ?
        ");
        $stmt->execute([$business_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create promotion entry
    public function createPromotion($business_id, $message) {
        $stmt = $this->db->prepare("
            INSERT INTO promotions (business_id, message, created_at)
            VALUES (?, ?, NOW())
        ");
        $stmt->execute([$business_id, $message]);
        return $this->db->lastInsertId();
    }

    // Update total/success/failure count
    public function updatePromotionCounts($id, $total, $success, $failure) {
        $stmt = $this->db->prepare("
            UPDATE promotions 
            SET total_sent=?, success_count=?, failure_count=? 
            WHERE id=?
        ");
        $stmt->execute([$total, $success, $failure, $id]);
    }

    // Insert log per subscriber
    public function insertLog($promotion_id, $subscriber_id, $mobile, $status) {
        $stmt = $this->db->prepare("
            INSERT INTO promotion_logs 
            (promotion_id, subscriber_id, mobile, status)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$promotion_id, $subscriber_id, $mobile, $status]);
    }

    // Get Twilio configuration
    public function getTwilioConfig() {
        $stmt = $this->db->prepare("
            SELECT config_key, config_value 
            FROM configurations 
            WHERE config_group = 'twilio'
        ");
        $stmt->execute();

        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['config_key']] = $row['config_value'];
        }

        return $data;
    }
}
