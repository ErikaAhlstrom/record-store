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

    public function cart($show)
    {
        $this->getHeader("Cart");

        $customer_id = $_SESSION['customer']['id_customer'];

        $cart = $this->model->fetchCartByCustomerId($customer_id);

        if ($cart) {
            $totalSum = $this->calcTotal($cart);
            $this->view->viewCartPage($cart, $totalSum);
        } else if ($show) {
            // View Thank You Message
            $this->view->thankYou();
        } else {
            $this->view->viewEmptyCart();
        }

        // ORDER
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order']))
            $this->processOrderForm($cart);
        // Ny view med success meddelande och orderbekräftelse

        // REMOVE ITEM FROM CART
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
            $this->removeItemFromCart();
        }

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
            $this->model->deleteCart($customer_id);
            echo "<script>location.href = 'http://localhost/record-store/cart/thank-you';</script>";
        }
    }

    private function removeItemFromCart()
    {
        $record_id = $this->sanitize($_POST["record_id"]);
        $customer_id = $_SESSION['customer']['id_customer'];

        $this->model->deleteCartDetail($record_id, $customer_id);

        echo "<script>location.href = 'http://localhost/record-store/cart';</script>";
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
