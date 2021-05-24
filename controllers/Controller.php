<?php

class Controller
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index()
    {
        $this->getHeader("Välkommen");
        $this->getHero();
        $this->getAllRecords();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['add'])
            $this->processAddToCart();

        $this->getRecordsEnd();
        $this->getFooter();
    }

    private function processAddToCart()
    {
        $destination = URLROOT . "cart";
        if(isset($_SESSION['customer']['id_customer'])){
            $customer_id = $_SESSION['customer']['id_customer'];
            $record_id = $this->sanitize($_POST['record_id']);
            $amount = $this->sanitize($_POST['amount']);
            $confirm = $this->model->addToCart($customer_id, $record_id, $amount);
            return $confirm;
        } else {
            echo "<script>location.href = 'http://localhost/record-store/cart';</script>";
        }
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getHero()
    {
        $this->view->viewHero();
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    private function getRecordsStart()
    {
        $this->view->viewRecordsStart();
    }

    private function getRecordsEnd()
    {
        $this->view->viewRecordsEnd();
    }

    private function getAllRecords()
    {
        $this->getRecordsStart();
        $records = $this->model->fetchAllRecords();
        $this->view->viewAllRecords($records);
    }
    /**
     * Sanitize Inputs
     * https://www.w3schools.com/php/php_form_validation.asp
     */
    public function sanitize($text)
    {
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        return $text;
    }
}
