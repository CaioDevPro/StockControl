<?php
class UserController {

    // Mostra o formulário de cadastro público
    public function novo() {
        include __DIR__ . '/../views/usuarios/novo.php';
    }

    // Processa o formulário de cadastro (Create)
    public function criar() {
        $nome     = trim($_POST['nome'] ?? '');
        $cpf      = trim($_POST['cpf'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $erro = $this->validar($nome, $cpf, $email, $password);

        if ($erro) {
            header('Location: ' . BASE_URL . '/?rota=usuarios/novo&erro=' . urlencode($erro));
            exit;
        }

        try {
            $user = new User($email, $password);
            $user->cadastrar($nome, $cpf);
        } catch (PDOException $e) {
            // Código 23000 = violação de UNIQUE (email ou CPF já cadastrado)
            if ($e->getCode() === '23000') {
                header('Location: ' . BASE_URL . '/?rota=usuarios/novo&erro=' . urlencode('E-mail ou CPF já cadastrado.'));
                exit;
            }
            throw $e;
        }

        header('Location: ' . BASE_URL . '/?rota=login&msg=cadastrado');
        exit;
    }

    // Validações básicas do cadastro
    private function validar(string $nome, string $cpf, string $email, string $password): ?string {
        if ($nome === '') {
            return 'O nome é obrigatório.';
        }
        if ($cpf === '' || strlen($cpf) !== 11 || !ctype_digit($cpf)) {
            return 'O CPF deve conter exatamente 11 números (sem pontos ou traços).';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Informe um e-mail válido.';
        }
        if (strlen($password) < 6) {
            return 'A senha deve ter no mínimo 6 caracteres.';
        }
        return null;
    }
}   