<?php

class PromotionModel {

    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getBusinesses() {
        return $this->db->query("
            SELECT id, business_name 
            FROM businesses 
            WHERE status = 1
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromotionsByBusiness($business_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM promotions 
            WHERE business_id = ? 
            ORDER BY id DESC
        ");
        $stmt->execute([$business_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubscribersByBusiness($business_id) {
        $stmt = $this->db->prepare("
            SELECT id, mobile 
            FROM subscribers 
            WHERE business_id = ?
        ");
        $stmt->execute([$business_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPromotion($business_id, $message) {
        $stmt = $this->db->prepare("
            INSERT INTO promotions (business_id, message)
            VALUES (?, ?)
        ");
        $stmt->execute([$business_id, $message]);
        return $this->db->lastInsertId();
    }

    public function updatePromotionCounts($id, $total, $success, $failure) {
        $stmt = $this->db->prepare("
            UPDATE promotions 
            SET total_sent=?, success_count=?, failure_count=? 
            WHERE id=?
        ");
        $stmt->execute([$total, $success, $failure, $id]);
    }

    public function insertLog($promotion_id, $subscriber_id, $mobile, $status) {
        $stmt = $this->db->prepare("
            INSERT INTO promotion_logs 
            (promotion_id, subscriber_id, mobile, status)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$promotion_id, $subscriber_id, $mobile, $status]);
    }
}
