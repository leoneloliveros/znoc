<form action="" class="formulario" id="form_crear_crq">
	<h1 class="formulario_titulo">Crear Actividad</h1>
	<div class="col-md-6">
		<input type="text" class="formulario_input" id="crq" name="crq">
		<label for="crq" class="formulario_label">CRQ</label>
	</div>
	<div class="col-md-6">
		<select class="formulario_input formulario_select" data-label="Tipo Tarea" id="id_tipo_tareas" name="id_tipo_tareas">
			<option value="">Tipo Tarea</option>
			<?php 
			for ($i=0; $i < count($tipo_tareas); $i++) { 
				echo '<option value="'.$tipo_tareas[$i]->id_tipo_tareas.'">'.$tipo_tareas[$i]->tipo_tarea.' - '.$tipo_tareas[$i]->nombre_actividad.'</option>';
			}


			?>
		</select>
	</div>




	<!-- <input type="text" class="formulario_input">
	<label for="" class="formulario_label">Nombre Tarea</label>

	<select class="formulario_input formulario_select" data-label="Regional">
		<option value="">Regional</option>
		<option value="1111">opcion1</option>
		<option value="2222">opcion2</option>
	</select>

	<select class="formulario_input formulario_select" data-label="Red">
		<option value="">Red</option>
		<option value="1111">opcion1</option>
		<option value="2222">opcion2</option>
	</select>

	<select class="formulario_input formulario_select" data-label="Sub-red">
		<option value="">Sub-red</option>
		<option value="1111">opcion1</option>
		<option value="2222">opcion2</option>
	</select>

	<input type="text" class="formulario_input">
	<label for="" class="formulario_label">Info Ejecución</label>

	<input type="text" class="formulario_input">
	<label for="" class="formulario_label">Solicitante Remedy</label> -->

	<input class="formulario_submit" type="submit"></input>
</form>

