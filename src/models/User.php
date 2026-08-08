<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) session_start();

class User{
    protected string $email;
    protected string $password;
    protected ?int $id;
    protected ?string $name;
    protected ?int $cpf;
    protected ?bool $adm;

    public function __construct(string $email, string $password, ?int $id = null, ?string $name = null, ?int $cpf = null, ?bool $adm = null){
        if($email === "")    throw new Exception("Erro no requerimento: campo [EMAIL] inválido", 1);
        if($password === "") throw new Exception("Erro no requerimento: campo [SENHA] inválido", 1);
        $this->id       = $id;
        $this->name     = $name;
        $this->cpf      = $cpf;
        $this->email    = $email;
        $this->adm      = $adm;
        $this->password = $password;
    }

    public function login_validate(){
        if(($arquivo = fopen(__DIR__ . "/../../bd/users.csv", 'r')) !==false){
            while(true){
                $data = fgetcsv($arquivo, 1000, ';');
                if(!isset($data[3]) || !isset($data[5])) break;
                $id = str_replace("\xEF\xBB\xBF", "", $data[0]); 
                $name = strval($data[1]);
                $cpf = intval($data[2]);
                $email = strval($data[3]);
                $adm = $data[4];
                if(filter_var($adm, FILTER_VALIDATE_BOOLEAN)) $adm = true;
                else $adm = false;
                if($email == $this->email){
                    if(password_verify($this->password, $data[5])){
                        $this->id = (int)$id;
                        $this->name = $name;
                        $this->cpf = $cpf;
                        $this->email = $email;
                        $this->adm = $adm;
                        $this->password = "none";
                        $_SESSION['User'] = $this;
                        return true;
                    }
                }
            }
        return false;
        }
    }
}
?>