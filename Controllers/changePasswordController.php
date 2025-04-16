<?php
require_once __DIR__ . '/../bootstrap.php';

use Src\Models\Entities\Usuario;
use Src\Models\Services\ChangePassword;
use Src\Models\Services\SendEmail;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'changePassword':
            changePassword();
            break;
        case 'sendEmail':
            sendEmail();
            break;
        default:
            header('Location: ../Views/loginFrame/loginFrame.html');
            exit;
    }
}


function sendEmail(){
    $email = $_POST['email'] ?? '';

    $usuario = Usuario::where('email', $email)->first();
    if (!$usuario) {
       header('Location: ../Views/loginFrame/loginFrame.html?error=email_not_found');
        exit;
    }

    $sendEmail = new SendEmail();
    if ($sendEmail->sendEmail($email)) {
        header('Location: ../Views/loginFrame/changePasswordFrame.html?email=' . urlencode($email));
        exit;
    } else {
        header('Location: ../Views/loginFrame/loginFrame.html?error=email_failed');
        exit;
    }
}

function changePassword() { 
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $code = $_POST['code'] ?? '';   

    if (empty($email) || empty($password)|| empty($code)) {
        header('Location: ../Views/changePasswordFrame/changePasswordFrame.html?error=missing_fields'); // falta poner la alerta
        exit;
    }
 
    $usuario = Usuario::where('email', $email)->first();
    if (!$usuario) {
        header('Location: ../Views/loginFrame/changePasswordFrame.html?error=email_not_found');
        exit;
    }

    if (trim($usuario->cod_recuperacion) !== trim($code)) {
        header('Location: ../Views/loginFrame/changePasswordFrame.html?error=invalid_code');
        exit;
    }

    $changePasswordService = new ChangePassword();

    if($changePasswordService->changePassword($code, $password, $email)){
        header('Location: ../Views/loginFrame/loginFrame.html?success=password_updated');
    }else{
        header('Location: ../Views/loginFrame/changePasswordFrame.html?error=invalid_code'); 
    }
    exit;
}
