<?php
    //include "conexaoBD.php"; 
    include "header.php";  
?>
<!-- Formulário -->
<section class="py-5">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">Informações do Usuário</h4>

                        <form action="actionUsuario.php" method="POST" class="was-validated" enctype="multipart/form-data">

                            <div class="form-floating mt-3 mb-3">
                                <input type="file" class="form-control" id="fotoUsuario" placeholder="Foto" name="fotoUsuario" required>
                                <label for="fotoUsuario">Foto</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" id="nomeUsuario" placeholder="Nome" name="nomeUsuario" required>
                                <label for="nomeUsuario">Nome Completo</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="date" class="form-control" id="dataNascUsuario" placeholder="dataNascUsuario" name="dataNascUsuario" required>
                                <label for="dataNascUsuario">Data de Nascimento</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" id="telefoneUsuario" placeholder="(99) 99999-9999" name="telefoneUsuario" required>
                                <label for="telefoneUsuario">Telefone</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-floating mt-3 mb-3">
                                <input type="email" class="form-control" id="emailUsuario" placeholder="Email" name="emailUsuario" required>
                                <label for="emailUsuario">Email</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="password" class="form-control" id="senhaUsuario" placeholder="Senha" name="senhaUsuario" required>
                                <label for="senhaUsuario">Senha</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="password" class="form-control" id="confirmarSenhaUsuario" placeholder="Confirmar Senha" name="confirmarSenhaUsuario" required>
                                <label for="confirmarSenhaUsuario">Confirmar Senha</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <button type="submit" class="btn btn-success">Cadastrar Usuário</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>
