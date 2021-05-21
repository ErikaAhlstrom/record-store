<?php

class SuperController
{
  protected $model;
  protected $view;
  protected $destination = URLROOT;

  public function __construct($model, $view)
  {
    $this->model = $model;
    $this->view = $view;
  }

  protected function getHeader($title)
  {
    $this->view->viewHeader($title);
  }

  protected function getFooter()
  {
    $this->view->viewFooter();
  }
  /**
   * Sanitize Inputs
   * https://www.w3schools.com/php/php_form_validation.asp
   */
  protected function sanitize($text)
  {
    $text = trim($text);
    $text = stripslashes($text);
    $text = htmlspecialchars($text);
    return $text;
  }
}
