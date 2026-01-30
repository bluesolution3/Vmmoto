<?php

class CategoryModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCategoryId(string $name): ?int
    {
        $stmt = $this->pdo->prepare(
            "SELECT id FROM categories WHERE LOWER(name) = LOWER(?)"
        );
        $stmt->execute([$name]);
        return $stmt->fetchColumn() ?: null;
    }


    public function createCategory(string $name): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        return (int)$this->pdo->lastInsertId();
    }

    public function subcategoryExists(int $categoryId, string $name): bool
    {
        $stmt = $this->pdo->prepare(
            "SELECT id FROM subcategories WHERE category_id = ? AND name = ?"
        );
        $stmt->execute([$categoryId, $name]);
        return (bool)$stmt->fetchColumn();
    }

    public function createSubcategory(int $categoryId, string $name): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO subcategories (category_id, name) VALUES (?, ?)"
        );
        $stmt->execute([$categoryId, $name]);
    }
}
