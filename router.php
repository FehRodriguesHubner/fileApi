<?php
// Configure CORS

if (isset($_SERVER['HTTP_ORIGIN'])) {

    if(isset($allowedOrigins)){
        if (in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type');
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Origem não permitida']);
            exit;
        }
    }else{
        header('Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
    }
    
}

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

