<?php

define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));
require_once __DIR__ . '/../src/config/auth.php';

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
elseif ($rota === 'logout') {
    $controller = new LoginController();
    $controller->logout();
}
elseif ($rota === 'painel') {
    $controller = new PainelController();
    $controller->index();
}
elseif ($rota === 'usuarios/novo') {
    $controller = new UserController();
    $controller->novo();
}
elseif ($rota === 'usuarios/criar') {
    $controller = new UserController();
    $controller->criar();
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
elseif ($rota === 'produtos/editar') {
    $controller = new ProductController();
    $controller->editar();
}
elseif ($rota === 'produtos/atualizar') {
    $controller = new ProductController();
    $controller->atualizar();
}
elseif ($rota === 'produtos/deletar') {
    $controller = new ProductController();
    $controller->deletar();
}
elseif ($rota === 'categorias') {
    $controller = new CategoryController();
    $controller->listar();
}
elseif ($rota === 'categorias/novo') {
    $controller = new CategoryController();
    $controller->novo();
}
elseif ($rota === 'categorias/criar') {
    $controller = new CategoryController();
    $controller->criar();
}
elseif ($rota === 'categorias/editar') {
    $controller = new CategoryController();
    $controller->editar();
}
elseif ($rota === 'categorias/atualizar') {
    $controller = new CategoryController();
    $controller->atualizar();
}
elseif ($rota === 'categorias/deletar') {
    $controller = new CategoryController();
    $controller->deletar();
}
elseif ($rota === 'fornecedores') {
    $controller = new SupplierController();
    $controller->listar();
}
elseif ($rota === 'fornecedores/novo') {
    $controller = new SupplierController();
    $controller->novo();
}
elseif ($rota === 'fornecedores/criar') {
    $controller = new SupplierController();
    $controller->criar();
}
elseif ($rota === 'fornecedores/editar') {
    $controller = new SupplierController();
    $controller->editar();
}
elseif ($rota === 'fornecedores/atualizar') {
    $controller = new SupplierController();
    $controller->atualizar();
}
elseif ($rota === 'fornecedores/deletar') {
    $controller = new SupplierController();
    $controller->deletar();
}
else {
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
    echo "<p>A página que você procurou não existe.</p>";
    echo "<p><a href='" . BASE_URL . "/?rota=home'>Voltar para o início</a></p>";
}