<?php

session_start();
require_once '../Src/Models/Services/LoginService.php'; 
use Src\Models\Services\LoginService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $loginService = new LoginService();
    $esValido = $loginService->login($username, $password);

    if ($esValido) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); // Redirigir la siguiente página después de iniciar sesión
        exit;
    } else {
        header('Location: ../../Views/loginFrame/loginFrame.html?error=login_failed');
    }
}else {
    header('Location: login.php');
    exit;
}
?>