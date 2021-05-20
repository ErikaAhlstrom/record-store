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

    public function viewCartPage($cart, $totalSum)
    {
        $cartBodyStart = <<<HTML
        <div class="container masthead">
        <div class="row">
        HTML;
        echo $cartBodyStart;

        // Cart items
        $this->viewCart($cart);

        // Total and Order form
        $this->viewOrderForm($totalSum);

        $cartBodyEnd = <<<HTML
        </div>
        </div>
        HTML;
        echo $cartBodyEnd;
    }

    public function viewCart($carts)
    {
        $cartCardsStart = <<<HTML
        <div class="col-md-8">
        HTML;
        echo $cartCardsStart;

        foreach ($carts as $cart) {
            $this->viewOneCart($cart);
        }
        $cartCardsEnd = <<<HTML
        </div>
        HTML;
        echo $cartCardsEnd;
        // lite stängningsdivar
    }



    // Bra att läsa om PHP Templating och HEREDOC syntax!
    // https://css-tricks.com/php-templating-in-just-php/

    public function viewOneCart($cart)
    {
        $url = URLROOT;
        $totalSum = ($cart["price"] * $cart["amount"]);

        $cartCard = <<<HTML
            
            <div class="card mb-3" style="max-width: 600px;">
                <div class="row g-0">
                    <div class="mx-auto col-md-6">
                        <img  style=" max-width: 300px;" class="img-fluid" src=$url/$cart[cover] alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">$cart[title]</h5>
                            <p class="fw-bolder card-text">$cart[name]</p>
                            <hr>
                            <h5 class="card-title">€$totalSum</h5>
                            <p class="card-text">Amount: $cart[amount] </p>
                                <!-- Form som vid submit tar bort detta iten från db -->
                                <form action="#" method="post">
                                    <input  hidden name="record_id" value="$cart[id_record]">
                                    <input class="offset-7 btn btn-secondary" value="Remove" type="submit" name="remove">
                                </form>
                        </div>
                    </div>
                </div>
            </div>  <!-- col -->

        HTML;

        echo $cartCard;
    }


    // Detta är det som läggs till i en order
    public function viewOrderForm($totalSum)
    {

        $html = <<<HTML
                <div class="card mb-3 pt-3 col-md-4">
                    <h2>Shopping bag</h2>
                    <hr>
                    <div class="d-flex justify-content-between">
                    <p>Order value</p>
                    <p>€$totalSum</p>
                    </div>
                    <div class="d-flex justify-content-between">
                    <p>Delivery</p>
                    <p>FREE</p>
                    </div>
                    <div class="d-flex justify-content-between">
                    <h3>Total</h3>
                    <h3>€$totalSum</h3>
                    </div>
                    <hr>
                    <form action="#" method="post">
                        <!-- Skicka köp form till annan sida? -->
                        <input type="submit" 
                                name="order"
                                class="btn btn-md btn-primary" 
                                value="Save order">
                    </form>
                </div>

            <!-- col avslutas efter ett meddelande från viewConfirmMessage eller viewErrorMessage -->

        HTML;

        echo $html;
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
