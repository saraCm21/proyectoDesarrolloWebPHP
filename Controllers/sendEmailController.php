<?php
require_once __DIR__ . '/../bootstrap.php';

use Src\Models\Entities\Usuario;
use Src\Models\Services\SendEmail;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $usuario = Usuario::where('email', $email)->first();
    if (!$usuario) {
        header('Location: ../Views/loginFrame/loginFrame.html?error=email_required');
        exit;
    }

    $sendEmail = new SendEmail();
    if ($sendEmail->sendEmail($email)) {
        header('Location: ../Views/loginFrame/loginFrame.html?success=email_sent');
        exit;
    } else {
        header('Location: ../Views/loginFrame/loginFrame.html?error=email_failed');
        exit;
    }
    
}