<?php

class BusinessModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getMembers(): array
    {
        return $this->pdo->query("SELECT id, name FROM members")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories(): array
    {
        return $this->pdo->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubcategoriesByCategory(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT id, name FROM subcategories WHERE category_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertBusiness(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO businesses (business_name, member_id, category_id, subcategory_id, status)
             VALUES (?, ?, ?, ?, 1)"
        );

        $stmt->execute([
            $data['business_name'],
            $data['member_id'],
            $data['category_id'],
            $data['subcategory_id']
        ]);
    }

    public function getAllBusinesses(): array
    {
        $sql = "
            SELECT b.*, 
                   m.name AS member_name, 
                   c.name AS category_name, 
                   s.name AS subcategory_name
            FROM businesses b
            JOIN members m ON m.id = b.member_id
            JOIN categories c ON c.id = b.category_id
            JOIN subcategories s ON s.id = b.subcategory_id
            ORDER BY b.id DESC
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleStatus(int $id): void
    {
        $this->pdo->prepare(
            "UPDATE businesses SET status = IF(status=1,0,1) WHERE id = ?"
        )->execute([$id]);
    }
}
