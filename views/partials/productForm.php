<?php
$destination = URLROOT . "admin/products";
$heading = $update ? "Update product" : "Create product";
$title = $product ? $product['title'] : "";
$price = $product ? $product['price'] : "";
$yearReleased = $product ? $product['year_released'] : "";
$artistName = $product ? $product['name'] : "";
$stock = $product ? $product['stock'] : "";
$description = $product ? $product['description'] : "";

$errorMessages = "";
if($errors) {
        foreach($errors as $error) {
            $errorMessages .= "<p class='alert alert-danger'>$error</p>";
        }
}
?>

<section class="page-section masthead min-vh-100" id="login">
        <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-3"><?= $heading ?></h2>
                <!-- Contact Section Form-->
                <div class="row">
                        <div class="col-lg-8 mx-auto">
                        <?=$errorMessages?>
                                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                                <form method="POST" action="#" novalidate="novalidate">
                                        <div class="control-group">

                                                <label>Title</label>
                                                <input name="title" class="form-control" id="title" type="text" placeholder="Title" required="required" value="<?= $title ?>" />
                                                <p class="help-block text-danger"></p>

                                        </div>
                                        <div class="control-group">

                                                <label>Price</label>
                                                <input name="price" class="form-control" id="price" type="number" step="0.01" placeholder="Price" required="required" value="<?= $price ?>" />
                                                <p class="help-block text-danger"></p>

                                        </div>
                                        <div class="control-group">

                                                <label>Year Released</label>
                                                <input name="year_released" class="form-control" id="year_released" type="text" placeholder="Year Released" required="required" value="<?= $yearReleased ?>" />
                                                <p class="help-block text-danger"></p>

                                        </div>
                                        <div class="control-group">

                                                <label>Artist Name</label>
                                                <input name="name" class="form-control" id="name" type="text" placeholder="Artist Name" required="required" value="<?= $artistName ?>" />
                                                <p class="help-block text-danger"></p>

                                        </div>
                                        <div class="control-group">

                                                <label>Stock</label>
                                                <input name="stock" class="form-control" id="stock" type="number" placeholder="Stock" required="required" min="0" value="<?= $stock ?>" />
                                                <p class="help-block text-danger"></p>

                                        </div>
                                        <div class="control-group">

                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="5" placeholder="Description" required="required"><?= $description ?></textarea>
                                                <p class="help-block text-danger"></p>

                                        </div>

                                        <br />
                                        <div id="success"></div>
                                        <div class="d-flex justify-content-between form-group">
                                                <button class=" btn btn-primary btn-xl" id="sendMessageButton" type="submit">Save</button>
                                                <a href=<?=$destination?> class='btn-xl btn btn-dark'>Back</a>
                                        </div>
                                </form>

                        </div>
                </div>
        </div>
</section>