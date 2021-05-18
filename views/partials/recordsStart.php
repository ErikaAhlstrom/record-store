        <!-- Portfolio Section-->
        <section class="page-section records" id="records">


          <div class="container">
            <!-- Skivor Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Records</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
              <div class="divider-custom-line"></div>
              <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
              <div class="divider-custom-line"></div>
            </div>
            <!-- Skivor Section Dropdown-->
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Genre
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                foreach ($genres as $genre) {
                  echo "<a class='dropdown-item' href='?genre=$genre[genre]'>$genre[genre]</a>";
                }
                ?>
              </div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">