<?php
$alert ='';
session_start();
if(!empty($_SESSION['active']))
{
    header('location: sistema/');
}else{

if(!empty($_POST)){
    if(empty($_POST['usuario']) || empty($_POST['clave']))
    {
        $alert = 'Ingrese su usuario y su clave ';

    }else{
        require_once"conexion.php";
        $user= $_POST['usuario'];
        $pass =$_POST['clave'];

        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if($result > 0)
        {
            $data = mysqli_fetch_array($query);
            print_r($data);            
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data['idusuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['user'] = $data['usuario'];
            $_SESSION['rol'] = $data['rol'];

            header('location: sistema/');
        }else{
            $alert = 'El usuario o la clave  es incorrecto';
            session_destroy();
        }

    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Cursos</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<section id="container">
<form action="" method="post">
<h3>iniciar sesion </h3>
<img src="img/Logo.png" alt="login">

<input type ="text" name="usuario" placeholder="Usuario">
<input type ="password" name="clave" placeholder="Contraseña">
<div class="alert"><?php echo isset($alert)? $alert:'';?></div>  
<input type ="submit" value="Ingresar">

</form>

</section>

</body>

</html>