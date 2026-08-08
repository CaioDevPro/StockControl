<?php
declare (strict_types=1);
require_once __DIR__ . '/../../models/user_model.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['User'];
print_r($user);
?>