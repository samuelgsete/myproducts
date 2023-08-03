<?php

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);

    require_once "./ProductRepository.php";
    require_once "./ProductEntity.php";

    $id = $_POST['id'];
    $description = $_POST['description'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $warranty = $_POST['warranty'];
    $is_active = $_POST['is_active'];

    $product = new Product(
        $description,
        $brand,
        $price,
        $stock,
        $warranty,
        $is_active
    );
    $product->id = $id;

    $repository = new ProductRepository();
    $repository->update($id, $product);
?>
<script>
    window.location = './?page=0&search=&ordination=id_asc';
</script>