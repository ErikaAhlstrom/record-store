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
        $cart = $this->model->fetchCartByCustomerId($customer_id);

        if ($cart) {
            $totalSum = $this->calcTotal($cart);
            $this->view->viewCartPage($cart, $totalSum);
        }

        // Fixa så den bara reagerar på order post request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['order'])
            $this->processOrderForm($cart);
        // Ny view med success meddelande och orderbekräftelse

        $this->getFooter();
    }

    private function calcTotal($carts)
    {
        $totalSum = 0;
        foreach ($carts as $cart) {
            $totalSum += ($cart["price"] * $cart["amount"]);
        }
        return $totalSum;
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    private function processOrderForm($cart)
    {
        $customer_id = $_SESSION['customer']['id_customer'];
        $confirm = $this->model->saveOrder($customer_id, $cart);

        if ($confirm) {
            /*          $customer = $confirm['customer'];
            $lastInsertId = $confirm['lastInsertId'];
            $this->view->viewConfirmMessage($customer, $lastInsertId); */
            $this->model->deleteCarts($customer_id);
        } else {
            /* $this->view->viewErrorMessage($customer_id); */
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
