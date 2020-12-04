<nav>
			<ul>
				<li><a href="#">Inicio</a></li>
				
					<?php 
					if($_SESSION['rol'] == 1){

					?>

					<li class="principal">
					<a href="#">Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
						
					</ul>
				</li>
				<?php } ?>

				<?php 
					if($_SESSION['rol'] == 1){

					?>
				<li class="principal">
					<a href="#">Registro cursos</a>
					<ul>
						<li><a href="registro_curso.php">Nuevo Curso</a></li>
						<li><a href="lista_curso.php">Lista de cursos</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php 
					if($_SESSION['rol'] == 2){

					?>
				<li class="principal">
					<a href="#">cursos incritos</a>
					<ul>
					
						<li><a href="lista_curso.php">Lista de Cursos</a></li>
					</ul>
				</li>
				<?php } ?>


								

				<?php 
					if($_SESSION['rol'] == 3 ){

					?>		
				<li class="principal">
					<a href="#">calificaciones</a>
					<ul>
						
					</ul>
				</li>
				<?php } ?>	
				

				

			</ul>
		</nav>