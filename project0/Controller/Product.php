<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Core\\DBAdapter.php';

class Product extends Base {
    // private $products = [];

    public function listAction() {
        $sql = "SELECT * FROM `product`";
        $db = new DBAdapter();
        
        $products = $db->fetchAll($sql);
        // if ($products) $this->setProducts($products);

        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\product\\list.php';
        include ROOT.'\\view\\footer.php';
    }

    public function addAction() {
        $sku = $name = $price = $discount = $quantity = $description = $status = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new DBAdapter();

            $sku = $db->getEscapedString($_POST['sku']);
            $name = $db->getEscapedString($_POST['name']);
            $price = $db->getEscapedString($_POST['price']);
            $discount = $db->getEscapedString($_POST['discount']);
            $quantity = $db->getEscapedString($_POST['quantity']);
            $description = $db->getEscapedString($_POST['description']);
            $status = isset($_POST['status']) ? 1 : 0;

            $sql = "INSERT INTO `product`( `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`) VALUES ('{$sku}','{$name}', {$price}, {$discount}, {$quantity}, '{$description}', {$status})";
            $result = $db->insert($sql);
            if ($result) $this->redirect('list');
        }

        $status = ($status === 1) ? 'checked' : '';
        $formMode = 'Add';
        $formAction = $this->getUrl('add');

        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\product\\addUpdateForm.php';
        include ROOT.'\\view\\footer.php';
    }

    public function updateAction() {
        $db = new DBAdapter();

        if (!isset($_GET['id']) || empty($_GET['id'])) $this->redirect('list');        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $db->getEscapedString($_GET['id']);
            $sku = $db->getEscapedString($_POST['sku']);
            $name = $db->getEscapedString($_POST['name']);
            $price = $db->getEscapedString($_POST['price']);
            $discount = $db->getEscapedString($_POST['discount']);
            $quantity = $db->getEscapedString($_POST['quantity']);
            $description = $db->getEscapedString($_POST['description']);
            $status = isset($_POST['status']) ? 1 : 0;

            $sql = "UPDATE `product` SET `sku`='{$sku}',`name`='{$name}',`price`={$price},`discount`={$discount},`quantity`={$quantity},`description`='{$description}',`status`=$status,`updatedDate`=null WHERE `id`={$id}";
            $result = $db->update($sql);
            if ($result) $this->redirect('list');
        }
        $id = $_GET['id'];
        $product = $db->fetchRow("SELECT * FROM `product` WHERE `id`={$_GET['id']}");
        $sku = $product['sku'];
        $name = $product['name'];
        $price = $product['price'];
        $discount = $product['discount'];
        $quantity = $product['quantity'];
        $description = $product['description'];
        $status = ($product['status'] == 1) ? 'checked' : '';

        $formMode = 'Update';
        $formAction = $this->getUrl('update', NULL, ['id'=>$id]);

        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\product\\addUpdateForm.php';
        include ROOT.'\\view\\footer.php';
    }
    
    public function deleteAction() {
        if (!isset($_GET['id']) || empty($_GET['id'])) $this->redirect('list');
        $sql = "DELETE FROM `product` WHERE `id`={$_GET['id']}";
        $db = new DBAdapter();
        $db->delete($sql);
        $this->redirect('list');
    }

    public function toggleStatusAction() {

    }

    private function getProducts() {
        return $this->products;
    }

    private function setProducts($products) {
        $this->products = $products;
        return true;
    }
}