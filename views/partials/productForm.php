<section class="page-section masthead vh-100" id="login">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Update Product</h2>
        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <form method="POST" action="#" novalidate="novalidate">
                    <div class="control-group">
                        
                            <label>Title</label>
                            <input name="title" class="form-control" id="title" type="text" placeholder="Title" required="required" value="<?=$product['title']?>"/>
                            <p class="help-block text-danger"></p>
                       
                    </div>
                    <div class="control-group">
                       
                            <label>Price</label>
                            <input name="price" class="form-control" id="price" type="number" step="0.01" placeholder="Price" required="required" value="<?=$product['price']?>"/>
                            <p class="help-block text-danger"></p>
                        
                    </div>
                    <div class="control-group">
                        
                            <label>Year Released</label>
                            <input name="year_released" class="form-control" id="year_released" type="text" step="0.01" placeholder="Year Released" required="required" value="<?=$product['year_released']?>"/>
                            <p class="help-block text-danger"></p>
                        
                    </div>
                    <div class="control-group">
                       
                            <label>Name</label>
                            <select name="name" class="form-control" id="year_released" required="required">
                              <?php
                                foreach($artists as $artist){
                                  if($artist["id_artist"] == $product["id_artist"]) echo "<option value='$artist[id_artist]' selected>$artist[name]</option>";
                                  else echo "<option value='$artist[id_artist]'>$artist[name]</option>";
                                }
                              ?>
                            </select>
                            <p class="help-block text-danger"></p>
                        
                    </div>
                    
                    <br />
                    <div id="success"></div>
                    <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Log In</button></div>
                </form>
            </div>
        </div>
    </div>
</section>