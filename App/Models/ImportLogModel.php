<?php

class ImportLogModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(array $data): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO import_logs
            (module, file_name, total_rows, inserted, skipped, execution_time)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['module'],
            $data['file_name'],
            $data['total_rows'],
            $data['inserted'],
            $data['skipped'],
            $data['execution_time']
        ]);
    }
}
