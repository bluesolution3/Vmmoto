<?php

class PromotionModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getBusinesses()
    {
        return $this->pdo
            ->query("SELECT id, business_name FROM businesses WHERE status = 1")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromotionsByBusiness($businessId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM promotions WHERE business_id = ? ORDER BY id DESC"
        );
        $stmt->execute([$businessId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubscribers($businessId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, mobile FROM subscribers WHERE business_id = ? AND status = 1"
        );
        $stmt->execute([$businessId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertPromotion($data)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO promotions 
            (business_id, message, total_recipients, success_count, failure_count, sent_by)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $data['business_id'],
            $data['message'],
            $data['total'],
            $data['success'],
            $data['failure'],
            1 // Admin ID (temporary hardcoded)
        ]);

        return $this->pdo->lastInsertId();
    }

    public function insertLog($promotionId, $subscriberId, $mobile, $status)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO promotion_logs 
            (promotion_id, subscriber_id, mobile, status)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([$promotionId, $subscriberId, $mobile, $status]);
    }
}
