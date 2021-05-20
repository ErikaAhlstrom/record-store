<?php

class AdminView
{
    public function viewHeader($title)
    {
        include_once("views/partials/header.php");
    }

    public function viewFooter()
    {
        include_once("views/partials/footer.php");
    }

    public function viewLoginForm()
    {
        include_once("views/partials/loginAdminForm.php");
    }
    
    public function viewTableRow($record)
    {
        $destination = URLROOT . "admin/products/" . $record['id_record'];
        $tableRow = <<<HTML
            <tr>
            <th scope="row">$record[id_record]</th>
            <td>$record[title]</td>
            <td><a class="btn btn-primary" href="$destination">Update</a></td>
            <td><a class="btn btn-danger">Delete</a></td>
            </tr>
        HTML;
        
        echo $tableRow;
    }

    public function viewTableRowOrders($order)
    {
        $destination = URLROOT . "admin";
        $sent = $order["sent"] ? "<strong class='text-primary'>YES</strong>" : "<strong class='text-danger'>NO</strong>";
        $tableRow = <<<HTML
            <tr>
            <th scope="row">$order[id_order]</th>
            <td>
                $order[name]
            </td>
            <td>
                $order[timestamp]
            </td>
            <td>
               $sent
            </td>
            <td>
                <a class="btn btn-primary" href="$destination/orders/$order[id_order]">View Details</a>
            </td>
            </tr>
        HTML;
        
        echo $tableRow;
    }
    
    public function viewTableRowOrderDetails($order)
    {
        $destination = URLROOT;
        $tableRow = <<<HTML
            <tr>
            <th scope="row">$order[id_record]</th>
            <td>
                $order[title]    
            </td>
            <td>
                $order[amount]
            </td>
            </tr>
        HTML;

        echo $tableRow;
    }

    public function viewAllProducts($records)
    {
        $tableStart = <<<HTML
        <div class="container masthead">
            <h2>Records Inventory</h2>
            <table class="table mt-2">
                <thead>
                    <tr>
                    <th scope="col">RECORD_ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">ADMIN</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
        HTML;
        echo $tableStart;

        foreach ($records as $record) {
            $this->viewTableRow($record);
        }

        $tableEnd = <<<HTML
            </tbody>
            </table>
        </div>
        HTML;
        echo $tableEnd;
    }


    public function viewAllOrders($orders)
    {
        $tableStart = <<<HTML
        <div class="container masthead vh-100">
            <h2>Orders</h2>
            <table class="table mt-2">
                <thead>
                    <tr>
                    <th scope="col">ORDER_ID</th>
                    <th scope="col">CUSTOMER</th>
                    <th scope="col">DATE</th>
                    <th scope="col">SENT</th>
                    <th scope="col">ADMIN</th>
                    <!-- <th scope="col">ADMIN</th> -->
                    <!-- <th scope="col"></th> -->
                    </tr>
                </thead>
                <tbody>
        HTML;
        echo $tableStart;

        foreach ($orders as $order) {
            $this->viewTableRowOrders($order);
        }

        $tableEnd = <<<HTML
            </tbody>
            </table>
        </div>
        HTML;
        echo $tableEnd;
    }

    public function viewOrderDetails($order)
    {
        $idOrder = $order[0];
        $destination = URLROOT . "admin/orders";
        
        $tableStart = <<<HTML
        <div class="container masthead vh-100">
            <div class='d-flex justify-content-between'>
                <h2>Order details for order $idOrder[id_order]</h2>
                <a href='$destination' class='btn btn-dark'>Back</a>
            </div>
            <table class="table mt-2">
                <thead>
                    <tr>
                    <th scope="col">RECORD_ID</th>
                    <th scope="col">RECORD</th>
                    <th scope="col">AMOUNT</th>
                    
                </thead>
                <tbody>
        HTML;
        echo $tableStart;
        
        foreach ($order as $orderDetails) {
            $this->viewTableRowOrderDetails($orderDetails);
        }
        
        $tableEnd = <<<HTML
            </tbody>
            </table>
        HTML;

        echo $tableEnd;

        if(!$idOrder["sent"]) 
            echo
            "<form action='#' method='POST'> 
            <input class='btn btn-primary btn-block' type='submit' value='SEND'/>
            </form>";
        

        echo "</div>";
    }
    public function viewProductForm($product, $artists) {
        $product = $product[0];
        include_once("views/partials/productForm.php");
    }
}