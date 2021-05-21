<?php
function navigation()
{
    $destination = URLROOT;
    $list = "";

    if (isset($_SESSION['customer'])) {
        $listItems = [
            ['path' => 'logout.php', 'title' => 'Log Out'],
            ['path' => 'cart', 'title' => "<i id='cart-icon' class='bx bx-cart'></i>"]
        ];
    } else if (isset($_SESSION['admin'])) {
        $listItems = [
            ['path' => 'admin/products', 'title' => 'Products'],
            ['path' => 'admin/orders', 'title' => 'Orders'],
            ['path' => 'logout.php', 'title' => 'Log Out'],
        ];
    } else {
        $listItems = [
            ['path' => 'register', 'title' => 'Register'],
            ['path' => 'login', 'title' => 'Log in'],
        ];
    }
    foreach ($listItems as $listItem) {
        $list .= "<li class='nav-item mx-0 mx-lg-1'><a class='nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger' href=$destination$listItem[path]>$listItem[title]</a></li>";
    }
    echo $list;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Record Store</title>
    <!-- Box Icons-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="<?= URLROOT ?>/css/styles.css">
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?= URLROOT ?>">Record Store</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php
                    navigation();
                    ?>
                </ul>
            </div>
        </div>
    </nav>