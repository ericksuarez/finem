<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/btn-group.css" />
		<div id="contenido">
			

			<?php
			if($seccion=='lista'){?>
				<h2>Consulta Universidades</h2>
				<?php
				echo $this->pagination->create_links();
				?>
				<div class="busqueda">
				</div>
				<table class="table table-bordered table-hover" style="width:100%;" align="center">
					<tr>
						<th>Razón social</th>
						<th>Nombre comercial</th>
						<th>Convenio</th>
						<th>Editar</th>						
						<th>Eliminar</th>	
					</tr>
					<?php
					foreach($universidades as $universidad){?>
						<tr>
							<td><?php echo $universidad['razon_social'];?></td>
							<td><?php echo $universidad['nombre_comercial'];?></td>
							<td><?php echo $universidad['convenio_cie'];?></td>
							<td><a class="btn btn-mini" href="<?php echo site_url('universidad/ver/'.$universidad['iduniversidad']);?>">Editar</a></td>												
							<?php
							if($universidad['activo']=='SI'){?>
								<td>
									<a class="btn btn-mini btn-danger delUni" role="button" title="<?php echo $universidad['nombre_comercial'];?>" href="<?php echo site_url('universidad/modificar/'.$universidad['iduniversidad'].'/inactivo');?>" data-toggle="modal">Eliminar</a>
								</td>
							<?php }else{?>
								<td><a class="btn btn-mini" href="<?php echo site_url('universidad/modificar/'.$universidad['iduniversidad'].'/activo');?>">Activar</a></td>
							<?php }?>														
						</tr>
					<?php
					}
					?>
				</table>
				<!-- Modal -->
				<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Confirmación de eliminar</h3>
					</div>
					<div class="modal-body">
						<p>¿Está seguro que desea eliminar la universidad <span id="text-uni" style="font-weight: bold;"></span>?</p>						
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
						<button class="btn btn-primary" id="confirmar">Estoy de acuerdo.</button>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready( function() {
						var url, universidad;
						
						$('.delUni').click(function(event) {
							event.preventDefault();
							url = $(this).attr('href');
							universidad = $(this).attr('title');
							
							$('#text-uni').html(universidad);
							$('#myModal').modal('show');
						});
						
						$('#confirmar').click(function() {
							window.location.href=url;
						});
					});
				</script>
			<?php
			} elseif($seccion=='ver') {
				/*$razon = $universidades['razon_social'];
				$nombre = $universidades['nombre_comercial'];
				$convenio = $universidades['convenio_cie'];*/
				$idUniversidad = $universidades['iduniversidad'];
				// $array_campos = array('razon', 'nombre', 'convenio');				
				
				$razon = set_value('razon');
				$nombre = set_value('nombre');
				$convenio = set_value('convenio');
				
				if (!isset($_POST['razon'])) {
					//$razon = set_value('razon');
					$razon = $universidades['razon_social'];
				}
				if (!isset($_POST['nombre'])) {
					//$nombre = set_value('nombre');
					$nombre = $universidades['nombre_comercial'];
				}
				if (!isset($_POST['convenio'])) {
					//$convenio = set_value('convenio');
					$convenio = $universidades['convenio_cie'];
				}
			?>
				<h2>Editar Universidad</h2>
				<?php echo form_open(current_url());?>
				
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<td width="30%" align="right">Razón Social :</td>						
						<td><input type="text" value="<?php echo $razon; ?>" name="razon" maxlength="250" size="30"></td>
					</tr>	
					<tr>
						<td width="30%" align="right">Nombre comercial :</td>
						<td><input type="text" value="<?php echo $nombre; ?>" name="nombre" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td width="30%" align="right">Convenio CIE :</td>
						<td><input type="text" value="<?php echo $convenio; ?>" name="convenio" maxlength="100" size="30"></td>
					</tr>											
					<tr>						
						<td colspan="2">
							<input type="hidden" name="formhid" value="<?php echo $idUniversidad; ?>">
							<input class="btn btn-success" type="submit" value="Guardar" />
							<a class="btn btn-small" href="<?php echo site_url('universidad'); ?>" title="Listado Universidades">Cancelar</a>
						</td>
					</tr>
				</table>
				<?php echo form_close();?>
			<?php
			}elseif($seccion=='nuevo'){?>
				<h2>Nuevo Universidad</h2>
				<?php echo form_open(current_url());?>
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<td width="30%" align="right">Razón Social :</td>
						<td><input type="text" value="<?php echo set_value("razon");?>" name="razon" maxlength="250" size="30"></td>
					</tr>	
					<tr>
						<td width="30%" align="right">Nombre comercial :</td>
						<td><input type="text" value="<?php echo set_value("nombre");?>" name="nombre" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td width="30%" align="right">Convenio CIE :</td>
						<td><input type="text" value="<?php echo set_value("convenio");?>" name="convenio" maxlength="100" size="30"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input class="btn btn-success" type="submit" value="Guardar" />
							<a class="btn btn-small" href="<?php echo site_url('universidad'); ?>" title="Listado Universidades">Cancelar</a>
						</td>
					</tr>
				</table>
				<?php echo form_close();?>
			<?php
			}else{?>

			<?php
			}
			?>

		</div>
<?php $this->load->view('common/footer');?>