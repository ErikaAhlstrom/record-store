<?php
class View
{
  public function viewHeader($title)
  {
    include_once("views/partials/header.php");
  }

  public function viewHero()
  {
    include_once("views/partials/hero.php");
  }

  public function viewFooter()
  {
    include_once("views/partials/footer.php");
  }

  public function viewRecordsStart($genres)
  {
    include_once("views/partials/recordsStart.php");
  }

  public function viewRecordsEnd()
  {
    include_once("views/partials/recordsEnd.php");
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

  public function viewModal($record)
  { 
    $html = <<<HTML
                  <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                  </button>
                                  <div class="modal-body text-center">
                                      <div class="container">
                                          <div class="row justify-content-center">
                                              <div class="col-lg-8">
                                                  <!-- Portfolio Modal - Title-->
                                                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">$record[title]</h2>
                                                  <!-- Icon Divider-->
                                                  <div class="divider-custom">
                                                      <div class="divider-custom-line"></div>
                                                      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                      <div class="divider-custom-line"></div>
                                                  </div>
                                                  <!-- Portfolio Modal - Image-->
                                                  <div class="row">
                                                    <img class="img-fluid rounded mb-5 col-6" src="$record[cover]" alt="the cover of $record[title]" />
                                                    <div class="col-6">
                                                      <h3>$record[name]</h3>
                                                      <p class="mb-5">$record[description]</p>
                                                      <p class="mb-5">$record[price]:-</p>
                                                      <p class="mb-5">$record[year_released]</p>
                                                      <form action="#" method="POST">
                                                      <input type="submit" value="hejsan"/>
                                                      </form>
                                                    </div>
                                                  </div>
                                                  <!-- Portfolio Modal - Text-->
                                                  <button class="btn btn-primary" data-dismiss="modal">
                                                      <i class="fas fa-times fa-fw"></i>
                                                      Close Window
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
        HTML;
    echo $html;
  }

  public function viewAllRecords($records)
  {
    foreach ($records as $record) {
      $this->viewOneRecord($record);
      $this->viewModal($record);
    }
  }
}
