<?php
//Los controllers son los encargados de manejar las peticiones HTTP y llamar a los modelos correspondientes
require_once("./models/students.php");


function handleGet($conn) {
    if (isset($_GET['id'])) {
        // Si se especifica un ID, se obtiene un estudiante específico
        $result = getStudentById($conn, $_GET['id']);
        // $result puede ser un objeto mysqli_result o false si no se encontró el estudiante
        // result_fetch_assoc() convierte el resultado en un array asociativo
        echo json_encode($result->fetch_assoc());
    } 
    else {
        // Si no se especifica un ID, se obtienen todos los estudiantes
        $result = getAllStudents($conn);
        $data = [];
        // este while es para recorrer el resultado de la consulta y convertirlo en un array
        while ($row = $result->fetch_assoc()) 
            $data[] = $row;
        echo json_encode($data);
    }
}

function handlePost($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (createStudent($conn, $input['fullname'], $input['email'], $input['age'])) {
        echo json_encode(["message" => "Estudiante agregado correctamente"]); 
    }
    else {
        http_response_code(500);
        // esto es un json que se envía al cliente en caso de error
        echo json_encode(["error" => "No se pudo agregar"]);
    }
}

function handlePut($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (updateStudent($conn, $input['id'], $input['fullname'], $input['email'], $input['age'])){ 
        echo json_encode(["message" => "Actualizado correctamente"]);
    }
    else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo actualizar"]);
    }
}

function handleDelete($conn) {
    $input = json_decode(file_get_contents("php://input"), true);
    if (deleteStudent($conn, $input['id'])) {
        echo json_encode(["message" => "Eliminado correctamente"]); 
    }
    else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo eliminar"]);
    }
}
?>