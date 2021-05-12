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

    public function main()
    {
        $this->router();
    }

    private function router()
    {
        $page = $_GET['page'] ?? "";

        switch ($page) {
            case "login":
                $this->about();
                break;
            case "register":
                $this->order();
                break;
            case "cart":
                $this->order();
                break;
            case "admin":
                $this->order();
                break;
            case "update":
                $this->order();
                break;
            case "products":
                $this->order();
                break;
            case "orders":
                $this->order();
                break;
            case "settings":
                $this->order();
                break;
            default:
                $this->getAllRecords();
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

    private function getRecordsStart($genres)
    {
        $this->view->viewRecordsStart($genres);
    }

    private function getRecordsEnd()
    {
        $this->view->viewRecordsEnd();
    }

    private function about()
    {
        $this->getHeader("Om Oss");
        $this->view->viewAboutPage();
        $this->getFooter();
    }

    private function getAllRecords()
    {
        $this->getHeader("Välkommen");
        $this->getHero();

        $genres = $this->model->fetchAllGenres();
        $this->getRecordsStart($genres);
        $records = $this->model->fetchAllRecords();
        $this->view->viewAllRecords($records);
        $this->getRecordsEnd();
        $this->getFooter();
    }

    private function order()
    {
        $this->getHeader("Beställning");

        $id = $this->sanitize($_GET['id']);
        $movie = $this->model->fetchMovieById($id);

        if ($movie)
            $this->view->viewOrderPage($movie);

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
            $this->processOrderForm();

        $this->getFooter();
    }

    private function processOrderForm()
    {
        $movie_id    = $this->sanitize($_POST['film_id']);
        $customer_id = $this->sanitize($_POST['customer_id']);
        $confirm = $this->model->saveOrder($customer_id, $movie_id);

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
