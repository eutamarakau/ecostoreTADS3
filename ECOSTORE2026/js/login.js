document.addEventListener("DOMContentLoaded", () => {
    const formLogin = document.getElementById("formLogin");

    formLogin.addEventListener("submit", function(event) {
        event.preventDefault();

        alert("Login realizado com sucesso! ");

        form.reset();

        // Redirecionar depois de 1 segundo
        setTimeout(() => {
            window.location.href = "index.php";
        }, 1000);
    });
});