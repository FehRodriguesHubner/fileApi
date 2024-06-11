<?php
function handleDelete($request) {
    $id = $request;
    $filePath = UPLOAD_DIR . $id;

    if (file_exists($filePath)) {
        unlink($filePath);
        echo json_encode(['message' => 'Arquivo deletado com sucesso']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Arquivo não encontrado']);
    }
}