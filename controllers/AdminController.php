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
    /*******************************
                ROUTE
    ********************************/

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

                if ($_SERVER['REQUEST_METHOD'] == 'POST') $this->login();
                else $this->getLoginForm();

                break;
            case "products":
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                    $this->deleteProduct();
                }
                if($id !== "add" && is_numeric($id)) $this->updateProduct();
                else if($id == "add") {
                    $this->createProduct();
                }

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

        $this->getFooter();
    }

    /*******************************
                CREATE
    ********************************/

    private function createArtist($name)
    {
        return $this->model->insertArtist($name);
    }

    private function createProduct() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->sanitize($_POST['name']);
            $artist = $this->getArtistByName($name);
            $artist_id = $artist ? $artist[0]['id_artist'] : $this->createArtist($name);

            foreach ($_POST as $key => $value) {
                $record[$key] = $this->sanitize($value);
            }
            $record_id = $this->model->insertProduct($record);
            $this->createRecordsHasArtists($artist_id, $record_id);
        }
        $this->getProductForm();
    }

    private function createRecordsHasArtists($artist_id, $record_id) {
        $this->model->insertRecordsHasArtists($artist_id, $record_id);
    }

    /*******************************
                UPDATE
    ********************************/

    private function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->sanitize($_POST['name']);
            $artist = $this->getArtistByName($name);
            $records_has_artists = $this->getRecordsHasArtistsById();

            $artist_id = $artist ? $artist[0]['id_artist'] : $this->createArtist($name);

            if ($artist_id !== $records_has_artists[0]['id_artist']) $this->updateRecordsHasArtists($artist_id);

            foreach ($_POST as $key => $value) {
                $record[$key] = $this->sanitize($value);
            }
            $this->updateRecord($record);
        }
        $product = $this->getProductById();
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

    private function setToSent()
    {
        $this->model->setToSent($this->id);
    }

    /*******************************
                READ
    ********************************/

    private function getRecordsHasArtistsById()
    {
        return $this->model->fetchRecordsHasArtistsById($this->id);
    }

    private function getArtistByName($name) 
    {
        return $this->model->fetchArtistByName($name);
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

    private function getOrderById()
    {
        return $this->model->fetchOrderById($this->id);
    }

    /*******************************
            SHALLOW DELETE
     ********************************/
    private function deleteProduct() {
        $record_id = $this->sanitize($_POST['record_id']);
        $this->model->deleteRecord($record_id);
        echo "<script>location.href = 'http://localhost/record-store/admin/products';</script>";

    }

    /*******************************
                VIEWS
    ********************************/

    private function products()
    {
        $records = $this->getAllProducts();
        $this->view->viewAllProducts($records);
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

    private function orders()
    {
        $orders = $this->getAllOrders();
        $this->view->viewAllOrders($orders);
    }

    private function getHeader($title)
    {
        $this->view->viewHeader($title);
    }

    private function getProductForm($product = false)
    {
        $product = $product ? $product[0] : $product;   
        $this->view->viewProductForm($product);
    }

    private function getFooter()
    {
        $this->view->viewFooter();
    }

    private function getLoginForm($error = false)
    {
        $this->view->viewLoginForm($error);
    }
    /*******************************
            HELP METHODS
    ********************************/


    private function setId($id)
    {
        $this->id = is_numeric($id) ? $id : false;
    }

    private function login()
    {
        $username = $this->sanitize($_POST["username"]);
        $password = $this->sanitize($_POST["password"]);

        try {
            $admin = $this->model->loginAdmin($username, $password);
            $_SESSION["admin"] = $admin;
            header("Location: $this->destination" . "admin/products");
            die();
        } catch (Exception $e) {
            $this->getLoginForm($e->getMessage());
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
