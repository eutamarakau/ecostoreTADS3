<?php include "header.php" ?>

<?php include "conexaoBD.php" ?>

<?php

    //Recebe o preco do filtro via método GET
    $filtroProduto = $_GET['statusProduto'] ?? 'todos';
    
    //Query para para consulta SQL a ser realizada
    if($filtroProduto == 'todos'){
        $listarProduto = "SELECT * FROM Produtos";
    }
    else{
        $listarProduto = "SELECT * FROM Produtos WHERE statusProduto = '$filtroProduto' ";
    }

    //Executa a query para consulta no BD
    $res = mysqli_query($conn, $listarProduto);
    
?>

<style>

    /* Remove sublinhado dos links e manter a cor padrão */
    .card-link {
        text-decoration: none;
        color: inherit;
    }

    /* Aplica um efeito suave no hover do card */
    .card-hover {
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    /* Efeito ao passar o mouse */
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Camada escura que aparece no hover (overlay) */
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Torna o overlay visível no hover */
    .card-hover:hover .card-overlay {
        opacity: 1;
    }

    /*Faixa de produto finalizado*/
    .faixa-finalizado{
        right: 0;
        position: absolute;
        width: 50%;
        background: #dc3545;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 0.7rem;
        padding: 5px 0;
        z-index: 10;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    /*Deixa a imagem em preto e branco*/
    .imagem-finalizada {
        filter: grayscale(100%);
        opacity: 0.8;
    }

</style>


<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <!-- Formulário para Filtrar os Produtos
          -->
        <form method="get" class="mb-5" action="index.php">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <select name="statusProduto" class="form-select">

                        <option value="todos" <?php if($filtroProduto == 'todos'){echo "selected";} ?> >Exibir todos os produtos</option>
                        <option value="disponivel" <?php if($filtroProduto == 'disponivel'){echo "selected";} ?> >Exibir apenas produtos disponíveis</option>
                        <option value="finalizado" <?php if($filtroProduto == 'finalizado'){echo "selected";} ?> >Exibir apenas produtos finalizados</option>

                    </select>
                    
                    <button type="submit" class="btn btn-outline-dark mt-3" style="float:right"><i class="bi bi-funnel"></i>
                        Filtrar Produtos

                    </button>

                </div>
            </div>
        </form>

        <?php
            $totalProduto = mysqli_num_rows($res);
            echo "<div class='alert alert-info text-center'>Há <strong>$totalProduto</strong> produtos em nosso sistema!</div>";
        ?>

        
    
        <!-- GRID DE CARDS -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php

                //Verifica se a consulta retornou resultados
                if (mysqli_num_rows($res) > 0){

                    //Enquanto houver produtos, exibirá os cards
                    while($produto = mysqli_fetch_assoc($res)){
                        
            ?>

            <div class="col mb-5">

                <!-- Link que torna todo o card clicável -->
                <a class="card-link" href="visualizarProduto.php?idProduto=<?php echo $produto['idProduto']; ?>">
                    <div class="card h-100 card-hover">

                        <?php
                            if($produto['statusProduto'] == 'finalizado'){
                                echo "<div class='faixa-finalizado'>FINALIZADO</div>";
                            }
                        ?>

                        <!-- Overlay exibido ao passar o mouse -->
                        <div class="card-overlay">
                            <i class="bi bi-eye me-2"></i> Visualizar produto
                        </div>

                        <!-- Imagem do produto -->
                        <img class="card-img-top <?php if($produto['statusProduto'] == 'finalizado'){echo'imagem-finalizada';} ?>"
                             src="<?php echo htmlspecialchars($produto['fotoProduto']) ?>"
                             alt="<?php echo htmlspecialchars($produto['nomeProduto']) ?>" />

                        <!-- Conteúdo do card -->
                        <div class="card-body p-4">
                            <div class="text-center">

                                <!-- Título do produto -->
                                <h5 class="fw-bolder">
                                    <?php echo htmlspecialchars($produto['nomeProduto']) ?>
                                </h5>

                                <!-- Valor Formatado -->
                                <p>
                                    R$ <?php echo number_format($produto['precoProduto'], 2, ',', '.') ?>
                                </p>

                            </div>
                        </div>


                    </div>
                </a>

            </div>

            <?php
                    } //Fechamento do while que varre o array de Produtos


                } //Fechamento do if
                else{
                    //Caso não existam produtos
                    echo "<div class='alert alert-info text-center'>Nenhum produto encontrado.</div>";
                }
            ?>
        </div>

    </div>

</section>
        
<?php include "footer.php" ?>