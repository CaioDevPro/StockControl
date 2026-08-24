<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

class User {
    protected string $email;
    protected string $password;
    protected ?int $id;
    protected ?string $name;
    protected ?string $cpf;
    protected ?string $perfil;

    public function __construct(string $email, string $password, ?int $id = null, ?string $name = null, ?string $cpf = null, ?string $perfil = null){
        if($email === "")    throw new Exception("Erro no requerimento: campo [EMAIL] inválido", 1);
        if($password === "") throw new Exception("Erro no requerimento: campo [SENHA] inválido", 1);
        $this->id       = $id;
        $this->name     = $name;
        $this->cpf      = $cpf;
        $this->email    = $email;
        $this->perfil   = $perfil;
        $this->password = $password;
    }

    public function login_validate(): bool {
        $sql = "SELECT id, nome, cpf, email, senha, perfil FROM usuarios WHERE email = :email";
        $stmt = Database::getConexao()->prepare($sql);
        $stmt->execute([':email' => $this->email]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            return false;
        }

        if (password_verify($this->password, $usuario['senha'])) {
            $this->id       = (int)$usuario['id'];
            $this->name     = $usuario['nome'];
            $this->cpf      = $usuario['cpf'];
            $this->email    = $usuario['email'];
            $this->perfil   = $usuario['perfil'];
            $this->password = "none";

            $_SESSION['User'] = [
                'id'     => $this->id,
                'nome'   => $this->name,
                'email'  => $this->email,
                'perfil' => $this->perfil,
            ];

            return true;
        }

        return false;
    }

    // CREATE - Cadastra um novo usuário (RF01)
    public function cadastrar(string $nome, string $cpf): bool {
        $sql = "INSERT INTO usuarios (nome, cpf, email, senha, perfil)
                VALUES (:nome, :cpf, :email, :senha, 'user')";

        $senhaHash = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = Database::getConexao()->prepare($sql);

        return $stmt->execute([
            ':nome'  => $nome,
            ':cpf'   => $cpf,
            ':email' => $this->email,
            ':senha' => $senhaHash,
        ]);
    }
}