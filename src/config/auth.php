<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Verifica se existe um usuário logado; se não, redireciona pro login
function exigirLogin(): void {
    if (!isset($_SESSION['User'])) {
        header('Location: ' . BASE_URL . '/?rota=login&erro=1');
        exit;
    }
}

// Verifica se o usuário logado é admin; se não, bloqueia o acesso
function exigirAdmin(): void {
    exigirLogin();
    if ($_SESSION['User']['perfil'] !== 'admin') {
        http_response_code(403);
        echo "<h1>403 - Acesso negado</h1>";
        echo "<p>Você não tem permissão para acessar esta página.</p>";
        echo "<p><a href='" . BASE_URL . "/?rota=produtos'>Voltar</a></p>";
        exit;
    }
}