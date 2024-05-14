// Script para alternar a visibilidade da senha
document.getElementById("togglePassword").addEventListener("click", function() {
    const senhaInput = document.getElementById("senha");
    const tipo = senhaInput.getAttribute("type") === "password" ? "text" : "password";
    senhaInput.setAttribute("type", tipo);
    // Troca o ícone do botão
    this.querySelector("i").classList.toggle("bi-eye");
    this.querySelector("i").classList.toggle("bi-eye-slash");
});