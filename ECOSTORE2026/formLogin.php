<?php include "header.php" ?>

<section class="py-5">
    <div class="container d-flex justify-content-center align-items-center">

        <div class="card shadow border-0 p-4" style="max-width: 400px; width:100%;">

            <h3 class="text-center fw-bold mb-4 text-success">
                Entrar na EcoStore
            </h3>

            <?php
                if(isset($_GET['erroLogin'])){
                    $erroLogin = $_GET['erroLogin'];

                    if($erroLogin == 'dadosInvalidos'){
                        echo "
                        <div class='alert alert-warning text-center'>
                            <strong>Usuário ou senha inválidos!</strong>
                        </div>";
                    }
                }
            ?>

            <form action="actionLogin.php" method="POST" class="was-validated">

                <div class="mb-3">
                    <label for="emailUsuario" class="form-label">
                        E-mail
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="emailUsuario"
                        name="emailUsuario"
                        placeholder="Digite seu e-mail"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="senhaUsuario" class="form-label">
                        Senha
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        id="senhaUsuario"
                        name="senhaUsuario"
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-success w-100 mb-3">
                    Entrar
                </button>

            </form>

            <hr>

            <p class="text-center mb-0">
                Ainda não possui cadastro?
                <a href="formUsuario.php" class="fw-bold text-success">
                    Clique aqui!
                </a>
            </p>

        </div>

    </div>
</section>

<?php include "footer.php" ?>
