<?php 
session_start();

if ($_SESSION['rol'] != 1)
{
    header('location: ./');
}

include "../conexion.php";

if(!empty($_POST)){

    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || 
    empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']) || empty($_POST['curso']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{    

        $nombre =$_POST['nombre'];
        $email =$_POST['correo'];
        $user =$_POST['usuario'];
        $clave =$_POST['clave'];
        $rol =$_POST['rol'];
        $curso =$_POST['curso'];
       $query =mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo ='$email'");
       mysqli_close($conection);
       $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_errror">El correo o el usuario ya existe.</p>';
        }else{
            $query_insert =mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol,curso)
             VALUES('$nombre','$email','$user','$clave','$rol','$curso')");

             if($query_insert){

                $alert='<p class="msg_save">Usuario creado correctamente.</P>';
             }else{
                $alert='<p class="msg_error">Error al crear usuario.</P>';
             }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Registro Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1>Registro Usuario</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

    <form action=" " method="post" >              
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
        <label for="correo">Correo Electronico:</label>
        <input type="email" name="correo" id="correo" placeholder="Correo electronico">
        <label for="Usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario">                          
        <label for="clave">Clave:</label>        
        <input type="password" name="clave" id="clave" placeholder="Clave de acceso"> 
        <label for="curso">curso:</label>
        <select name="curso" id="curso">
            <?php
                 if($result_curso> 0)
                 {
                    while ($curso = mysqli_fetch_array($query_curso)){
        ?>
        <option value="<?php echo $curso["codcurso"];?>"><?php echo $curso["curso"] ?></option>
         <?php  
            # code...
                } 
            }
        ?>
    </select>
        <label for="rol">Tipo de  usuario:</label>

        <?php 
        $query_rol =mysqli_query($conection,"SELECT * FROM rol");        
        $query_curso =mysqli_query($conection,"SELECT * FROM curso");
        
        $result_rol = mysqli_num_rows($query_rol);
        $result_curso = mysqli_num_rows($query_curso);
        mysqli_close($conection); 
        ?>
        
        <select name="rol" id="rol">
            <?php
                 if($result_rol> 0)
                 {
                    while ($rol = mysqli_fetch_array($query_rol)){
        ?>
                
                    <option value="<?php echo $rol["idrol"];?>"><?php echo $rol["rol"] ?></option>
                    
                    
        <?php  
            # code...
                } 
            }
        ?>                                   
        </select>
        <input type="submit" value="Crear Usuario" class="btn_save">

    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>