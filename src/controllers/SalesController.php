<?php

// Define o namespace do controller
namespace App\Controllers;

use PDO;

class SalesController {

    public function index() {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT sales.*, SUM((products.price * sale_products.quantity) + (((products.price * sale_products.quantity) / 100) * product_types.tax)) AS total
            FROM sales
            LEFT JOIN sale_products ON (sales.id = sale_products.id_sale)
            LEFT JOIN products ON (sale_products.id_product = products.id)
            LEFT JOIN product_types ON (products.id_type = product_types.id)
            GROUP BY sales.id
        ');

        $stmt->execute();
        $sales = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        require_once '../src/views/sales/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validar os dados recebidos
            $customer   = $_POST['customer'];
            $created_at = date('Y-m-d H:i:s');

            if (empty($customer)) {
                die('O cliente é obrigatório');
            }

            require_once dirname(__DIR__) . '/config/database.php';
            
            $stmt = $pdo->prepare('
                INSERT INTO sales 
                (customer, created_at) VALUES (:customer, :created_at)
            ');

            $stmt->bindParam(':customer', $customer);
            $stmt->bindParam(':created_at', $created_at);
            
            if (!$stmt->execute()) {
                die('Erro ao inserir a venda');
            }

            $id_sale = $pdo->lastInsertId();

            $products = json_decode($_POST['all-products']);
            
            foreach ($products as $product) {
                $stmt = $pdo->prepare('
                    INSERT INTO sale_products 
                    (id_sale, id_product, quantity) VALUES (:id_sale, :id_product, :quantity)
                ');

                $stmt->bindParam(':id_sale', $id_sale);
                $stmt->bindParam(':id_product', $product->id);
                $stmt->bindParam(':quantity', $product->quantity);
                
                if (!$stmt->execute()) {
                    die('Erro ao inserir a venda');
                }
            }

            header('Location: /mercado/sales');
            exit();
        }

        require_once dirname(__DIR__) . '/config/database.php';

        $stmt = $pdo->prepare('
            SELECT products.*, product_types.name AS type, product_types.tax AS type_tax 
            FROM products 
            LEFT JOIN product_types ON (products.id_type = product_types.id) 
            ORDER BY products.name
        ');

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        // exibir o formulário para adicionar um novo produto
        require_once dirname(__DIR__) . '/views/sales/create.php';
    }

    public function edit($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT * 
            FROM sales 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $sale = $stmt->fetch(PDO::FETCH_OBJ);
        
        $stmt = $pdo->prepare('
            SELECT products.*, product_types.name AS type, product_types.tax AS type_tax 
            FROM products 
            LEFT JOIN product_types ON (products.id_type = product_types.id)
        ');

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $stmt = $pdo->prepare('
            SELECT products.id AS product_id, products.name, products.price, sale_products.quantity, product_types.name AS type, product_types.tax
            FROM sale_products
            INNER JOIN products ON (sale_products.id_product = products.id)
            LEFT JOIN product_types ON (products.id_type = product_types.id)
            WHERE sale_products.id_sale = ' . $id . '
            ORDER BY sale_products.id
        ');

        $stmt->execute();
        $sale_products = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        require_once '../src/views/sales/edit.php';
    }

    public function update() {
        // validar os dados recebidos
        $id       = $_POST['id'];
        $customer = $_POST['customer'];

        if (empty($id)) {
            die('O id é obrigatório');
        }

        if (empty($customer)) {
            die('O cliente é obrigatório');
        }

        require_once dirname(__DIR__) . '/config/database.php';

        $stmt = $pdo->prepare('
            UPDATE sales 
            SET customer = :customer 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':customer', $customer);
        
        if (!$stmt->execute()) {
            die('Erro ao inserir a venda');
        }

        $stmt = $pdo->prepare('
            DELETE FROM sale_products 
            WHERE id_sale = :id_sale
        ');

        $stmt->bindParam(':id_sale', $id);
        
        if (!$stmt->execute()) {
            die('Erro ao inserir a venda');
        }

        $products = json_decode($_POST['all-products']);

        foreach ($products as $product) {
            $stmt = $pdo->prepare('
                INSERT INTO sale_products 
                (id_sale, id_product, quantity) VALUES (:id_sale, :id_product, :quantity)
            ');

            $stmt->bindParam(':id_sale', $id);
            $stmt->bindParam(':id_product', $product->id);
            $stmt->bindParam(':quantity', $product->quantity);
            
            if (!$stmt->execute()) {
                die('Erro ao inserir a venda');
            }
        }

        header('Location: /mercado/sales');
        exit();
    }

    public function delete($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        $stmt = $pdo->prepare('
            DELETE FROM sales 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header('Location: /mercado/sales');
        exit();
    }

}
