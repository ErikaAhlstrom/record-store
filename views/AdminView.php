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
    
    public function viewAllProducts($records)
    {
        $parameters = [
            'Records Inventory', 
            ['RECORD_ID', 'TITLE', 'ADMIN', '']
        ];
    
        $this->viewTableStart($parameters);
        
        foreach ($records as $record) {
            $this->viewTableRow($record);
        }
        
        $this->viewTableEnd();
    }
    
    public function viewAllOrders($orders)
    {
        $parameters = [
            'Orders',
            ['ORDER_ID', 'CUSTOMER', 'DATE', 'SENT', 'ADMIN']
        ];
        
        $this->viewTableStart($parameters);
        
        foreach ($orders as $order) {
            $this->viewTableRowOrders($order);
        }
        
        $this->viewTableEnd();
    }
    
    public function viewOrderDetails($order)
    {
        $idOrder = $order[0];
        $destination = URLROOT . "admin/orders";
        
        $parameters = [
            "Order details for order $idOrder[id_order]",
            ['RECORD_ID', 'RECORD', 'AMOUNT'],
            $destination
        ];
        
        $this->viewTableStart($parameters);
        
        foreach ($order as $orderDetails) {
            $this->viewTableRowOrderDetails($orderDetails);
        }
        
        $this->viewTableEnd('no div');
        
        if (!$idOrder["sent"])
        echo
        "<form action='#' method='POST'> 
        <input class='btn btn-primary btn-block' type='submit' value='SEND'/>
        </form>";
        
        echo "</div>";
    }

    public function viewProductForm($product) {
        $product = $product[0];
        include_once("views/partials/productForm.php");
    }
    
    private function viewTableRow($record)
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

    private function viewTableRowOrders($order)
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
    
    private function viewTableRowOrderDetails($order)
    {
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
    
    private function viewTableStart($parameters) 
    {
        $th = "";
        $h2 = $parameters[0];
        $tableHeaders = $parameters[1];

        $title = $parameters[2] 
        ? 
        "<div class='d-flex justify-content-between'>
            <h2>$h2</h2>
            <a href='$parameters[2]' class='btn btn-dark'>Back</a>
        </div>" 
        : 
        "<h2>$h2</h2>";

        foreach($tableHeaders as $tableHeader) {
            $th .= "<th scope='col'>$tableHeader</th>";
        }
        
        $tableStart = <<<HTML
        <div class="container masthead min-vh-100">
            $title
            <table class="table mt-2">
                <thead>
                    <tr>
                        $th
                    </tr>
                </thead>
                <tbody>
        HTML;
        echo $tableStart;
    }

    private function viewTableEnd($noDiv = false) 
    {
        if($noDiv) {
            $tableEnd = <<<HTML
                </tbody>
                </table>
            HTML;
        }else {
            $tableEnd = <<<HTML
                </tbody>
                </table>
            </div>
            HTML;
        }
        echo $tableEnd;
    }
}
