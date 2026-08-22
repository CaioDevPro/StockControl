<?php
class CategoryController {

    private CategoryModel $model;

    public function __construct() {
        $this->model = new CategoryModel();
    }

    // Lista as categorias (Read)
    public function listar() {
        exigirLogin();
        $categorias = $this->model->listarTodos();
        include __DIR__ . '/../views/categorias/listar.php';
    }

    // Mostra o formulário de cadastro
    public function novo() {
        exigirLogin();
        include __DIR__ . '/../views/categorias/novo.php';
    }

    // Processa o formulário (Create)
    public function criar() {
        exigirLogin();

        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=categorias/novo&erro=' . urlencode($erro));
            exit;
        }

        $this->model->criar($dados);

        header('Location: ' . BASE_URL . '/?rota=categorias&msg=criado');
        exit;
    }

    // Mostra o formulário de edição, já preenchido
    public function editar() {
        exigirLogin();

        $id = (int)($_GET['id'] ?? 0);
        $categoria = $this->model->buscarPorId($id);

        if (!$categoria) {
            header('Location: ' . BASE_URL . '/?rota=categorias&msg=nao_encontrado');
            exit;
        }

        include __DIR__ . '/../views/categorias/editar.php';
    }

    // Processa o formulário de edição (Update)
    public function atualizar() {
        exigirLogin();

        $id = (int)($_POST['id'] ?? 0);

        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=categorias/editar&id=' . $id . '&erro=' . urlencode($erro));
            exit;
        }

        $this->model->atualizar($id, $dados);

        header('Location: ' . BASE_URL . '/?rota=categorias&msg=atualizado');
        exit;
    }

    // Remove uma categoria (Delete) - apenas administradores
    public function deletar() {
        exigirAdmin();

        $id = (int)($_GET['id'] ?? 0);
        $this->model->deletar($id);

        header('Location: ' . BASE_URL . '/?rota=categorias&msg=excluido');
        exit;
    }

    // Validação básica
    private function validar(array $dados): ?string {
        if ($dados['nome'] === '') {
            return 'O nome da categoria é obrigatório.';
        }
        return null;
    }
}