<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <?php
    
        //Verifica o método de requisição do servidor
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Define o bloco de variáveis para armazenar as informações recebidas do formulário
            $fotoProduto = $nomeProduto = $descricaoProduto = $precoProduto = $dataProduto = $horaProduto = "";

            //Variável booleana para controle de erros de preenchimento
            $erroPreenchimento = false;

            //Captura a data e a hora do servidor
            $dataProduto = date("Y-m-d");
            $horaProduto = date("H:i:s");

            //Validação do campo nomeProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["nomeProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>TÍTULO DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $nomeProduto = filtrar_entrada($_POST["nomeProduto"]);
            }

            //Validação do campo descricaoProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["descricaoProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>DESCRIÇÃO DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $descricaoProduto = filtrar_entrada($_POST["descricaoProduto"]);
            }

            //Validação do campo precoProduto
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["precoProduto"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>VALOR DO ANÚNCIO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o preco na variável
                $precoProduto = filtrar_entrada($_POST["precoProduto"]);
            }

            //Início da validação da fotoProduto
            $diretorio    = "assets/img/"; //Define para qual diretório as imagens serão movidas
            $fotoProduto  = $diretorio . basename($_FILES['fotoProduto']['name']); //Montar o nome a ser salvo no BD
            $tipoDaImagem = strtolower(pathinfo($fotoProduto, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas
            $erroUpload   = false; //Variável para controle de erros do upload da foto

            //Verifica se o tamanho do arquivo é diferente de ZERO
            if($_FILES["fotoProduto"]["size"] != 0){

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
                echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
                $erroUpload = true;
            }

            //Se NÃO houver erro de preenchimento e NÃO houver erro no upload da foto
            if(!$erroPreenchimento && !$erroUpload){

                //Criar uma variável para armazenar a QUERY que realiza a inserção de dados do Usuário na tabela Usuarios
                $inserirProduto = "INSERT INTO Produtos (Usuarios_idUsuario, fotoProduto, nomeProduto, descricaoProduto, precoProduto, dataProduto, horaProduto, statusProduto) VALUES ('$idUsuario', '$fotoProduto', '$nomeProduto', '$descricaoProduto', '$precoProduto', '$dataProduto', '$horaProduto', 'disponivel')";

                //Inclui o arquivo de conexão com o Banco de Dados
                include "conexaoBD.php";

                //Se conseguir executar a QUERY para inserção, exibe alerta de sucesso e a tabela com os dados informados
                //A funçao mysqli_query executa operações no Banco de Dados
                if(mysqli_query($conn, $inserirProduto)){

                    echo "<div class='container'>";
                        echo "<div class='alert alert-success text-center'><strong>ANÚNCIO</strong> cadastrado com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 mb-3 text-center'>
                                    <img src='$fotoProduto' style='width:150px' title='Foto de $fotoProduto' class='img-thumbnail'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>TÍTULO DO ANÚNCIO</th>
                                        <td>$nomeProduto</td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIÇÃO DO ANÚNCIO</th>
                                        <td>$descricaoProduto</td>
                                    </tr>
                                    <tr>
                                        <th>VALOR DO ANÚNCIO</th>
                                        <td>R$ $precoProduto</td>
                                    </tr>
                                    <tr>
                                        <th>DATA DO ANÚNCIO</th>
                                        <td>$dataProduto às $horaProduto</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                    echo "</div>";
                }
                else{
                    echo "<div class='alert alert-danger text-center'>
                    Erro ao tentar inserir dados do<strong>ANÚNCIO</strong> no banco de dados $database!</div>" . mysqli_error($conn);
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