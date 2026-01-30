<?php

require_once APP_PATH . '/Models/CategoryModel.php';
require_once APP_PATH . '/Models/ImportLogModel.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class CategoryImportController
{
    private PDO $pdo;
    private CategoryModel $categoryModel;
    private ImportLogModel $logModel;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->categoryModel = new CategoryModel($pdo);
        $this->logModel = new ImportLogModel($pdo);
    }

    public function index()
    {
        require APP_PATH . '/Views/category_import/index.php';
    }

    public function upload()
    {
        $startTime = microtime(true);

        $fileName = time() . '_' . $_FILES['import_file']['name'];
        $filePath = BASE_PATH . '/public/uploads/imports/' . $fileName;
        move_uploaded_file($_FILES['import_file']['tmp_name'], $filePath);

        $sheet = IOFactory::load($filePath)->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, false);

        $summary = [
            'inserted' => 0,
            'skipped' => 0,
            'errors' => [],
            'total_rows' => count($rows) - 1
        ];

        $this->pdo->beginTransaction();

        try {
            foreach ($rows as $i => $row) {
                if ($i === 0) continue;

                $category = trim($row[0] ?? '');
                $subcategory = trim($row[1] ?? '');

                if ($category === '' || $subcategory === '') {
                    $summary['skipped']++;
                    $this->logError("Row $i skipped: empty values");
                    continue;
                }

                $categoryId = $this->categoryModel->getCategoryId($category);
                if (!$categoryId) {
                    $categoryId = $this->categoryModel->createCategory($category);
                }

                if ($this->categoryModel->subcategoryExists($categoryId, $subcategory)) {
                    $summary['skipped']++;
                    continue;
                }

                $this->categoryModel->createSubcategory($categoryId, $subcategory);
                $summary['inserted']++;
            }

            $this->pdo->commit();

        } catch (Throwable $e) {
            $this->pdo->rollBack();
            $summary['errors'][] = $e->getMessage();
            $this->logError($e->getMessage());
        }

        $executionTime = round(microtime(true) - $startTime, 2);

        // Save audit log
        $this->logModel->save([
            'module' => 'Category Import',
            'file_name' => $fileName,
            'total_rows' => $summary['total_rows'],
            'inserted' => $summary['inserted'],
            'skipped' => $summary['skipped'],
            'execution_time' => $executionTime
        ]);

        $summary['execution_time'] = $executionTime;

        require APP_PATH . '/Views/category_import/result.php';
    }

    private function logError(string $message): void
    {
        $logDir = BASE_PATH . '/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        error_log(
            "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL,
            3,
            $logDir . '/category_import.log'
        );
    }
}
