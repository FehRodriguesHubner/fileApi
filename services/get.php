<?php
function handleGet($request) {
    $id = $request;
    $filePath = UPLOAD_DIR . $id;

    if (file_exists($filePath)) {
        header('Content-Type: ' . mime_content_type($filePath));
        readfile($filePath);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Arquivo não encontrado']);
    }

}