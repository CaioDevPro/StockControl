<?php
class ProductController {

    private ProductModel $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    // Mostra o formulário de cadastro
    public function novo() {
        include __DIR__ . '/../views/produtos/novo.php';
    }

    // Processa o formulário (Create)
    public function criar() {
        $dados = [
            'descricao'      => trim($_POST['descricao'] ?? ''),
            'qtd'            => (int)($_POST['qtd'] ?? 0),
            'estoque_minimo' => (int)($_POST['estoque_minimo'] ?? 0),
            'preco'          => (float)($_POST['preco'] ?? 0),
            'id_categoria'   => $_POST['id_categoria'] ?? null,
            'id_fornecedor'  => $_POST['id_fornecedor'] ?? null,
        ];

        if ($dados['descricao'] === '') {
            header('Location: ' . BASE_URL . '/?rota=produtos/novo&erro=1');
            exit;
        }

        $this->model->criar($dados);

        header('Location: ' . BASE_URL . '/?rota=produtos');
        exit;
    }

    // Lista os produtos (Read)
    public function listar() {
        $produtos = $this->model->listarTodos();
        include __DIR__ . '/../views/produtos/listar.php';
    }
}