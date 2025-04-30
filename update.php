<?php
include 'config.php';

$id = $_GET['id'];
$result = $connection->query("SELECT * FROM students WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE students SET fullname='$name', email='$email', age=$age WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al actualizar: " . $connection->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class ="body_ins_upd">
    <h2>Editar Estudiante</h2>
    <!--<form method="post">--> <!--NO SE HACE si no especifo action, usa la url actual con el id por GET-->

    <!-- En el action se agrega el id de la fila que estoy editando--> 
    <form action="update.php?id=<?= $row['id'] ?>" method="post">
        <h4>Nombre completo:</h4>
        <input type="text" name="fullname" value="<?= $row['fullname'] ?>" required><br>
        <h4>Email:</h4> 
        <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
        <h4>Edad:</h4> 
        <input type="number" name="age" value="<?= $row['age'] ?>" required><br>
        <input type="submit" value="Actualizar">
    </form>
    
</body>
</html>

