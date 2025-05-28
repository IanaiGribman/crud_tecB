<?php
// En php header sirve para enviar cabeceras HTTP al navegador
// estos cabeceras son importantes para el manejo de CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 1); 
error_reporting(E_ALL); 

// Este malnacido de aca abajo es el que hacia que no me funcionara, no se como llego aca pero es su culpa
// die("se ejecuta");

function sendCodeMessage($code, $message = ""){
    http_response_code($code);
    echo json_encode(["message" => $message]);
    exit();
}

// Respuesta correcta para solicitudes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    sendCodeMessage(200); // 200 OK
}

// Obtener el módulo desde la query string
$uri = parse_url($_SERVER['REQUEST_URI']);
$query = $uri['query'] ?? '';
parse_str($query, $query_array);
$module = $query_array['module'] ?? null;

// Validación de existencia del módulo
if (!$module){
    sendCodeMessage(400, "Módulo no especificado");
}

// Validación de caracteres seguros: solo letras, números y guiones bajos
if (!preg_match('/^\w+$/', $module)){
    sendCodeMessage(400, "Nombre de módulo inválido");
}

// Buscar el archivo de ruta correspondiente
$routeFile = __DIR__ . "/routes/{$module}Routes.php";

if (file_exists($routeFile)){
    require_once($routeFile);
}
else{
    sendCodeMessage(404, "Ruta para el módulo '{$module}' no encontrada");
}