<?php
declare(strict_types=1);

class User{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password){
        if($email === "")    throw new Exception("Erro no requerimento: campo [EMAIL] inválido", 1);
        if($password === "") throw new Exception("Erro no requerimento: campo [SENHA] inválido", 1);
        $this->email    = $email;
        $this->password = $password;
    }
    public function login_validate(){
        if(($arquivo = fopen("../bd/users.csv", 'r')) !==false){
            while(true){
                $data = fgetcsv($arquivo, 1000, ';');
                if(!isset($data[1]) || !isset($data[2])) break;
                if($data[1] == $this->email){
                    if(password_verify($this->password, $data[2])){
                        return true;
                    }
                }
            }
        return false;
        }
    }
}
?>