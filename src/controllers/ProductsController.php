<?php

// Define o namespace do controller
namespace App\Controllers;

use PDO;

class ProductsController {

    public function index() {
        require_once dirname(__DIR__) . '/config/database.php';

        $stmt = $pdo->prepare('
            SELECT products.*, product_types.name AS type 
            FROM products 
            LEFT JOIN product_types ON (products.id_type = product_types.id)
        ');
        
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        require_once '../src/views/products/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
            // validar os dados recebidos
            $id_type = $_POST['id_type'];
            $name    = $_POST['name'];
            $price   = $_POST['price'];

            if (empty($id_type)) {
                die('O tipo é obrigatório');
            }

            if (empty($name)) {
                die('O nome é obrigatório');
            }

            if (empty($price)) {
                die('O preço é obrigatório');
            }

            $price = str_replace(',', '.', str_replace('.', '', $price));
            $price = floatval($price);

            // inserir os dados na tabela products
            require_once dirname(__DIR__) . '/config/database.php';

            $stmt = $pdo->prepare('
                INSERT INTO products (id_type, name, price) VALUES (:id_type, :name, :price)
            ');

            $stmt->bindParam(':id_type', $id_type);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            
            if (!$stmt->execute()) {
                die('Erro ao inserir o produto');
            }

            // redirecionar para a página de listagem de produtos
            header('Location: /mercado/products');
            exit();
        }

        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT * 
            FROM product_types 
            ORDER BY name
        ');
        
        $stmt->execute();
        $product_types = $stmt->fetchAll(PDO::FETCH_OBJ);

        // exibir o formulário para adicionar um novo produto
        require_once dirname(__DIR__) . '/views/products/create.php';
    }

    public function edit($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT * 
            FROM products 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_OBJ);

        $stmt = $pdo->prepare('
            SELECT * 
            FROM product_types 
            ORDER BY name
        ');

        $stmt->execute();
        $product_types = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        require_once '../src/views/products/edit.php';
    }

    public function update() {
        // validar os dados recebidos
        $id      = $_POST['id'];
        $id_type = $_POST['id_type'];
        $name    = $_POST['name'];
        $price   = $_POST['price'];

        if (empty($id_type)) {
            die('O id é obrigatório');
        }

        if (empty($id_type)) {
            die('O tipo é obrigatório');
        }

        if (empty($name)) {
            die('O nome é obrigatório');
        }

        if (empty($price)) {
            die('O preço é obrigatório');
        }

        $price = str_replace(',', '.', str_replace('.', '', $price));
        $price = floatval($price);

        require_once dirname(__DIR__) . '/config/database.php';

        // inserir os dados na tabela products
        $stmt = $pdo->prepare('
            UPDATE products 
            SET id_type = :id_type, name = :name, price = :price 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_type', $id_type);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        
        if (!$stmt->execute()) {
            die('Erro ao inserir o produto');
        }

        // redirecionar para a página de listagem de produtos
        header('Location: /mercado/products');
        exit();
    }

    public function delete($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        // remover o produto
        $stmt = $pdo->prepare('
            DELETE FROM products 
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header('Location: /mercado/products');
        exit();
    }

}
