<?php include "header.php" ?>

    <!-- Seção para conteúdo da página -->
    <section class="py-5">
         <div class="d-flex justify-content-center mb-5">
             <div class="row justify-content-center">
                <div class="col-md-150 col-lg-200">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                    
                            <h4 class="text-center mb-4">Cadastro de produto</h4>


                            <form action="actionProduto.php" method="POST" class="was-validated" enctype="multipart/form-data">

                                <div class="form-floating mt-3 mb-3">
                                    <input type="file" class="form-control" id="fotoProduto" placeholder="Foto" name="fotoProduto">
                                    <label for="fotoProduto">Foto do Produto</label>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto" name="nomeProduto">
                                    <label for="nomeProduto">Nome do Produto</label>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-floating mt-3 mb-3">
                                    <textarea class="form-control" id="descricaoProduto" 
                                    placeholder="Informe uma breve descrição sobre o seu anúncio" name="descricaoProduto"></textarea>
                                    <label for="descricaoProduto">Descrição do Produto</label>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" id="precoProduto" placeholder="Valor do Produto" name="precoProduto">
                                    <label for="precoProduto">Valor do Produto</label>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Criar Produto</button>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>

    </section>

<?php include "footer.php" ?>