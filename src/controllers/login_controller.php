<?php
require_once '../model/user_model.php';

$email    = strval(trim($_POST['email']));
$password = strval(trim($_POST['password']));
if($email == "" || $password == "") header("Location: ../view/html/fail.html");

$novo_login = new User($email, $password);
print_r($novo_login);
if($novo_login->login_validate()){
    header("Location: ../view/html/index.php");
}else{
    header("Location: ../view/html/fail.html");
}
?>