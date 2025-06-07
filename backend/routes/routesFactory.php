<?php
/**
*    File        : backend/routes/routesFactory.php
*    Project     : CRUD PHP
*    Author      : Tecnologías Informáticas B - Facultad de Ingeniería - UNMdP
*    License     : http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
*    Date        : Mayo 2025
*    Status      : Prototype
*    Iteration   : 3.0 ( prototype )
*/

function routeRequest($conn, $customHandlers = [], $prefix = 'handle') 
{
    $method = $_SERVER['REQUEST_METHOD'];

    // Lista de handlers CRUD por defecto
    $defaultHandlers = [
        'GET'    => $prefix . 'Get',
        'POST'   => $prefix . 'Post',
        'PUT'    => $prefix . 'Put',
        'DELETE' => $prefix . 'Delete'
    ];

    // Sobrescribir handlers por defecto si hay personalizados
    $handlers = array_merge($defaultHandlers, $customHandlers);

    if (!isset($handlers[$method])) 
    {
        http_response_code(405);
        echo json_encode(["error" => "Método $method no permitido"]);
        return;
    }

    $handler = $handlers[$method];
    // a la variable $handler le asignamos el nombre de la función que corresponde al método HTTP actual.
    // Por ejemplo, si el método es GET, $handler será 'handleGet'.

    if (is_callable($handler)) 
    {
        $handler($conn);
        // Si handler es llamable, lo ejecutamos pasando la conexión a la base de datos.
        // Por ejemplo, si el método es GET, se ejecutará la función handleGet($conn).
    }
    else
    {
        http_response_code(500);
        echo json_encode(["error" => "Handler para $method no es válido"]);
    }
}
