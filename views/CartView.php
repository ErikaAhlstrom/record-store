<?php

class CartView
{
    public function viewHeader($title)
    {
        include_once("views/partials/header.php");
    }

    public function viewFooter()
    {
        include_once("views/partials/footer.php");
    }


    // Bra att läsa om PHP Templating och HEREDOC syntax!
    // https://css-tricks.com/php-templating-in-just-php/

    public function viewOneCart($cart)
    {
        $url = URLROOT;

        $html = <<<HTML

            <div class="col-md-6">
                    <div class="card m-1">
                        <img class="card-img-top" src="" 
                             alt="">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4>Album Title</h4>
                                <h5>Price: 14.99 $</h5>
                            </div>
                        </div>
                    </div>
            </div>  <!-- col -->

        HTML;

        echo $html;
    }



    public function viewCartPage($cart)
    {
        // Tomt form som triggar ett köp
        // 
        $this->viewOrderForm($cart);
        $this->viewCart($cart);
        
    }

    // Detta är det som läggs till i en order
    public function viewOrderForm($cart)
    {

        $html = <<<HTML
                <div class="col-md-6">
                <h2>Total</h2>
                <form action="#" method="post">

                    <!--   order detail 1 -->
                    <input  hidden
                            name="record_id" 
                            value="$cart[id_record]"
                            class="form-control form-control-lg my-2">
                    <!-- Hämta customer id från session ist -->

                    <!-- Skicka löp form till annan sida? -->
                    <input type="submit" 
                            name="delete"
                            class="form-control my-2 btn btn-lg btn-outline-success" 
                            value="Send Order">
                </form>
                <form action="#" method="post">

                    <!--   order detail 2 -->
                    <input  hidden
                            name="record_id" 
                            value="$cart[id_record]"
                            class="form-control form-control-lg my-2">

                    <!-- Skicka löp form till annan sida? -->
                    <input type="submit" 
                            name="delete"
                            class="form-control my-2 btn btn-lg btn-outline-success" 
                            value="Send Order">
                </form>
                </div>

            <!-- col avslutas efter ett meddelande från viewConfirmMessage eller viewErrorMessage -->

        HTML;

        echo $html;
    }

    public function viewCart($carts) {
        foreach ($carts as $cart) {
            $this->viewOneCart($cart);
            var_dump($cart);
        }
    }

/*     public function viewConfirmMessage($customer, $lastInsertId)
    {
        $this->printMessage(
            "<h4>Tack $customer[name]</h4>
            <p>Vi kommer att skicka filmen till följande e-post:</p>
            <p>$customer[email]</p>
            <p>Ditt ordernummer är $lastInsertId </p>
            </div> <!-- col  avslutar Beställningsformulär -->
            ",
            "success"
        );
    } */

/*     public function viewErrorMessage($customer_id)
    {
        $this->printMessage(
            "<h4>Kundnummer $customer_id finns ej i vårt kundregister!</h4>
            <h5>Kontakta kundtjänst</h5>
            </div> <!-- col  avslutar Beställningsformulär -->
            ",
            "warning"
        );
    } */

    /**
     * En funktion som skriver ut ett felmeddelande
     * $messageType enligt Bootstrap Alerts
     * https://getbootstrap.com/docs/5.0/components/alerts/
     */
    public function printMessage($message, $messageType = "danger")
    {
        $html = <<< HTML
            <div class="my-2 alert alert-$messageType">
                $message
            </div>
        HTML;

        echo $html;
    }
}
