<?php
class LoginController {
    // Mostra o formulário de login
    public function index() {
        include __DIR__ . '/../views/login/index.php';
    }

    // Processa o formulário quando enviado (POST)
    public function login() {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            header('Location: /?rota=login&erro=1');
            exit;
        }

        $user = new User($email, $password);

        if ($user->login_validate()) {
            header('Location: /?rota=home');
            exit;
        } else {
            header('Location: /?rota=login&erro=1');
            exit;
        }
    }
}