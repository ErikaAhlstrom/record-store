<?php

class AdminView
{
    public function viewHeader($title)
    {
        include_once("views/partials/header.php");
    }

    public function viewFooter()
    {
        include_once("views/partials/footer.php");
    }

    public function viewAllRecords($records)
    {
        print_r($records);
    }
}
