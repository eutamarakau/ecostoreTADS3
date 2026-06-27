<?php include 'header.php'; ?>

<?php 
    if(isset($_GET['idProduto'])) {
        $idProduto = $_GET['idProduto'];
    }
    include 'conexaoBD.php';

    $buscarProduto = "SELECT * FROM produtos WHERE idProduto = $idProduto";
    $resProduto = mysqli_query($conn, $buscarProduto);
    if(mysqli_num_rows($resProduto) > 0){
        $produto = mysqli_fetch_assoc($resProduto);
        $precoProduto = $produto['precoProduto'];
        $idUsuario = $_SESSION['idUsuario'];

        $inserirPedido = "INSERT INTO pedidos (idUsuario, idProduto, preco, statusPedido)
                          VALUES ($idUsuario, $idProduto, $precoProduto, 'em processamento')";

        if(mysqli_query($conn, $inserirPedido)){
            echo "
                <div class='container'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='alert alert-success text-center mt-5'>
                            <h1>Sucesso!</h1>
                            <p>Sua compra foi realizada com sucesso!</p>
                            <a href='index.php' class='btn btn-primary'>Continuar comprando</a>
                            <a href='minhasCompras.php' class='btn btn-primary'>Minhas Compras</a>
                            </div>
                        </div>
                    </div>
                </div>
            ";

            $attProduto = "UPDATE produtos SET statusProduto = 'finalizado' WHERE idProduto = $idProduto";
            mysqli_query($conn, $attProduto);
        }
        else{
            echo "<div class='alert alert-danger text-center'>Erro ao processar seu pedido. Por favor, tente novamente.</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger text-center'>Produto não encontrado!</div>";
    }


?>









<?php include 'footer.php'; ?>