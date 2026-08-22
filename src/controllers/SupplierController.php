<?php
class SupplierController {

    private SupplierModel $model;

    public function __construct() {
        $this->model = new SupplierModel();
    }

    // Lista os fornecedores (Read)
    public function listar() {
        exigirLogin();
        $fornecedores = $this->model->listarTodos();
        include __DIR__ . '/../views/fornecedores/listar.php';
    }

    // Mostra o formulário de cadastro
    public function novo() {
        exigirLogin();
        include __DIR__ . '/../views/fornecedores/novo.php';
    }

    // Processa o formulário (Create)
    public function criar() {
        exigirLogin();

        $dados = [
            'cnpj'     => trim($_POST['cnpj'] ?? ''),
            'empresa'  => trim($_POST['empresa'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'telefone' => trim($_POST['telefone'] ?? ''),
            'endereco' => trim($_POST['endereco'] ?? ''),
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=fornecedores/novo&erro=' . urlencode($erro));
            exit;
        }

        $this->model->criar($dados);

        header('Location: ' . BASE_URL . '/?rota=fornecedores&msg=criado');
        exit;
    }

    // Mostra o formulário de edição, já preenchido
    public function editar() {
        exigirLogin();

        $id = (int)($_GET['id'] ?? 0);
        $fornecedor = $this->model->buscarPorId($id);

        if (!$fornecedor) {
            header('Location: ' . BASE_URL . '/?rota=fornecedores&msg=nao_encontrado');
            exit;
        }

        include __DIR__ . '/../views/fornecedores/editar.php';
    }

    // Processa o formulário de edição (Update)
    public function atualizar() {
        exigirLogin();

        $id = (int)($_POST['id'] ?? 0);

        $dados = [
            'cnpj'     => trim($_POST['cnpj'] ?? ''),
            'empresa'  => trim($_POST['empresa'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'telefone' => trim($_POST['telefone'] ?? ''),
            'endereco' => trim($_POST['endereco'] ?? ''),
        ];

        $erro = $this->validar($dados);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=fornecedores/editar&id=' . $id . '&erro=' . urlencode($erro));
            exit;
        }

        $this->model->atualizar($id, $dados);

        header('Location: ' . BASE_URL . '/?rota=fornecedores&msg=atualizado');
        exit;
    }

    // Remove um fornecedor (Delete) - apenas administradores
    public function deletar() {
        exigirAdmin();

        $id = (int)($_GET['id'] ?? 0);
        $this->model->deletar($id);

        header('Location: ' . BASE_URL . '/?rota=fornecedores&msg=excluido');
        exit;
    }

    // Validações básicas
    private function validar(array $dados): ?string {
        if ($dados['empresa'] === '') {
            return 'O nome da empresa é obrigatório.';
        }
        if ($dados['cnpj'] === '') {
            return 'O CNPJ é obrigatório.';
        }
        if (strlen($dados['cnpj']) !== 14 || !ctype_digit($dados['cnpj'])) {
            return 'O CNPJ deve conter exatamente 14 números (sem pontos ou traços).';
        }
        if ($dados['email'] !== '' && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            return 'O e-mail informado não é válido.';
        }
        return null;
    }
}