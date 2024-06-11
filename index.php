<?php
header('Content-Type: application/json');

// CONTROLE DE TAMANHO DA REQUISIÇÃO
if ($_SERVER['CONTENT_LENGTH'] > $postMaxSize) { // 10 MB em bytes
    http_response_code(400);
    die(json_encode(['error' => 'Dados ultrapassam o limite de 10MB']));
}

require_once __DIR__ . '/env.php';
require_once __DIR__ . '/router.php';

define('UPLOAD_DIR', __DIR__ . '/uploads/');

if (!file_exists(UPLOAD_DIR)) {
    http_response_code(503);
    die();
}

require_once __DIR__ . '/controller.php';

?>