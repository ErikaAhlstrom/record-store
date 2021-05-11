<?php
class View
{
  public function viewHeader($title)
  {
    include_once("views/partials/header.php");
  }

  public function viewFooter()
  {
    include_once("views/partials/footer.php");
  }

  public function viewRecordsStart()
  {
    include_once("views/partials/recordsStart.php");
  }

  public function viewRecordsEnd()
  {
    include_once("views/partials/recordsEnd.php");
  }

  public function viewEnd()
  {
    include_once("views/partials/end.php");
  }

  public function viewOneRecord($record)
  {
    $html = <<<HTML
                  <div class="col-md-6 col-lg-4 mb-5">
                      <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                          <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                              <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                          </div>
                          <img class="img-fluid" src="$record[cover]" alt="..." />
                      </div>
                  </div>
      HTML;

    echo $html;
  }

  public function viewAllRecords($records)
  {
    foreach ($records as $record) {
      $this->viewOneRecord($record);
    }
  }
}
