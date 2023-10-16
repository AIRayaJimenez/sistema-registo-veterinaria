<?php 


require 'database.php';
$auth=estaAuntenticado();

if(!$auth){
  header('Location/index.php');
}

        
        //IMPORTAR LA CONEXION
        
        $db=conectarDB();

        //ESCRIBIR EL QUERY

        $query="SELECT * FROM registros";


        //CONSULTAR LA BD

        $resultadoConsulta=mysqli_query($db, $query);

    //Muestra mensaje condicional

    $resultado=$_GET['resultado']??null;

      if($_SERVER['REQUEST_METHOD']==='POST'){

        

        $id=$_POST['id'];
        $id=filter_var($id, FILTER_VALIDATE_INT);

        //Eliminar el registro
        if($id){
          $query="DELETE FROM registros WHERE  idpaciente=$id";
          $resultadoConsulta=mysqli_query($db, $query);

          if($resultadoConsulta){
            header('location:/app.php?resultado=3');
          }
        }
      }


?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_registros.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>

<nav class="menu-container">
    <!-- burger menu -->
    <input type="checkbox" aria-label="Toggle menu" />
    <span></span>
    <span></span>
    <span></span>

    <!-- menu items -->
    <div class="menu">
      <ul>
        <li>
          <a href="app.php">
            Inicio
          </a>
        </li>
        <li>
          <a href="register.php">
            Nuevo registro
          </a>
        </li>
      
      </ul>
      <ul>
        <li>
        <a href="cerrar-sesion.php">
            Cerrar sesión
          </a>
        </li>
       
      </ul>
    </div>
  </nav>


<section>

      <h2 class="titulo_registros">REGISTROS DE PACIENTES</h2>

    <table class="propiedades">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Mascota</th>
                   <th>Raza</th>
                   <th>Dueño</th>
                   <th>Fecha</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($registro=mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr class="datos">
                    <td><?php echo $registro['idpaciente']; ?> </td>
                    <td class="nombre_mascota"><?php echo $registro['mascota']; ?> </td>
                    <td><?php echo $registro['especie']; ?> </td>
                    <td><?php echo $registro['nombrepropietario']; ?> </td>
                    <td><?php echo $registro['fecha']; ?> </td>
                    <td class="botones_accion">
                        <a href="ficha.php?id=<?php echo $registro['idpaciente'];?>" class="button ">Ver registro</a> 
                    </td>
                    <td class="botones_accion">
                        <a href="actualizar.php?id=<?php echo $registro['idpaciente'];?>" class="button ">Actualizar</a>
                    </td>
                    <td class="botones_accion">
                          <form method="POST" class="w-100" >
                          <input type="hidden" name="id" value="<?php echo $registro['idpaciente']; ?>">
                          <input type="submit" class="button" value="Eliminar"></input>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

    </table>
    </section>










    <?php
    mysqli_close($db);
    ?>
    
</body>
</html>