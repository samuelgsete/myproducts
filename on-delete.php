<?php

    require_once "./ProductRepository.php";
    
    $id = $_GET['id'];
    $repository = new ProductRepository();
    $repository->delete($id);

?>

<script>
    window.location = './?page=0&search=&ordination=id_asc';
</script>