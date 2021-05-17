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
        $this->getRecordsEnd();
        $this->getFooter();
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

    private function getAllRecords()
    {
        $genres = $this->model->fetchAllGenres();
        $this->getRecordsStart($genres);
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
