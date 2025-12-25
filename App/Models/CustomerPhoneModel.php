<?php

class CustomerPhoneModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll($search = '') {
        $sql = "SELECT * FROM customer_phones 
                WHERE deleted_at IS NULL 
                AND phone_number LIKE :search
                ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM customer_phones WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO customer_phones 
        (phone_number, country_code, status, is_verified, added_by)
        VALUES (?, ?, 'inactive', 0, 'admin')";
        $this->db->prepare($sql)->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE customer_phones 
                SET phone_number=?, country_code=? 
                WHERE id=?";
        $this->db->prepare($sql)->execute($data);
    }

    public function toggleStatus($id, $status) {
        $this->db->prepare(
            "UPDATE customer_phones SET status=? WHERE id=?"
        )->execute([$status, $id]);
    }

    public function verify($id) {
        $this->db->prepare(
            "UPDATE customer_phones SET is_verified=1 WHERE id=?"
        )->execute([$id]);
    }

    public function delete($id) {
        $this->db->prepare(
            "UPDATE customer_phones SET deleted_at=NOW() WHERE id=?"
        )->execute([$id]);
    }

    public function log($phoneId, $action) {
        $this->db->prepare(
            "INSERT INTO phone_activity_logs (phone_id, action, performed_by)
             VALUES (?, ?, 'admin')"
        )->execute([$phoneId, $action]);
    }
}
