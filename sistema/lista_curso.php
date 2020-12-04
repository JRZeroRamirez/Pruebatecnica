<?php 
session_start();

    include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scrips.php"	
	?> 
	<title>Lista de Cursos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1><i class="fas fa-cube"></i>Lista de Cursos</h1>
        <a href="registro_curso.php" class="btn_new">Registrar Curso</a>
               

        <table>
            <tr>
                <th>Código</th> 
                <th>Curso</th>
                <th>Descripción</th>
                <th>horas</th>                
                <th>Foto</th>
                <th>Acciones</th>                        
            </tr>
            <?php 
            
            $sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM curso");
            $result_register = mysqli_fetch_array($sql_registre);
            $total_registro = $result_register['total_registro'];
            $por_pagina = 50;

            if(empty($_GET['pagina'])){
                $pagina = 1;
            } else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conection,"SELECT c.codcurso, c.curso, c.descripcion, c.horas, c.foto 
                                                FROM curso c ORDER BY c.curso 
                                                ASC LIMIT $desde,$por_pagina");

            mysqli_close($conection);
            $result = mysqli_num_rows($query);
            
            if($result > 0){

                while($data = mysqli_fetch_array($query)){
                    if($data['foto'] != 'img_curso.png'){
                        $foto = 'img/uploads/'.$data['foto'];
                    } else{
                        $foto = 'img/'.$data['foto'];
                    }
            ?>
            <tr>
                <td><?php echo $data["codcurso"]; ?></td>
                <td><?php echo $data["curso"]; ?></td>
                <td><?php echo $data["descripcion"]; ?></td>
                <td><?php echo $data["horas"]; ?></td>
                <td class="img_curso"><img src="<?php echo $foto; ?>" alt="<?php echo $data["curso"]; ?>"></td>
                <td>
                    
                    <a class="link_edit" href="editar_curso.php?id=<?php echo $data["codcurso"]; ?>">Editar</a>  
                    <?php  if($data['codcurso'] != 0) {                 
                    ?>
                    |       
                    <a class="link_delete" href="eliminar_confirmar_curso.php?id=<?php echo $data["codcurso"]; ?>">Eliminar</a>
                <?php } ?>
                
                </td>                  
            </tr>
    <?php   
        }
    }
    ?>
        </table>

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>