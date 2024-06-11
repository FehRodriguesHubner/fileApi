<?php

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/',$_SERVER['REQUEST_URI']);
$request = $request[count($request) - 1];

switch ($method) {
    case 'POST':
        checkApiKey();
        require_once __DIR__ . '/services/post.php';
        handlePost($request);
        break;
    case 'DELETE':
        checkApiKey();
        require_once __DIR__ . '/services/delete.php';
        handleDelete($request);
        break;
    case 'GET':
        require_once __DIR__ . '/services/get.php';
        handleGet($request);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
        break;
}


function checkApiKey() {
    global $apiSecret;
    $headers = getallheaders();
    if (isset($headers['x-secret'])) {
        $apiKey = $headers['x-secret'];
        // Verifique a chave de API (aqui está um exemplo simples)
        $validApiKey = $apiSecret;
        if ($apiKey === $validApiKey) {
            return true;
        } else {
            http_response_code(403);
            die(json_encode(['error' => 'Acesso negado. Chave de API inválida.']));
        }
    } else {
        http_response_code(403);
        die(json_encode(['error' => 'Acesso negado. Chave de API inválida.']));
    }
}