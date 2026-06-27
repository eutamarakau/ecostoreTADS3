<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <?php
    
        //Verifica o método de requisição do servidor
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Define o bloco de variáveis para armazenar as informações recebidas do formulário
            $fotoProduto = $nomeProduto  = $descricaoProduto = $precoProduto = "";

            //Variável booleana para controle de erros de preenchimento
            $erroPreenchimento = false;
            $erroUpload        = false;

            if(empty($_POST['idProduto'])){
                echo "<div class='alert alert-warning text-center'>O produto não foi identificado!</div>";
                $erroPreenchimento = true;
            }
            else{
                $idProduto = filtrar_entrada($_POST['idProduto']);
            }

            //Verifica se a foto foi atualizada
            if(empty($_POST['fotoAtual'])){
                $fotoAtual = "";
            }
            else{
                $fotoAtual = filtrar_entrada($_POST['fotoAtual']);
            }

            //Validação do campo nomeProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["nomeProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>NOME DO PRODUTO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $nomeProduto = filtrar_entrada($_POST["nomeProduto"]);
            }

            //Validação do campo descricaoProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["descricaoProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>DESCRIÇÃO DO PRODUTO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $descricaoProduto = filtrar_entrada($_POST["descricaoProduto"]);
            }

            //Validação do campo precoProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["precoProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>PREÇO DO PRODUTO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $precoProduto = filtrar_entrada($_POST["precoProduto"]);
            }

            //Início da validação da fotoProduto

            //Verifica se o tamanho do arquivo é diferente de ZERO
            if($_FILES["fotoProduto"]["size"] != 0){

                $diretorio    = "assets/img/"; //Define para qual diretório as imagens serão movidas
                $fotoProduto  = $diretorio . basename($_FILES['fotoProduto']['name']); //Montar o nome a ser salvo no BD
                $tipoDaImagem = strtolower(pathinfo($fotoProduto, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas

                //Verifica se o tamanho do arquivo é maior do que 5 MegaBytes(MB) - Medida em bytes
                if($_FILES["fotoProduto"]["size"] > 5000000){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                    $erroUpload = true;
                }

                //Verifica se a foto está nos formatos JPG, JPEG, PNG ou WEBP
                if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                    echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar no formatos JPG, JPEG, PNG ou WEBP!</div>";
                    $erroUpload = true;
                }

                //Verifica se a imagem foi movida para o diretório (assets/img), utilizando a função move_uploaded_file()
                if(!move_uploaded_file($_FILES["fotoProduto"]["tmp_name"], $fotoProduto)){
                    echo "<div class='alert alert-warning text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                    $erroUpload = true;
                }

            }
            else{
                //Se nehuma nova foto for enviada, mantém a foto atual
                $fotoProduto = $fotoAtual;
            }

            //Se NÃO houver erro de preenchimento e NÃO houver erro no upload da foto
            if(!$erroPreenchimento && !$erroUpload){

                //Criar uma variável para armazenar a QUERY que realiza a edição de dados do Produto na tabela Produtos
                $editarProduto = "
                    UPDATE Produtos
                    SET
                        fotoProduto        = '$fotoProduto',
                        nomeProduto      = '$nomeProduto',
                        descricaoProduto   = '$descricaoProduto',
                        precoProduto       = '$precoProduto'
                    WHERE idProduto        = $idProduto
                    AND Usuarios_idUsuario = $idUsuario
                ";

                //Inclui o arquivo de conexão com o Banco de Dados
                include "conexaoBD.php";

                //Se conseguir executar a QUERY para edição dos registros, exibe alerta de sucesso e a tabela com os dados informados
                //A funçao mysqli_query executa operações no Banco de Dados
                if(mysqli_query($conn, $editarProduto)){

                    echo "<div class='container'>";
                        echo "<div class='alert alert-success text-center mt-3'><strong>PRODUTO</strong> editado com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 mb-3 text-center'>
                                    <img src='$fotoProduto' style='width:150px' title='Foto de $fotoProduto' class='img-thumbnail'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>NOME DO PRODUTO</th>
                                        <td>$nomeProduto</td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIÇÃO DO PRODUTO</th>
                                        <td>$descricaoProduto</td>
                                    </tr>
                                    <tr>
                                        <th>VALOR DO PRODUTO</th>
                                        <td>R$ $precoProduto</td>
                                    </tr>
                                </table>

                                <div class='text-center mb-5'>
                                    <a href='visualizarProduto.php?idProduto=$idProduto' class='btn btn-outline-dark'>
                                        <i class='bi bi-eye me-1'></i>
                                        Visualizar Produto
                                    </a>
                                </div>
                            </div>
                        ";
                    echo "</div>";
                }
                else{
                    echo "<div class='alert alert-danger text-center'>
                    Erro ao tentar editar dados do<strong>PRODUTO</strong> no banco de dados $database!</div>" . mysqli_error($conn);
                }
            }

        }
        else{
            //Usa a função "header()" para redirecionar o usuário para o formUsuario.php
            header("location:formUsuario.php");
        }

        //Função para filtrar entrada de dados
        function filtrar_entrada($dado){
            $dado = trim($dado); //Remove espaços desnecessários
            $dado = stripslashes($dado); //Remove barras invertidas
            $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML

            //Retorna o dado após filtrado
            return($dado);
        }
    
    ?>

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>