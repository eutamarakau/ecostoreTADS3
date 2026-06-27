<?php include "header.php" ?>

    <?php
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $fotoUsuario = $nomeUsuario = $dataNascUsuario = $telefoneUsuario = $emailUsuario = $senhaUsuario = $confirmarSenhaUsuario = "";

            $erroPreenchimento = false;

            if(empty($_POST["nomeUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $nomeUsuario = filtrar_entrada($_POST["nomeUsuario"]);

                if(!preg_match('/^[\p{L} ]+$/u', $nomeUsuario)){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong>
                    deve conter APENAS LETRAS!</div>";
                    $erroPreenchimento = true;
                }
            }

            if(empty($_POST["dataNascUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>DATA DE NASCIMENTO</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $dataNascUsuario = filtrar_entrada($_POST["dataNascUsuario"]);

                if(strlen($dataNascUsuario) == 10){
                    $diaNascimentoUsuario = substr($dataNascUsuario, 8, 2);
                    $mesNascimentoUsuario = substr($dataNascUsuario, 5, 2);
                    $anoNascimentoUsuario = substr($dataNascUsuario, 0, 4);

                    if(!checkdate($mesNascimentoUsuario, $diaNascimentoUsuario, $anoNascimentoUsuario)){
                        echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA!</strong></div>";
                        $erroPreenchimento = true;
                    }

                }
                else{
                    echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA!</strong></div>";
                    $erroPreenchimento = true;
                }
            }

            if(empty($_POST["emailUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $emailUsuario = filtrar_entrada($_POST["emailUsuario"]);
            }

            if(empty($_POST["senhaUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>SENHA</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $senhaUsuario = md5(filtrar_entrada($_POST["senhaUsuario"]));
            }

            if(empty($_POST["confirmarSenhaUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $confirmarSenhaUsuario = md5(filtrar_entrada($_POST["confirmarSenhaUsuario"]));

                if($senhaUsuario != $confirmarSenhaUsuario){
                    echo "<div class='alert alert-warning text-center'>As <strong>SENHAS</strong> informadas são diferentes!</div>";
                    $erroPreenchimento = true;
                }
            }

            $diretorio    = "assets/img/"; //Define para qual diretório as imagens serão movidas
            $fotoUsuario  = $diretorio . basename($_FILES['fotoUsuario']['name']); //Montar o nome a ser salvo no BD
            $tipoDaImagem = strtolower(pathinfo($fotoUsuario, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas
            $erroUpload   = false; //Variável para controle de erros do upload da foto

            if($_FILES["fotoUsuario"]["size"] != 0){

                if($_FILES["fotoUsuario"]["size"] > 5000000){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                    $erroUpload = true;
                }

                if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                    echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar no formatos JPG, JPEG, PNG ou WEBP!</div>";
                    $erroUpload = true;
                }

                if(!move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $fotoUsuario)){
                    echo "<div class='alert alert-warning text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                    $erroUpload = true;
                }

            }
            else{
                echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
                $erroUpload = true;
            }
            if(empty($_POST["telefoneUsuario"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                $telefoneUsuario = filtrar_entrada($_POST["telefoneUsuario"]);

            }

            if(!$erroPreenchimento && !$erroUpload){

                $inserirUsuario = "
                                    INSERT INTO usuarios
                                    (
                                        fotoUsuario,
                                        nomeUsuario,
                                        dataNascUsuario,
                                        telefoneUsuario,
                                        emailUsuario,
                                        senhaUsuario
                                    )
                                    VALUES
                                    (
                                        '$fotoUsuario',
                                        '$nomeUsuario',
                                        '$dataNascUsuario',
                                        '$telefoneUsuario',
                                        '$emailUsuario',
                                        '$senhaUsuario'
                                    )";
                //Inclui o arquivo de conexão com o Banco de Dados
                include "conexaoBD.php";

                if(mysqli_query($conn, $inserirUsuario)){

                    echo "<div class='container'>";
                        echo "<div class='alert alert-success text-center'><strong>USUÁRIO</strong> cadastrado com sucesso!</div>";
                        echo "<div class='text-center'><strong> Confira seus dados abaixo!!!</strong></div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 mb-3 text-center'>
                                    <img src='$fotoUsuario' style='width:150px' title='Foto de $nomeUsuario' class='img-thumbnail'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>NOME</th>
                                        <td>$nomeUsuario</td>
                                    </tr>
                                    <tr>
                                        <th>DATA DE NASCIMENTO</th>
                                        <td>$diaNascimentoUsuario/$mesNascimentoUsuario/$anoNascimentoUsuario</td>
                                    </tr>
                                    <tr>
                                        <th>EMAIL</th>
                                        <td>$emailUsuario</td>
                                    </tr>
                                    <tr>
                                        <th>SENHA</th>
                                        <td>$senhaUsuario</td>
                                    </tr>
                                    <tr>
                                        <th>CONFIRMAÇÃO DE SENHA</th>
                                        <td>$confirmarSenhaUsuario</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                    echo "</div>";
                }
                else{
                    die(mysqli_error($conn));
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

    <div class="container d-flex justify-content-center align-items-center">
        <form method="POST" class="was-validated" enctype="multipart/form-data">
        <button class="btn btn-success w-80 mb-3">VOLTAR AO LOGIN</button>
            <!-- Bootstrap JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
            <script src="js/cadastro.js"></script>
        </form>
    </div>
   

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>

