<?php

class CartController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function cart()
    {
        $this->getHeader("Cart");

        // Hämta id från SESSION
        $customer_id = $_SESSION['customer']['id_customer'];
        //$id = $this->sanitize($_GET['id']);
        $cart = $this->model->fetchCartByCustomerId($customer_id);
        // print_r($cart);

        if ($cart)
            $this->view->viewCartPage($cart);

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->processOrderForm();

        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    private function processOrderForm()
    {
        $record_id    = $this->sanitize($_POST['record_id']);
        $customer_id = $this->sanitize($_POST['customer_id']);
        $confirm = $this->model->saveOrder($customer_id, $record_id);

        if ($confirm) {
            $customer = $confirm['customer'];
            $lastInsertId = $confirm['lastInsertId'];
            $this->view->viewConfirmMessage($customer, $lastInsertId);
        } else {
            $this->view->viewErrorMessage($customer_id);
        }
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
