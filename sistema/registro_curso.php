<?php 
session_start();



include "../conexion.php";

if(!empty($_POST)){

    $alert='';
    if(empty($_POST['curso']) || empty($_POST['descripcion']) || 
    empty($_POST['horas']) || $_POST['horas'] <= 0 )
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</P>';
    }else{    

        $curso =$_POST['curso'];
        $descripcion =$_POST['descripcion'];
        $precio =$_POST['horas'];
       
        

        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $imgcurso = 'img_curso.png';

            if($nombre_foto != '') {
                $destino = 'img/uploads/';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgcurso = $img_nombre.'.jpg';
                $src = $destino.$imgcurso;
            }
        
            $query_insert =mysqli_query($conection,"INSERT INTO curso (curso, descripcion, horas, foto)
                                                                VALUES ('$curso','$descripcion','$horas','$imgcurso')");

            if($query_insert){
                if($nombre_foto != ''){
                    move_uploaded_file($url_temp,$src);
                }

                $alert='<p class="msg_save">Curso guardado correctamente.</P>';
            }else{
                $alert='<p class="msg_error">Error al guardar el Curso.</P>';
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
	<title>Registro curso</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
        <div class="form_register">
        <h1><i class="fas fa-cubes"></i>Registro Curso</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ?$alert: '';?></div>

    <form action=" " method="post" enctype="multipart/form-data">
        <label for="curso">curso</label>
        <input type="text" name="curso" id="curso" placeholder="Nombre del curso">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del curso">
        <label for="horas">horas</label>
        <input type="number" name="horas" id="horas" placeholder="Horas del curso">
        
        <div class="photo">
            <label for="foto">Foto</label>
                <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
                </div>
                <div class="upimg">
                <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
        </div>

        <button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar curso</button>

    </form>

</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>