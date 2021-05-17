<?php

class AdminController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function admin($param)
    {
        $this->getHeader("Admin");

        $records = $this->getAllRecords();
        $this->view->viewAllRecords($records);

        // om det finns en session för admin -> redirect till admin/records
        // annars rendera viewAdminLogin

        // kalla på loginAdmin(POST-parameter från formuläret)
        // om admin finns skapa session för admin -> då sker en redirect till admin/records

        $this->getFooter();
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getAllRecords()
    {
        return $this->model->fetchAllRecords();
    }

    private function getFooter()
    {
        $this->view->viewFooter();
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
