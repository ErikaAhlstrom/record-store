<?php

class AdminController
{
    private $model;
    private $view;
    private $destination;
    private $id;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
        $this->destination = URLROOT;
    }

    public function admin($param, $id)
    {
        $this->setId($id);
        $this->getHeader("Admin");

        switch ($param) {
            case "":
                //LOGIN eller PRODUCTS om Admin finns i session
                if (isset($_SESSION["admin"])) {
                    header("Location: $this->destination" . "admin/products");
                    die();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->login();
                }

                $this->getLoginForm();

                break;
            case "products":
                if($id) $this->updateProduct();
                else $this->products();

                break;
            case "orders":
                if ($id) $this->orderDetails();
                else $this->orders();

                break;
            case "customers":

                break;
            default:
                //$controller->index("This endpoint doesn't exist!");
                break;
        }
        // $records = $this->getAllProducts();
        // $this->view->viewAllRecords($records);

        // om det finns en session för admin -> redirect till admin/records
        // annars rendera viewAdminLogin

        // kalla på loginAdmin(POST-parameter från formuläret)
        // om admin finns skapa session för admin -> då sker en redirect till admin/records

        $this->getFooter();
    }

    private function setId($id)
    {
        $this->id = is_numeric($id) ? $id : false;
    }

    private function orderDetails()
    {
        $order = $this->getOrderById();
        $this->view->viewOrderDetails($order);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->setToSent();
            header("Location: " . $this->destination . "admin/orders");
            die();
        }
    }

    private function products() 
    {
        $records = $this->getAllProducts();
        $this->view->viewAllProducts($records);
    }

    private function updateProduct() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->sanitize($_POST['name']);
            $artist = $this->getArtistByName($name);
            $records_has_artists = $this->getRecordsHasArtistsById();

            $artist_id = $artist ? $artist[0]['id_artist'] : $this->insertArtist($name);

            if($artist_id !== $records_has_artists[0]['id_artist']) $this->updateRecordsHasArtists($artist_id);

            foreach($_POST as $key => $value){
                $record[$key] = $this->sanitize($value); 
            }
            $this->updateRecord($record);
        }
        $product = $this->getProductById();
        $artists = $this->getAllArtists();
        $this->getProductForm($product);
    }

    private function updateRecord($record) 
    {
        $this->model->updateRecord($this->id, $record);
    }

    private function updateRecordsHasArtists($artist_id) 
    {
        $this->model->updateRecordsHasArtists($this->id, $artist_id);
    }

    private function getRecordsHasArtistsById()
    {
        return $this->model->fetchRecordsHasArtistsById($this->id);
    }

    private function insertArtist($name) 
    {
        return $this->model->insertArtist($name);
    }

    private function getArtistByName($name) 
    {
        return $this->model->fetchArtistByName($name);
    }

    private function orders()
    {
        $orders = $this->getAllOrders();
        $this->view->viewAllOrders($orders);
    }

    private function setToSent()
    {
        $this->model->setToSent($this->id);
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getAllOrders()
    {
        return $this->model->fetchAllOrders();
    }

    private function getAllProducts()
    {
        return $this->model->fetchAllRecords();
    }

    private function getProductById()
    {
        return $this->model->fetchRecordById($this->id);
    }

    private function getAllArtists() 
    {
        return $this->model->fetchAllArtists();
    }

    private function getProductForm($product)
    {
        $this->view->viewProductForm($product);
    }

    private function getOrderById()
    {
        return $this->model->fetchOrderById($this->id);
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    private function getLoginForm()
    {
        $this->view->viewLoginForm();
    }

    private function login()
    {
        $username = $this->sanitize($_POST["username"]);
        $password = $this->sanitize($_POST["password"]);

        try {
            $_SESSION["admin"] = $this->model->loginAdmin($username, $password);
            header("Location: $this->destination" . "admin/products");
            die();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Sanitize Inputs
     * https://www.w3schools.com/php/php_form_validation.asp
     */
    public function sanitize($text)
    {
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        return $text;
    }
}
