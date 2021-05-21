<?php

class ControllerTEST extends SuperController
{
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
        $customer_id = $_SESSION['customer']['id_customer'];
        $record_id = $this->sanitize($_POST['record_id']);
        $amount = $this->sanitize($_POST['amount']);
        $confirm = $this->model->addToCart($customer_id, $record_id, $amount);
        return $confirm;
    }

    private function getHero()
    {
        $this->view->viewHero();
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
}
