
<?php

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);

    require_once "./ProductRepository.php";

    if(isset($_GET['search'], $_GET['ordination'], $_GET['page'])) {
        $search = $_GET['search'];
        $ordination = $_GET['ordination'];
        $currentPage = $_GET['page'];
        $limit = 5;

        $repository = new ProductRepository();
        $total = $repository->count();
        $products = $repository->paginate($currentPage, $limit, $search, $ordination);
    }

    else {
        echo "<script>window.location = './?page=0&search=&ordination='</script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <title>Gestão de Produtos</title>
        <script>
            const goToCreate = () => { 
                window.location = './create-product.php' 
            }

            const goToUpdate = (id) => {
                window.location = `./update-product.php?id=${id}`;
            }

            const onDelete = (id) => {
                window.location = `./on-delete.php?id=${id}`;
            }

            const onSearch = () => { 
                const keyword = document.getElementById('search').value.toLowerCase();
                window.location = `./?page=0&ordination=id_asc&search=${keyword}` 
            }

            const onOrder = () => {
                const ordination = document.getElementById('ordination').value;
                window.location = `./?page=0&ordination=${ordination}&search=`;
            }
        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300&display=swap');

            * {
                margin: 0;
                padding: 0;
                font-family: 'Poppins', sans-serif;
                font-size: 0.99em;
                letter-spacing: -0.4px;
            }

            body {
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 0 30px 0;
                animation: up 0.7s;
            }

            header h1 {
                margin: 0;
                font-size: 1.32em;
                text-transform: uppercase;
            }

            main {
                padding: 3% 6%;
                width: 88%;
            }

            main label.ordination {
                font-family: 'ubuntu', sans-serif;
                letter-spacing: -0.1px;
                color: #757575;
                font-size: 0.82em;
                font-weight: 600;
            }

            table button:first-child {
                margin-right: 6px;
            }

            table tr {
                padding: 10px !important;
                animation: down 0.6s;
            }

            table tr th {
                text-transform: uppercase;
            }

            table tr td {
                font-family: 'Hind Siliguri', sans-serif;
            }

            table tr td:first-child {
                font-weight: 600;
            }

            .input-search {
                width: 340px;
            }

            div.active {
                padding: 8px;
                background-color: #E8F5E9;
                border-radius: 22px;
                font-weight: 600;
                color: #388E3C;
                cursor: pointer;
                font-size: 0.76em;
                letter-spacing: 0.3px;
                font-family: 'Hind Siliguri', sans-serif;
                text-align: center;
                text-transform: uppercase;
            }

            div.inactive {
                padding: 8px;
                background-color: #FFEBEE;
                border-radius: 22px;
                font-weight: 600;
                color: #DC4C64;
                cursor: pointer;
                font-size: 0.76em;
                letter-spacing: 0.3px;
                font-family: 'Hind Siliguri', sans-serif;
                text-align: center;
                text-transform: uppercase;
            }

            .tostr-success p:first-child {
                font-weight: 600;
            }

            ul li {
                animation: fade 0.3s;
            }

            @keyframes fade {
                from {
                    transform: scale(0.70);
                }
                to {
                    transform: scale(1);
                }
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

            @keyframes up {
                from {
                    opacity: 0;
                    transform: translateY(-10%);
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
            <header>
                <h1>Gestão de Produtos</h1>
                <div class="input-search input-group">
                    <input 
                        id="search"
                        value='<?php echo $search ?>'
                        type="text"
                        class="form-control"
                        placeholder="Pesquisar..."
                        autofocus
                    >
                    <button class="btn btn-outline-dark" type="button" onclick="onSearch()">Pesquisar</button>
                </div>
                <button class="btn btn-dark" onclick="goToCreate()">NOVO CONTATO</button>
            </header>

            <div class="row mb-3">
                <div class="col">
                    <label for="ordination" class="form-label ordination">Ordenar por</label>
                    <select id="ordination" class="form-select" onchange="onOrder()">
                        <option selected>Como deseja ordenar?</option>
                        <option value="id_asc">ID crescente</option>
                        <option value="price_asc">Preço crescente</option>
                        <option value="price_desc">Preço decrescente</option>
                        <option value="description_asc">Descrição crescente</option>
                        <option value="description_desc">Descrição decrescente</option>
                    </select>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Marca</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                <?php
                    foreach($products as $product) {
                        echo "<td>{$product['id']}</td>";
                        echo "<td>{$product['description']}</td>";
                        echo "<td>{$product['brand']}</td>";
                        echo "<td> R$ {$product['price']}</td>";
                        echo "<td>{$product['stock']} uni</td>";
                        $span = $product['is_active'] == 1 ? '<div class="active">Ativo</div>' : '<div class="inactive">Inativo</div>';
                        echo "<td>{$span}</td>";
                        echo "<td>";
                        echo "<button class='btn btn-secondary btn-sm' onclick='goToUpdate({$product['id']})'>EDITAR</button>";
                        echo "<button class='btn btn-danger btn-sm' onclick='onDelete({$product['id']})'>REMOVER</button>";
                        echo "</td>";
                        echo "</tr>"; 
                    }
                ?>
            </table>
            <nav clss="nav-pagination">
                <ul class="pagination justify-content-center">
                    <?php
                        for($i = 0; $i < $total / $limit; $i++) {
                            $page = $i + 1;
                            if($currentPage == $i) {
                                echo "<li class='page-item active'><a class='page-link' href='./?page={$i}&search=&ordination={$ordination}'>{$page}</a></li>";
                            }
                            else {
                                echo "<li class='page-item'><a class='page-link' href='?page={$i}&search=&ordination={$ordination}'>{$page}</a></li>";
                            }
                        }
                    ?>
                </ul>
            </nav>
        </main>

        <script deffer>
            let input = document.getElementById('search');
            input.addEventListener("keypress", function(event) {
                if(event.key === "Enter") {
                    event.preventDefault();
                    onSearch();
                }
            })
        </script>
    </body>
</html>