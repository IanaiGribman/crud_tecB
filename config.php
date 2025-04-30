<?php
/**
 * Datos de conexión: en variables en php.
 */
$host = "localhost"; //indico el host
$user = "students_user"; //indico nombre de usuario 
$password = "12345"; //cargo la plataforma que utilizara connection para conectarse
$database = "students_db"; //indico de que base de datos sacar los datos

/**
 * $connection "variable", objeto instancia de mysqli
 * La extensión mysqli (mysql improved) permite acceder 
 * a la funcionalidad proporcionada por MySQL 4.1 y posterior. 
 * Se puede encontrar más información sobre el servidor de base 
 * de datos MySQL en » http://www.mysql.com/
 * 
 * instancio una conexión a la base de datos con las variables
 * definidas arriba.
 */
$connection = new mysqli($host, $user, $password, $database);

/**
 * Verificar conexión, si hay error corto interpretación con la función "die"
 * y muestro por pantalla el error. "Modo Desarrollo"
 */ 
if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}
?>
