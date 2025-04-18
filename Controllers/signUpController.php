<?php
require_once '../Src/Models/Services/SignUpService.php'; 
use Src\Models\Services\SignUpService;
use Src\Models\Entities\Usuario;
session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $signUpService = new SignUpService();   
    
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($email) || empty($username) || empty($password) || empty($name) || empty($role)) {
        header('Location: ../Views/loginFrame/signUpFrame.html?error=empty_fields');
        exit;
    } 

    $usuario = new Usuario([
        'codigo_usuario' => random_int(100000, 999999),
        'username' => $username,
        'password' => $password,
        'nombre' => $name,
        'email' => $email,
        'rol' => $role
    ]);
    
    $signUpUser = new SignUpService();
    $signUpUser->validateAndRegisterUser($usuario);

    if ($signUpUser) {
        header('Location: ../Views/loginFrame/loginFrame.html?success=1');
        exit;
    } else {
        $errorMessage = !empty($signUpUser['message']) ? $signUpUser['message'] : 'Ocurrió un error inesperado.';
        header('Location: ../Views/loginFrame/signUpFrame.html?error=' . urlencode($errorMessage));
        exit;
    }
} else {
    header('Location: ../Views/signUpFrame/signUpFrame.html');
    exit;
}