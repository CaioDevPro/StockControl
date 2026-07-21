<?php
require_once '../model/user_model.php';

$email = trim($_POST['email']);
$password = trim($_POST['password']);
echo $email, $password;

$novo_login = new User($email, $password);
if($novo_login->login_validate()){
    header("Location: ../view/html/success.html");
}else{
    header("Location: ../view/html/fail.html");
}
?>