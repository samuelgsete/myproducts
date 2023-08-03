<?php

class ProductRepository {

    public static $pdo;

    function __construct() {
        try {
            $username = 'root';
            $password = 'root';
            $database = 'myproductstestdb';
            self::$pdo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
            // Configuração para exibir os erros
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

   public function findById($id) {
        try {
            $sql = self::$pdo->prepare("SELECT * FROM products WHERE id = {$id}");
            $sql->execute();
            $product = $sql->fetch();
            return $product;
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function paginate(int $page, int $limit, string $search, string $ordination) {
        try {
            switch($ordination) {
                case "id_asc":
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;
                
                case "description_asc":
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' ORDER BY description ASC LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;
                
                case "description_desc":
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' ORDER BY description DESC LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;
                
                case "price_asc":
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' ORDER BY price ASC LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;

                case "price_desc":
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' ORDER BY price DESC LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;
                
                default:
                    $offset = $page * $limit; 
                    $sql = self::$pdo->prepare("SELECT * FROM products WHERE description LIKE '%{$search}%' OR brand LIKE '%{$search}%' LIMIT {$limit} OFFSET {$offset}");
                    $sql->execute();
                    $products = $sql->fetchAll();
                    return $products;
            }
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function count() {
        try {
            $sql = self::$pdo->prepare("SELECT * FROM products");
            $sql->execute();
            $total = $sql->rowCount();
            return $total;
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function create(Product $product) {
        try {
            $sql = self::$pdo->prepare("
                INSERT INTO products (description, brand, price, stock, warranty, is_active) VALUES (?,?,?,?,?,?)
            ");
            $sql->execute(
                array(
                    $product->description,
                    $product->brand,
                    $product->price,
                    $product->stock,
                    $product->warranty,
                    $product->is_active
            ));
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function delete($id) {
        try {
            $sql = self::$pdo->prepare('DELETE FROM products WHERE id = '.$id);
            $sql->execute();
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function update(int $id, Product $product) {
        try {
            $sql = self::$pdo->prepare(
                "UPDATE products SET description = ?, brand = ?, price = ?, stock = ?, warranty = ?, is_active = ? WHERE id = {$id}"
            );
            $sql->execute(
                array(
                    $product->description,
                    $product->brand,
                    $product->price,
                    $product->stock,
                    $product->warranty,
                    $product->is_active
                )
            );
        }
        catch(PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }
}

?>