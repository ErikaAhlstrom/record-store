<?php

class AdminControllerTEST extends SuperController
{
    private $id;

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

                $this->view->viewLoginForm();

                break;
            case "products":
                if ($id) $this->updateProduct();
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

    private function setId($id)
    {
        $this->id = is_numeric($id) ? $id : false;
    }

    private function orderDetails()
    {
        $order = $this->model->fetchOrderById($this->id);
        $this->view->viewOrderDetails($order);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->setToSent($this->id);
            header("Location: " . $this->destination . "admin/orders");
            die();
        }
    }

    private function products()
    {
        $records = $this->model->fetchAllRecords();
        $this->view->viewAllProducts($records);
    }

    private function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->sanitize($_POST['name']);
            $artist = $this->model->fetchArtistByName($name);
            $records_has_artists = $this->model->fetchRecordsHasArtistsById($this->id);

            $artist_id = $artist ? $artist[0]['id_artist'] : $this->model->insertArtist($name);

            if ($artist_id !== $records_has_artists[0]['id_artist']) $this->model->updateRecordsHasArtists($this->id, $artist_id);

            foreach ($_POST as $key => $value) {
                $record[$key] = $this->sanitize($value);
            }

            $this->model->updateRecord($this->id, $record);
        }
        $product = $this->model->fetchRecordById($this->id);
        $this->view->viewProductForm($product);
    }

    private function orders()
    {
        $orders = $this->model->fetchAllOrders();
        $this->view->viewAllOrders($orders);
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
}
