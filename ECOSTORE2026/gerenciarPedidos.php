<?php include 'header.php'; 
      include 'conexaoBD.php';
?>

        <div class="container mt-4">

            <h1 class="mb-4">Gerenciar Pedidos</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID do Pedido</th>
                        <th>Produto</th>
                        <th>Preço Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        // QUERY para buscar os pedidos do usuário logado
                        $idUsuario = $_SESSION['idUsuario'];
                        $buscarPedidos = "SELECT pedidos.*, produtos.nomeProduto
                                          FROM pedidos, produtos
                                          WHERE pedidos.idProduto = produtos.idProduto";

                        $resPedidos = mysqli_query($conn, $buscarPedidos);

                        if(mysqli_num_rows($resPedidos) > 0){
                            while($pedido = mysqli_fetch_assoc($resPedidos)){
                                echo "<tr>";
                                echo "<td>{$pedido['idPedido']}</td>";
                                echo "<td>{$pedido['nomeProduto']}</td>";
                                echo "<td>R$ " . number_format($pedido['preco'], 2, ',', '.') . "</td>";
                                echo "<td>{$pedido['statusPedido']}</td>";
                                echo "</tr>";
                            }
                        }
                        else{
                            echo "<tr><td colspan='5' class='text-center'>Nenhum pedido encontrado.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

        </div>
<?php include 'footer.php'; ?>