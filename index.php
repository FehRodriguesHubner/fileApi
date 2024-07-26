<?php
header('Content-Type: application/json');


require_once __DIR__ . '/env.php';
require_once __DIR__ . '/router.php';

// CONTROLE DE TAMANHO DA REQUISIÇÃO
if ($_SERVER['CONTENT_LENGTH'] > $postMaxSize) { // 10 MB em bytes
    http_response_code(400);
    die(json_encode(['error' => 'Dados ultrapassam o limite de 10MB'.$_SERVER['CONTENT_LENGTH']]));
}

define('UPLOAD_DIR', __DIR__ . '/uploads/');

if (!file_exists(UPLOAD_DIR)) {
    http_response_code(503);
    die();
}

require_once __DIR__ . '/controller.php';

?>