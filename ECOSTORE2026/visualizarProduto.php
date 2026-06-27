<?php

    include "header.php";
    include "conexaoBD.php";

    if(isset($_GET['idProduto'])){
        $idProduto = $_GET['idProduto'];

        //QUERY para buscar o anúncio e o nome do anunciante
        $buscarProduto = "SELECT produtos.*, usuarios.nomeUsuario
                          FROM produtos
                          INNER JOIN usuarios
                            ON produtos.Usuarios_idUsuario = usuarios.idUsuario
                          WHERE produtos.idProduto = $idProduto
                          ";

        //Executa a QUERY
        $resProduto = mysqli_query($conn, $buscarProduto);

        //Verifica se encontrou o anúncio
        if(mysqli_num_rows($resProduto) > 0){
            //Converte o resultado em array associativo
            $produto = mysqli_fetch_assoc($resProduto);
            //Guarda a categoria para buscar os produtos relacionados
            $idProduto        = $produto['idProduto'];
            $fotoProduto      = $produto['fotoProduto'];
            $nomeProduto    = $produto['nomeProduto'];
            $descricaoProduto = $produto['descricaoProduto'];
            $precoProduto     = $produto['precoProduto'];
            $dataProduto      = $produto['dataProduto'];
            $horaProduto      = $produto['horaProduto'];
            $statusProduto    = $produto['statusProduto'];
        }
        else{
            echo "<div class='alert alert-danger text-center'>Produto não encontrado!</div>";
            include "footer.php";
            exit();
        }
                
    }
    else{
        echo "<div class='alert alert-danger text-center'>ID do Produto não informado!</div>";
        include "footer.php";
        exit();
    }

?>

<style>
    .img-produto-principal {
        width: 100%;
        max-height: 600px;
        object-fit: contain;
    }

    .img-produto-relacionado {
        width: 100%;
        height: 180px;
        object-fit: contain;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .nome-relacionado {
        min-height:55px;
        overflow-wrap: break-word;
    }

    .card-relacionado {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-relacionado:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

</style>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="img-produto-principal mb-5 mb-md-0 <?php if($statusProduto == 'finalizado'){ echo 'imagem-finalizada'; } ?>"
                     src="<?php echo htmlspecialchars($fotoProduto); ?>"
                     alt="<?php echo htmlspecialchars($nomeProduto); ?>"
                     title="<?php echo htmlspecialchars($nomeProduto); ?>"
                />
            </div>
            <div class="col-md-6">

                <h1 class="display-5 fw-bolder">
                    <?php echo htmlspecialchars($nomeProduto) ?>
                </h1>
                <div class="fs-5 mb-5">
                    R$ <?php echo number_format($precoProduto, 2, ',', '.'); ?>
                </div>
                <p class="lead">
                    <?php echo htmlspecialchars($descricaoProduto); ?>
                </p>
                <p class="text-muted">
                    Anunciado por <strong><?php echo htmlspecialchars($produto['nomeUsuario']); ?></strong><br>
                    Publicado em <?php echo date('d/m/Y', strtotime($dataProduto)); ?>
                    às <?php echo date('H:i', strtotime($horaProduto)); ?>
                </p>

                <?php
                    if($produto['statusProduto'] == 'disponivel'){ //Verifica se o anúncio está disponível
                        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){ //Verifica se há sessão ativa
                            if($_SESSION['idUsuario'] == $produto['Usuarios_idUsuario']){ //Verifica se o Produto pertence ao usuário logado
                                echo "
                                    <a href='formEditarProduto.php?idProduto=$idProduto' class='btn btn-outline-dark btn-lg mt-3'>
                                        <i class='bi bi-gear me-1'></i>
                                        Editar Produto
                                    </a>
                                ";
                            }
                            else{
                                echo "
                                    <a href='actionPedido.php?idProduto=$idProduto' class='btn btn-outline-dark btn-lg mt-3'>
                                        <i class='bi bi-cart-fill me-1'></i>
                                        Comprar
                                    </a>
                                ";
                            }
                        }
                        else{
                            echo "
                                <a href='formLogin.php' class='btn btn-outline-dark btn-lg mt-3'>
                                    <i class='bi bi-person me-1'></i>
                                    Acesse o sistema para efetuar a compra
                                </a>
                            ";
                        }
                    }
                    else{
                        echo "
                            <button class='btn btn-secondary btn-lg mt-3' disabled>
                                Produto Finalizado
                            </button>
                        ";
                    }
                    
                ?>
            </div>
        </div>
    </div>
</section>


<?php include "footer.php" ?>