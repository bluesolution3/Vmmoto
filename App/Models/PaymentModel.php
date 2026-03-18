<?php

class PaymentModel {

    private $db;

    public function __construct($pdo){
        $this->db = $pdo;
    }

    public function getBusinesses(){
        $stmt = $this->db->query("SELECT id, business_name FROM businesses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPayments($business_id = '', $from = '', $to = ''){

        $sql = "
        SELECT p.*, b.business_name
        FROM payments p
        LEFT JOIN businesses b ON p.business_id = b.id
        WHERE 1
        ";

        $params = [];

        if($business_id){
            $sql .= " AND p.business_id = ?";
            $params[] = $business_id;
        }

        if($from){
            $sql .= " AND DATE(p.created_at) >= ?";
            $params[] = $from;
        }

        if($to){
            $sql .= " AND DATE(p.created_at) <= ?";
            $params[] = $to;
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRevenue(){

        $stmt = $this->db->query("
        SELECT SUM(amount) as total
        FROM payments
        WHERE status='success' OR status='completed'
        ");

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getTotalPayments(){

        $stmt = $this->db->query("SELECT COUNT(*) as total FROM payments");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'] ?? 0;
    }

    public function getTotalBusinesses(){

        $stmt = $this->db->query("SELECT COUNT(*) as total FROM businesses");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'] ?? 0;
    }

}
