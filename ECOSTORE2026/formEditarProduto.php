<?php 
    include "header.php";
    include "conexaoBD.php";

    //Verifica se o usuário está logado
    if(!isset($_SESSION['idUsuario'])){
        echo "
            <div class='container-mt-5'>
                <div class='alert alert-danger text-center'>Você precisa estar logado para editar um produto!</div>
            </div>
        ";

        include "footer.php";
        exit;
    }

    //Verifica se o idProduto foi enviado pela URL
    if(isset($_GET['idProduto'])){
        $idProduto = $_GET['idProduto'];
        $idUsuario = $_SESSION['idUsuario'];

        //QUERY para buscar o produto pelo idProduto somente se ele pertencer ao usuário logado
        $buscarProduto = "
            SELECT *
            FROM produtos
            WHERE idProduto = $idProduto
            AND Usuarios_idUsuario = $idUsuario
        ";

        //Executar a QUERY
        $res = mysqli_query($conn, $buscarProduto) or die("Erro ao tentar buscar o produto!");

        //Verifica se encontrou algum produto com os dados informados
        if(mysqli_num_rows($res) > 0){
            $anuncio = mysqli_fetch_assoc($res); //Cria um array associativo ($anuncio[]) para armazenar dados do produto

            $fotoProduto      = $anuncio['fotoProduto'];
            $nomeProduto    = $anuncio['nomeProduto'];
            $descricaoProduto = $anuncio['descricaoProduto'];
            $precoProduto     = $anuncio['precoProduto'];
        }
        else{
            echo "
                <div class='container-mt-5'>
                    <div class='alert alert-danger text-center'>Produto não encontrado ou você não possui permissão para editá-lo!</div>
                </div>
            ";
            include "footer.php";
            exit;
        }
    }
    else{
        echo "
            <div class='container-mt-5'>
                <div class='alert alert-danger text-center'>Nenhum produto foi selecionado!</div>
            </div>
        ";
        include "footer.php";
        exit;
    }
    
?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">

        <div class="d-flex justify-content-center mb-3">

            <div class="row">
                <div class="col">
                    
                    <h2>Editar Produto:</h2>

                    <form action="actionEditarProduto.php" method="POST" class="was-validated" enctype="multipart/form-data">

                        <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
                        <input type="hidden" name="fotoAtual" value="<?php echo $fotoProduto; ?>">

                        <div class="form-floating mt-3 mb-3">
                            <?php
                                if(!empty($fotoProduto)){
                                    echo "
                                        <div class='mb-3 text-center'>
                                            <img src='$fotoProduto' class='img-thumbnail' style='max-width: 200px;'>
                                            <p class='mt-2'>Foto atual do Produto</p>
                                        </div>
                                    ";
                                }
                            ?>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="file" class="form-control" id="fotoProduto" placeholder="Foto" name="fotoProduto">
                            <label for="fotoProduto">Nova foto do Produto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto" name="nomeProduto" value="<?php echo $nomeProduto ?>" required>
                            <label for="nomeProduto">Nome do Produto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <textarea class="form-control" id="descricaoProduto" 
                            placeholder="Informe uma breve descrição sobre o seu produto" name="descricaoProduto" required><?php echo $descricaoProduto?></textarea>
                            <label for="descricaoProduto">Descrição do Produto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="precoProduto" placeholder="Preço do Produto" name="precoProduto" value="<?php echo $precoProduto ?>" required>
                            <label for="precoProduto">Preço do Produto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-dark">Salvar Alterações</button>
                    </form>

                </div>
            </div>

        </div>

    </section>

<?php include "footer.php" ?>