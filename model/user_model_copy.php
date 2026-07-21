<?php
declare(strict_types=1)

class User{
    protected string $name;
    protected string $cpf;
    protected string $email;
    protected string $password;
    protected bool $adm;

    public function __construct($name, $cpf, $email, $password){
        if($name === "")     throw new Exception("Erro no requerimento: campo [NOME] inválido", 1);
        if($cpf === "")      throw new Exception("Erro no requerimento: campo [CPF] inválido", 1);
        if($email === "")    throw new Exception("Erro no requerimento: campo [EMAIL] inválido", 1);
        if($password === "") throw new Exception("Erro no requerimento: campo [SENHA] inválido", 1);
        $this->name     = $name;
        $this->cpf      = $cpf;
        $this->email    = $email;
        $this->password = $password;
        $this->adm = false;
    }
    public function login_validate(string $email, string $password): bool{
        if(($arquivo = fopen("../bd/users.csv", 'r')) !==false){
            print_r($arquivo);
        }
        return;
    }

} 
?>