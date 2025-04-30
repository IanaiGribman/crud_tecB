<?php
/**
 * Este es el script por donde comienza el sitio, el nombre index.php
 * es una convención estándar como puede serlo index.html
 */

/**
 * Al principio se incluye el archivo de configuración, que en este caso no es
 * una mala práctica porque está muy bien tener la conexión a la base de datos
 * en un solo lugar.
 */
include 'config.php';

/**
 * uso el objeto connection para ejecutar una consulta
 * a la base de datos.
 * query es una función("método") 
 */
$result = $connection->query("SELECT * FROM students");

/**
 * Con echo mostramos por "pantalla" (navegador web)
 * el html al cliente.
 */  
echo  "<!DOCTYPE html> 
       <html lang='es'> 
       <head> 
            <meta charset='UTF-8'> 
            <link rel='stylesheet' href='style.css'> 
       </head> 
       <body> 
            <header class='cabecera'>
                <h2>Listado de Estudiantes</h2> 
                <a href='insert.php'><button class = 'agregar'> Agregar nuevo </button>   </a>
            </header>
        <main class = 'principal'>";

if ($result->num_rows > 0) {
    echo  "<table border='1' cellpadding='10'>
           <tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['fullname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['age']}</td>
                <td>
                    <button class = 'editar'><a href='update.php?id={$row['id']}'>Editar</a> </button>
                    <button class = 'borrar'><a href='delete.php?id={$row['id']}'>Borrar</a></button>
                    
                    
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay estudiantes cargados.";
}
echo "</main>
     </body>
     </html>";
?>
