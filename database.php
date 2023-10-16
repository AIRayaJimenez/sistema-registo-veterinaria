<?php 

function conectarDB(): mysqli{
     $db=mysqli_connect('localhost', 'root', 'tigre123', 'crud veterinaria');

     if(!$db){
        echo "Error no se puedo conectar";
        exit;
     }
    
     return $db;

    }

    function estaAuntenticado() : bool{
      session_start();

      $auth=$_SESSION['login'];
      if(!$auth){
        return true;
      }
      return false;
      

    }