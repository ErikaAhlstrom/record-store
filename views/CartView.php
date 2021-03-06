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
    <div class="container masthead min-vh-100">
    <div class="row">
    HTML;

    private $cartBodyEnd = <<<HTML
        </div>
        </div>
        HTML;

    public function viewEmptyCart()
    {
        $url = URLROOT;
        $destination = isset($_SESSION['customer']) ? $url : $url . "login";
        $message = isset($_SESSION['customer']) ? "Your cart is empty!" : "You need to log in to shop!";
        $button = isset($_SESSION['customer']) ? "Let's shop!" : "Log in";

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
                            <h3 class="card-title mb-4">$message</h3>
                            <a href="$destination" class="btn btn-primary btn-lg">$button <i id="arrow-icon" class='bx bx-right-arrow-alt'></i></a>
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
        $title = $this->trimString($cart['title']);
        $totalSum = ($cart["price"] * $cart["amount"]);
        $url = URLROOT . "cart/remove";

        $cartCard = <<<HTML
            
            <div class="card mb-3" style="max-width: 700px;">
                <div class="row g-0">
                    <div class="mx-auto col-md-6">
                        <img  style="max-width: 310px;" class="img-fluid" src=$cart[cover] alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 data-bs-toggle="tooltip" data-bs-placement="top" title="$cart[title]" class="card-title">$title</h5>
                            <p class="fw-bolder card-text">$cart[name]</p>
                            <hr>
                            <h5 class="card-title">???$totalSum</h5>
                            <p class="card-text">Amount: $cart[amount] </p>
                                <!-- Form som vid submit tar bort detta item fr??n db -->
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


    // Detta ??r det som l??ggs till i en order
    public function viewOrderForm($totalSum)
    {

        $html = <<<HTML
                <div class="card mb-3 pt-3 col-md-4">
                    <h2>Shopping bag</h2>
                    <hr>
                    <div class="d-flex justify-content-between">
                    <p>Order value</p>
                    <p>???$totalSum</p>
                    </div>
                    <div class="d-flex justify-content-between">
                    <p>Delivery</p>
                    <p>FREE</p>
                    </div>
                    <div class="d-flex justify-content-between">
                    <h3>Total</h3>
                    <h3>???$totalSum</h3>
                    </div>
                    <hr>
                    <form action="#" method="post">
                        <!-- Skicka k??p form till annan sida? -->
                        <input type="submit" 
                                name="order"
                                class="mb-3 btn btn-md btn-primary" 
                                value="Save order">
                    </form>
                </div>
            <!-- col avslutas efter ett meddelande fr??n viewConfirmMessage eller viewErrorMessage -->

        HTML;

        echo $html;
    }

    public function trimString($title) {
        $pieces = explode(" ", $title);
        $first_part = implode(" ", array_splice($pieces, 0, 5));
        if($title == $first_part) {
            return $title;
        } else {
            return $first_part . "...";
        }
    }

    public function thankYou()
    {
        $url = URLROOT;
        $customer_name = ucfirst($_SESSION['customer']['firstName']);
        $customer_email = $_SESSION['customer']['email'];
        echo $this->cartBodyStart;
        $thankYouDiv = <<<HTML
        <div class="col-12 text-center">
            <h2 class="mb-2 text-dark">Thank you $customer_name for your purchase!</h2>
            <img class="img-fluid" style="max-width: 400px;" src=$url/assets/img/record-playing.gif alt="record playing gif">
            <h4 class="mt-2 text-dark">We've sent your order reciept to $customer_email</h4>
        </div>
        HTML;
        echo $thankYouDiv;
        echo $this->cartBodyEnd;
    }
}
