<?php

    //CONEXION BASE DE DATOS
    require 'database.php';
    $db=conectarDB();

    $errores=[];

    //NOS MUESTRA ARREGLO VACIO, POR ESO DEBEMOS AGREGAR REQUEST_METHOD
    //var_dump($_POST);


    if($_SERVER['REQUEST_METHOD']==='POST'){
    
        
        //VALIDACION BACKEND, pero tambien validar EN EL FRONTEND y SANITIZACION DE DATOS
        $email=mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

        $password=mysqli_real_escape_string($db, $_POST['password']);


        if(!$email){
            $errores="EL email es obligatorio o no es válido";

        }

        if(!$password){
            $errores="El email no es válido";
        }
        
        if(empty($errores)){
            $query = "SELECT * FROM usuarios WHERE email= '$email';";
            $resultado=mysqli_query($db, $query);

            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario=mysqli_fetch_assoc($resultado); //ESTE TRAE LOS DATOS DE LA BASE DE DATOS

                //VERIFICAR si el password es correcto o no

                $auth=password_verify($password, $usuario['password']);

               if($auth){
                //El usuario está auntentificado
                
                session_start();

                //LLenar el arreglo de la sesión

                $_SESSION['usuario']= $usuario['email'];
                $_SESSION['login']= true;


                header('Location:/app.php');


               } else{
                 $errores[]="El password es incorrecto";
               }


            } else{
                $errores[]="El usuario no existe";
            }

        }




    }


?>












<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Home - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>



 
        <div class="wrapper">
            <form method="POST">
                <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo $error; ?>

                </div>

               <?php endforeach ?>
               <h1>¡Bienvenido!</h1>
                <h2>Iniciar sesión</h2>
                <div class="input-box">
                    <label for="email"></label>
                    <input type="email" name="email" placeholder=" Correo del usuario" id="email" required>
                    <i class='bx bxs-user'></i>

                </div>
                <div class="input-box">
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="Contraseña" id="password" required>
                    <i class='bx bxs-lock-alt' ></i>

                </div>

             

                <button type="submit" class="btn">Iniciar Sesión</button>

               
            </form>

        </div>

    
</body>
</html>