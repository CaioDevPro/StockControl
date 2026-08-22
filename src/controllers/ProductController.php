<?php
class ProductController {

    private ProductModel $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    // Mostra o formulário de cadastro
    public function novo() {
        exigirLogin();
        include __DIR__ . '/../views/produtos/novo.php';
    }

    // Processa o formulário (Create)
    public function criar() {
        exigirLogin();

        $dados = [
            'descricao'      => trim($_POST['descricao'] ?? ''),
            'qtd'            => (int)($_POST['qtd'] ?? 0),
            'estoque_minimo' => (int)($_POST['estoque_minimo'] ?? 0),
            'preco'          => (float)($_POST['preco'] ?? 0),
            'id_categoria'   => $_POST['id_categoria'] ?? null,
            'id_fornecedor'  => $_POST['id_fornecedor'] ?? null,
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=produtos/novo&erro=' . urlencode($erro));
            exit;
        }

        $this->model->criar($dados);

        header('Location: ' . BASE_URL . '/?rota=produtos&msg=criado');
        exit;
    }

    // Lista os produtos (Read)
    public function listar() {
        exigirLogin();
        $produtos = $this->model->listarTodos();
        include __DIR__ . '/../views/produtos/listar.php';
    }

    // Mostra o formulário de edição, já preenchido
    public function editar() {
        exigirLogin();

        $id = (int)($_GET['id'] ?? 0);
        $produto = $this->model->buscarPorId($id);

        if (!$produto) {
            header('Location: ' . BASE_URL . '/?rota=produtos&msg=nao_encontrado');
            exit;
        }

        include __DIR__ . '/../views/produtos/editar.php';
    }

    // Processa o formulário de edição (Update)
    public function atualizar() {
        exigirLogin();

        $id = (int)($_POST['id'] ?? 0);

        $dados = [
            'descricao'      => trim($_POST['descricao'] ?? ''),
            'qtd'            => (int)($_POST['qtd'] ?? 0),
            'estoque_minimo' => (int)($_POST['estoque_minimo'] ?? 0),
            'preco'          => (float)($_POST['preco'] ?? 0),
            'id_categoria'   => $_POST['id_categoria'] ?? null,
            'id_fornecedor'  => $_POST['id_fornecedor'] ?? null,
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=produtos/editar&id=' . $id . '&erro=' . urlencode($erro));
            exit;
        }

        $this->model->atualizar($id, $dados);

        header('Location: ' . BASE_URL . '/?rota=produtos&msg=atualizado');
        exit;
    }

    // Remove um produto (Delete) - apenas administradores
    public function deletar() {
        exigirAdmin();

        $id = (int)($_GET['id'] ?? 0);
        $this->model->deletar($id);

        header('Location: ' . BASE_URL . '/?rota=produtos&msg=excluido');
        exit;
    }

    // Validações compartilhadas entre criar() e atualizar()
    private function validar(array $dados): ?string {
        if ($dados['descricao'] === '') {
            return 'A descrição é obrigatória.';
        }
        if ($dados['qtd'] < 0) {
            return 'A quantidade não pode ser negativa.';
        }
        if ($dados['estoque_minimo'] < 0) {
            return 'O estoque mínimo não pode ser negativo.';
        }
        if ($dados['preco'] <= 0) {
            return 'O preço deve ser maior que zero.';
        }
        return null;
    }
}