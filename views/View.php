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

  public function viewRecordsStart()
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
                  
                      <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal$record[id_record]">
                          <img class="img-fluid" src="$record[cover]" alt="..." />
                          <p class="text-muted mt-3"><small>$record[title]</small></p>
                      </div>
                  </div>
      HTML;

    echo $html;
  }

  public function viewModal($record)
  {
    $html = <<<HTML
                  <div class="portfolio-modal modal fade" id="portfolioModal$record[id_record]" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                  </button>
                                  <div class="modal-body text-center">
                                      <div class="container">
                                          <div class="row justify-content-center">
                                              <div class="col-lg-8">
                                                  <!-- Record Modal - Title-->
                                                  <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">$record[title]</h2>
                                                  <!-- Icon Divider-->
                                                  <div class="divider-custom">
                                                      <div class="divider-custom-line"></div>
                                                      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                      <div class="divider-custom-line"></div>
                                                  </div>
                                                  <!-- Record Modal - Image-->
                                                  <div class="row">
                                                    <!-- <div style="padding-bottom:100%; overflow:hidden; position:relative"> -->
                                                    <img class="mb-5 col-6" id="record-cover" style="width: 300px;height: 300px;object-fit: cover;" src="$record[cover]" alt="the cover of $record[title]" />
                                                    <!-- </div> -->
                                                    <div class="col-6">
                                                      <h3>$record[name]</h3>
                                                      <p class="mb-3 text-muted"><small>RELEASE YEAR $record[year_released]</small></p>
                                                      <p class="mb-3">$record[description]</p>
                                                      <h3 class="mb-3 text-muted">???$record[price]</h3>
                                                      <form class="d-flex flex-column" action="" method="POST">
                                                      <select name="amount" class="mb-3 col-4 btn btn-secondary dropdown-toggle" aria-label=".form-select-sm example">
                                                        <option selected value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                      </select>
                                                        <input hidden value="$record[id_record]" name="record_id">
                                                        <input class="mb-5 btn btn-primary btn-lg" type="submit" name="add" value="Add to cart"/>
                                                      </form>
                                                    </div>
                                                  </div>
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
