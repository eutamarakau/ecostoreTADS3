<?php 
    include "header.php";
    include "conexaoBD.php";
    $idProduto = $_GET['idProduto'];
    $deletarProduto = "DELETE FROM produtos WHERE idProduto = $idProduto";
    if(mysqli_query($conn, $deletarProduto)){
        echo "<div class='alert alert-success text-center mt-3'><strong>PRODUTO</strong> deletado com sucesso!</div>";
        echo "<div class='text-center mb-5'>
                <a href='index.php' class='btn btn-outline-dark'>
                    <i class='bi bi-house me-1'></i>
                    Voltar para a Página Inicial
                </a>
            </div>";
    }
    else{
        echo "<div class='alert alert-danger text-center'>
        Erro ao tentar deletar dados do<strong>PRODUTO</strong> no banco de dados $database!</div>" . mysqli_error($conn);
    }




    include "footer.php";
?>