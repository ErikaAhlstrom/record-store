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
              <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label"><?= $record['title'] ?></h2>
              <!-- Icon Divider-->
              <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
              </div>
              <!-- Portfolio Modal - Image-->
              <img class="img-fluid rounded mb-5" src="<?= $record['cover'] ?>" alt="..." />
              <!-- Portfolio Modal - Text-->
              <p class="mb-5">
                <?=
                $record['description'];
                ?>
              </p>
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