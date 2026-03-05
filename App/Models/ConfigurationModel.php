<?php

class ConfigurationModel {

    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getByGroup($group) {
        $stmt = $this->db->prepare("
            SELECT config_key, config_value 
            FROM configurations 
            WHERE config_group = ?
        ");
        $stmt->execute([$group]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $config = [];
        foreach ($results as $row) {
            $config[$row['config_key']] = $row['config_value'];
        }

        return $config;
    }

    public function setConfig($key, $value, $group) {

        $stmt = $this->db->prepare("
            INSERT INTO configurations (config_key, config_value, config_group)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE config_value = VALUES(config_value)
        ");

        $stmt->execute([$key, $value, $group]);
    }
}
