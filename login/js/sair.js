document.addEventListener("DOMContentLoaded", function() {
    var logoutLink = document.getElementById("logout");
    var confirmLogoutButton = document.getElementById("confirmLogout");
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    logoutLink.addEventListener("click", function(event) {
        event.preventDefault();
        confirmModal.show();
    });

    confirmLogoutButton.addEventListener("click", function() {
        // Aqui você pode implementar a lógica para deslogar o usuário
        // Redireciona para a página de logout PHP após a confirmação
        window.location.href = '../functions/logout.php';
    });

    // Fecha o modal se o usuário clicar no botão de fechar
    document.querySelectorAll('[data-dismiss="modal"]').forEach(function(element) {
        element.addEventListener("click", function() {
            confirmModal.hide();
        });
    });
});