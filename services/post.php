<?php
function handlePost($request) {
    $id = $request ?? uniqid();
    $jsonAppend = isset($_POST['jsonAppend']) && $_POST['jsonAppend'] == 'true';
    
    $filePath = UPLOAD_DIR . $id;
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        move_uploaded_file($file['tmp_name'], $filePath);
        
        echo json_encode([
            'id' => $id,
            'url' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/uploads/' . $id
        ]);

    } else if(isset($_POST['json'])){
        $newData = json_decode($_POST['json'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['error' => 'JSON inválido']);
            return;
        }

        $jsonData = $newData;

        if ($jsonAppend && mime_content_type($filePath) === 'application/json') {

            $existingData = json_decode(file_get_contents($filePath), true);
            
            if (json_last_error() === JSON_ERROR_NONE) {
                $jsonData = array_merge($existingData, $newData);
            }else{
                echo 'error json';
            }
        }

        file_put_contents($filePath, json_encode($jsonData));

        echo json_encode([
            'id' => $id,
            'url' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/uploads/' . $id
        ]);

    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Nenhum arquivo enviado']);
    }

}