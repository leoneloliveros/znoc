<style type="text/css">
	.well {
		display: inline-block;
	}
</style>
<form method="POST" action="<?= base_url('User/configurar_perfil') ?>" class="formulario" id="form_configurar_perfil" enctype="multipart/form-data">
	<h1 class="formulario_titulo">Configurar Perfil</h1>

	<div class="col-md-8">
		<input type="password" class="formulario_input" id="old_password" name="old_password">
		<label for="old_password" class="formulario_label">ingrese su password</label>
	</div>



		<div class="col-md-4">
			<input type="button" class="formulario_input btn btn-success" id="confirmar" value="validar">
			<!-- <label for="old_password" class="formulario_label">ingrese su password</label> -->
		</div>

	<div style="display: none;" id="rest_form_content">
		<div class="alert alert-dismissible col-sm-10 col-sm-offset-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-info"></i> Por favor, solo edite los campos que desea cambiar
		</div>
		<legend class="col-sm-12"  style="margin-bottom: 30px;">Cambiar password?</legend>
		<div class="col-md-6">
			<input type="text" class="formulario_input" id="new_password" name="new_password">
			<label for="new_password" class="formulario_label">Nuevo Password</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="formulario_input" id="new_password_2" name="new_password_2">
			<label for="new_password_2" class="formulario_label">Confirmar Password</label>
		</div>


		<legend class="col-sm-12"  style="margin-bottom: 30px;">Cambiar Foto?</legend>
		<div class="well" data-bind="fileDrag: fileData">
		    <div class="form-group row">
		        <div class="col-md-6">
		            <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
		            <div data-bind="ifnot: fileData().dataURL">
		                <label class="drag-label">Arrastrar aqui</label>
		            </div>
		        </div>
		        <div class="col-md-6">
		            <input name="form_file" id="form_file" type="file" data-bind="fileInput: fileData, customFileInput: {
		              buttonClass: 'btn btn-success',
		              fileNameClass: 'disabled form-control',
		              onClear: onClear,
		              onInvalidFileDrop: onInvalidFileDrop
		            }" accept="image/jpeg">
		        </div>
		    </div>
		</div>

		<input class="formulario_submit" type="button" value="enviar" id="send_form"></input>
	</div>
</form>

<script src="<?= base_url("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>

<?php $msj =$this->session->flashdata('msj'); ?>

<?php if (isset($msj)): ?>
	<script> swal("<?= $msj['title'] ?>", "<?= $msj['cuerpo'] ?>", "<?= $msj['tipo'] ?>"); </script>
<?php endif ?>
