<?php 
    include "conexaoBD.php";
    session_start();

    $emailUsuario = mysqli_real_escape_string($conn, $_POST['emailUsuario']);
    $senhaUsuario = mysqli_real_escape_string($conn, $_POST['senhaUsuario']);

    $buscarLogin = "SELECT *
                    FROM usuarios
                    WHERE emailUsuario = '{$emailUsuario}'
                    AND senhaUsuario = md5('{$senhaUsuario}') ";

    $efetuarLogin = mysqli_query($conn, $buscarLogin);

    if ($registro = mysqli_fetch_assoc($efetuarLogin)){

        $_SESSION['idUsuario'] = $registro['idUsuario'];
        $_SESSION['nomeUsuario'] = $registro['nomeUsuario'];
        $_SESSION['emailUsuario'] = $registro['emailUsuario'];
        $_SESSION['nivelUsuario'] = $registro['nivelUsuario'];
        $_SESSION['logado'] = true;

        header("Location: index.php");
        exit();
    }
    else{
        header("Location: formLogin.php?erroLogin=dadosInvalidos");
        exit();
    }

?>
