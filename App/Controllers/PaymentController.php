<?php

require_once "App/Models/PaymentModel.php";

class PaymentController {

    private $model;

    public function __construct($pdo){
        $this->model = new PaymentModel($pdo);
    }

    public function index(){

        $business_id = $_GET['business_id'] ?? '';
        $from        = $_GET['from_date'] ?? '';
        $to          = $_GET['to_date'] ?? '';

        $payments        = $this->model->getPayments($business_id,$from,$to);
        $businesses      = $this->model->getBusinesses();

        $totalRevenue    = $this->model->getTotalRevenue();
        $totalPayments   = $this->model->getTotalPayments();
        $totalBusinesses = $this->model->getTotalBusinesses();

        require "App/Views/payment/index.php";
    }

    public function exportCSV(){

        $payments = $this->model->getPayments();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="vemotto_payment_report_'.date('Y-m-d').'.csv"');

        $output = fopen("php://output", "w");

        fputcsv($output, ['ID','Business','Amount','Method','Status','Date']);

        foreach($payments as $p){

            fputcsv($output, [
                $p['id'],
                $p['business_name'],
                $p['amount'],
                $p['payment_method'],
                $p['status'],
                $p['created_at']
            ]);

        }

        fclose($output);
        exit;
    }

}
