<?php




//Importar la conexión

require 'database.php';
$db=conectarDB();
//Crear un email y password

$email='pethelp@correo.com';
$password="123456";

$email2='catherine@correo.com';
$password2='123456';

//HASHEO DEL PASSWORD
$passwordHash=password_hash($password,PASSWORD_DEFAULT);
//Query para crear el usuario

$query= "INSERT INTO usuarios(email, password) VALUES ('$email', '$passwordHash');";

echo $query;

//Detener inserccion
exit;

//Agregarlo a la base de datos

mysqli_query($db, $query);
