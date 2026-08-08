<?php

define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../src/controllers/' . $class . '.php';
    if (file_exists($file)) { require $file; return; }

    $file = __DIR__ . '/../src/models/' . $class . '.php';
    if (file_exists($file)) { require $file; return; }

    $file = __DIR__ . '/../src/config/' . $class . '.php';
    if (file_exists($file)) { require $file; return; }
});

$rota = $_GET['rota'] ?? 'home';

if ($rota === 'home' || $rota === '') {
    $controller = new HomeController();
    $controller->index();
} 
elseif ($rota === 'sobre') {
    echo "<h1>Sobre o StockControl</h1>";
    echo "<p>Sistema de controle de estoque desenvolvido para a disciplina Web 2.</p>";
    echo "<p><a href='" . BASE_URL . "/?rota=home'>Voltar para o início</a></p>";
} 
elseif ($rota === 'login') {
    $controller = new LoginController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    } else {
        $controller->index();
    }
}
elseif ($rota === 'produtos') {
    $controller = new ProductController();
    $controller->listar();
}
elseif ($rota === 'produtos/novo') {
    $controller = new ProductController();
    $controller->novo();
}
elseif ($rota === 'produtos/criar') {
    $controller = new ProductController();
    $controller->criar();
}
else {
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
    echo "<p>A página que você procurou não existe.</p>";
    echo "<p><a href='" . BASE_URL . "/?rota=home'>Voltar para o início</a></p>";
}