<?php 
    require_once './ProductRepository.php';

    $id = $_GET['id'];
    $repository = new ProductRepository();
    $product = $repository->findById($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <title>Editar Produto</title>
        <script>
            const goToHome = () => { window.location = './?page=0&search=&ordination=id_asc'; }
        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

            * {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                font-size: 0.99em;
                letter-spacing: -0.4px;
            }

            main {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            form {
                width: 410px;
                padding: 40px 25px;
                animation: down 0.6s;
                background-color: #fff;
                box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            }

            h1 {
                font-size: 1.45em;
                text-align: center;
                font-weight: 550;
                text-transform: uppercase;
            }

            @keyframes down {
                from {
                    opacity: 0;
                    transform: translateY(10%);
                }
                to {
                    opacity: 1;
                    transform: translateY(0%);
                }
            }
        </style>
    </head>
    <body>
        <main>
            <form action="on-update.php" method="post">
                <h1 class="mb-3">Editar produto</h1>
                <input type="text" name="id" value="<?php echo $product['id'] ?>" hidden>
                <div class="row mb-3">
                    <div class="col">
                        <label for="description" class="form-label">Descrição</label>
                        <input 
                            id="description"
                            type="text"
                            class="form-control"
                            placeholder="Ex.: Pendrive 4Gb"
                            name="description"
                            value="<?php echo $product['description'] ?>"
                            required
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="brand" class="form-label">Marca</label>
                        <input 
                            id="brand"
                            type="text"
                            class="form-control"
                            placeholder="Ex.: Samsung"
                            name="brand"
                            value="<?php echo $product['brand'] ?>"
                            required
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="price" class="form-label">Preço</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input 
                                id="price"
                                type="text"
                                class="form-control"
                                placeholder="Ex.: 5.99"
                                name="price"
                                value="<?php echo $product['price'] ?>"
                                required
                            >
                        </div>
                    </div>
                    <div class="col">
                        <label for="stock" class="form-label">Estoque</label>
                        <div class="input-group">
                            <input 
                                id="stock"
                                type="number"
                                class="form-control"
                                placeholder="Ex.: 5"
                                name="stock"
                                value="<?php echo $product['stock'] ?>"
                                required
                            >
                            <span class="input-group-text">uni</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="warranty" class="form-label">Garantia</label>
                        <div class="input-group">
                            <input 
                                id="warranty"
                                type="number"
                                class="form-control"
                                placeholder="Ex.: 12"
                                name="warranty"
                                value="<?php echo $product['warranty'] ?>"
                                required
                            >
                            <span class="input-group-text">meses</span>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">Situação</label>
                        <div class="btn-group" role="group">
                            <input 
                                id="active"
                                type="radio"
                                class="btn-check"
                                name="is_active"
                                value="1"
                                <?php 
                                    if($product['is_active']) {
                                        echo 'checked';
                                    } 
                                ?> 
            
                            >
                            <label class="btn btn-outline-success" for="active">ATIVO</label>

                            <input 
                                id="inactive"
                                type="radio" 
                                class="btn-check" 
                                name="is_active"
                                value="0"
                                <?php 
                                    if(!$product['is_active']) {
                                        echo 'checked';
                                    } 
                                ?> 
                            >
                            <label class="btn btn-outline-danger" for="inactive">INATIVO</label>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger">ATUALIZAR PRODUTO</button>
                    <button type="button" class="btn btn-dark" onclick="goToHome()">CANCELAR</button>
                </div>
            </form>
        </main>
    </body>
</html>