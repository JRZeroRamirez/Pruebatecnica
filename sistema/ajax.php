<?php
include "../conexion.php";
session_start();

if(!empty($_POST)){

    if($_POST['action'] == 'infocurso'){
        $curso_id = $_POST['curso'];
        $curso = $_POST['curso'];

        $query = mysqli_query($conection,"SELECT c.codcurso, c.curso, c.descripcion, c.horas
                FROM curso c WHERE codcurso = $curso_id");

        mysqli_close($conection);

        $result = mysqli_num_rows($query);
        if($result > 0){
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo 'error';
        exit;
    }
    if($_POST['action'] == 'addcurso'){
        if(!empty($_POST['horas']) || !empty($_POST['curso_id'])){

        } 
    }
}
?>