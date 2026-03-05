<?php

require_once __DIR__ . '/../Models/ConfigurationModel.php';
require_once __DIR__ . '/../Helpers/SecurityHelper.php';

class ConfigurationController {

    private $model;

    public function __construct($pdo) {
        $this->model = new ConfigurationModel($pdo);
    }

    public function index() {
        $portal  = $this->model->getByGroup('portal');
        $payment = $this->model->getByGroup('payment');
        $twilio  = $this->model->getByGroup('twilio');

        // Decrypt Twilio token before showing
        if (!empty($twilio['auth_token'])) {
            $twilio['auth_token'] = SecurityHelper::decrypt($twilio['auth_token']);
        }

        include __DIR__ . '/../Views/configuration/index.php';
    }

    public function savePortal() {

        if (empty($_POST['site_name']) || empty($_POST['admin_email'])) {
            header("Location: index.php?controller=configuration&tab=portal&error=1");
            exit;
        }

        foreach ($_POST as $key => $value) {
            $this->model->setConfig($key, trim($value), 'portal');
        }

        header("Location: index.php?controller=configuration&tab=portal&success=1");
        exit;
    }

    public function savePayment() {

        foreach ($_POST as $key => $value) {
            $this->model->setConfig($key, trim($value), 'payment');
        }

        header("Location: index.php?controller=configuration&tab=payment&success=1");
        exit;
    }

    public function saveTwilio() {

        if (!empty($_POST['auth_token'])) {
            $_POST['auth_token'] = SecurityHelper::encrypt($_POST['auth_token']);
        }

        foreach ($_POST as $key => $value) {
            $this->model->setConfig($key, trim($value), 'twilio');
        }

        header("Location: index.php?controller=configuration&tab=twilio&success=1");
        exit;
    }

    // Test Twilio (Mock test for now)
    public function testTwilio() {
        header("Location: index.php?controller=configuration&tab=twilio&test_success=1");
        exit;
    }
}
