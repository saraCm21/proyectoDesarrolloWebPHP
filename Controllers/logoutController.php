<?php
// filepath: d:\Documentos D\act1_sara_castellano_desarrollo_web_2025-1\Controllers\logoutController.php

session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al login
header('Location: ../../Views/loginFrames/loginFrame.html');
exit;