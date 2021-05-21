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

    // CART START AND END HTML
    private $cartBodyStart = <<<HTML
    <div class="container masthead">
    <div class="row">
    HTML;

    private $cartBodyEnd = <<<HTML
        </div>
        </div>
        HTML;

    public function viewEmptyCart()
    {
        $url = URLROOT;

        echo $this->cartBodyStart;

        $noCartDiv = <<<HTML
        <div class="col-10">
        <div class="card mb-3">
                <div class="row">
                    <div class="mx-auto col-md-4">
                        <img class="img-fluid" src=$url/assets/img/broken-vinyl.jpeg alt="broken vinyl">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Your bag is empty</h3>
                            <a href="$url" class="btn btn-primary btn-lg">Let's shop! <i id="arrow-icon" class='bx bx-right-arrow-alt'></i></a>
                        </div>
                    </div>
                </div>
         </div>  <!-- col -->
         </div>
        HTML;

        echo $noCartDiv;

        echo $this->cartBodyEnd;
    }

    public function viewCartPage($cart, $totalSum)
    {
        echo $this->cartBodyStart;

        // Cart items
        $this->viewCart($cart);

        // Total and Order form
        $this->viewOrderForm($totalSum);

        echo $this->cartBodyEnd;
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
    }

    public function viewOneCart($cart)
    {
        $totalSum = ($cart["price"] * $cart["amount"]);
        $url = URLROOT . "cart/remove";

        $cartCard = <<<HTML
            
            <div class="card mb-3" style="max-width: 600px;">
                <div class="row g-0">
                    <div class="mx-auto col-md-6">
                        <img  style=" max-width: 300px;" class="img-fluid" src=$cart[cover] alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">$cart[title]</h5>
                            <p class="fw-bolder card-text">$cart[name]</p>
                            <hr>
                            <h5 class="card-title">€$totalSum</h5>
                            <p class="card-text">Amount: $cart[amount] </p>
                                <!-- Form som vid submit tar bort detta item från db -->
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

    public function thankYou()
    {
        $url = URLROOT;
        $customer_name = ucfirst($_SESSION['customer']['firstName']);
        echo $this->cartBodyStart;
        $thankYouDiv = <<<HTML
        <div class="col-12 text-center">
            <h2 class="mb-2 text-dark">Thank you $customer_name!</h2>
            <img class="img-fluid" style="max-width: 400px;" src=$url/assets/img/record-playing.gif alt="record playing gif">
        </div>
        HTML;
        echo $thankYouDiv;
        echo $this->cartBodyEnd;
    }
}
