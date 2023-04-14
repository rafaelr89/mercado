<?php

// Define o namespace do controller
namespace App\Controllers;

use PDO;

class ProductTypesController {

    public function index() {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT * 
            FROM product_types
        ');

        $stmt->execute();
        $product_types = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        require_once '../src/views/product_types/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validar os dados recebidos
            $name = $_POST['name'];
            $tax  = $_POST['tax'];

            if (empty($name)) {
                die('O nome é obrigatório');
            }

            if (empty($tax)) {
                die('O imposto é obrigatório');
            }

            require_once dirname(__DIR__) . '/config/database.php';

            // inserir os dados na tabela products
            $stmt = $pdo->prepare('
                INSERT INTO product_types 
                (name, tax) VALUES (:name, :tax)
            ');

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':tax', $tax);
            
            if (!$stmt->execute()) {
                die('Erro ao inserir o produto');
            }

            // redirecionar para a página de listagem de produtos
            header('Location: /mercado/product_types');
            exit();
        }

        // exibir o formulário para adicionar um novo produto
        require_once dirname(__DIR__) . '/views/product_types/create.php';
    }

    public function edit($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            SELECT * 
            FROM product_types 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product_type = $stmt->fetch(PDO::FETCH_OBJ);
        
        require_once '../src/views/product_types/edit.php';
    }

    public function update() {
        // validar os dados recebidos
        $id   = $_POST['id'];
        $name = $_POST['name'];
        $tax  = $_POST['tax'];

        if (empty($id)) {
            die('O id é obrigatório');
        }

        if (empty($name)) {
            die('O nome é obrigatório');
        }

        if (empty($tax)) {
            die('O imposto é obrigatório');
        }

        require_once dirname(__DIR__) . '/config/database.php';

        $stmt = $pdo->prepare('
            UPDATE product_types 
            SET name = :name, tax = :tax 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tax', $tax);
        
        if (!$stmt->execute()) {
            die('Erro ao inserir o produto');
        }

        // redirecionar para a página de listagem de produtos
        header('Location: /mercado/product_types');
        exit();
    }

    public function delete($id) {
        require_once dirname(__DIR__) . '/config/database.php';

        // Executar a consulta SQL
        $stmt = $pdo->prepare('
            DELETE FROM product_types 
            WHERE id = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header('Location: /mercado/product_types');
        exit();
    }

}
