<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/btn-group.css" />
		<div id="contenido">
			

			<?php
			if($seccion=='lista'){?>
				<h2>Consulta campus</h2>
				<?php
				echo $this->pagination->create_links();
				?>
				<div class="busqueda">
				</div>
				<table class="table table-bordered table-hover" style="width:100%;" align="center">
					<tr>
						<th>Universidad</th>
						<th>Campus</th>
						<th>Código de Campus</th>
						<th>Editar</th>						
						<th>Eliminar</th>	
					</tr>
					<?php
					foreach($campuses as $campus){?>
						<tr>
							<td><?php echo $campus['nombre_comercial'];?></td>
							<td><?php echo $campus['nombre'];?></td>
							<td><?php echo $campus['code_campus'];?></td>
							<td><a class="btn btn-mini" href="<?php echo site_url('campus/ver/'.$campus['idcampus']);?>">Editar</a></td>												
							<td><a class="btn btn-mini btn-danger delUni" role="button" title="<?php echo $campus['nombre_comercial'];?>" href="<?php echo site_url('campus/borrar/'.$campus['idcampus']);?>" data-toggle="modal">Eliminar</a></td>													
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
						<p>¿Está seguro que desea eliminar la campus <span id="text-uni" style="font-weight: bold;"></span>?</p>						
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
						<button class="btn btn-primary" id="confirmar">Estoy de acuerdo.</button>
					</div>
				</div>

			<?php
			} elseif($seccion=='ver') {
			?>
				<h2>Editar campus</h2>
				<?php echo form_open(current_url());?>
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<td align="right">Universidad:</td>
						<td>
							<select id="uni" name="uni" >
								<?php
								foreach($universidades as $universidad){
									$select = ($universidad['iduniversidad'] == $campus['universidad_iduniversidad']) ? 'selected="selected"' : '';?>
									<option value="<?php echo $universidad['iduniversidad'];?>" <?php echo $select;?>><?php echo $universidad['nombre_comercial'];?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right">Nombre de Campus:</td>
						<td><input type="text" value="<?php echo $campus["nombre"];?>" name="nombre" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td align="right">Código de Campus:<a data-original-title="Sólo se utiliza si el campus pertenece a U.V.M." href="#N" rel="tooltip" data-placement="right" class="tip"><i class="icon-question-sign"></i></a></td>
						<td><input type="text" value="<?php echo $campus["code_campus"];?>" name="code" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="formhid" value="<?php echo $campus['idcampus']; ?>">
							<input class="btn btn-success" type="submit" value="Guardar" />
							<a class="btn btn-small" href="<?php echo site_url('campus'); ?>" title="Listado campuses">Cancelar</a>
						</td>
					</tr>
				</table>
				<?php echo form_close();?>
			<?php
			}elseif($seccion=='nuevo'){?>
				<h2>Nuevo campus</h2>
				<?php echo form_open(current_url());?>
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<td align="right">Universidad:</td>
						<td>
							<select id="uni" name="uni" >
								<option value="0" <?php echo set_select('uni','0',TRUE);?>>Seleccione una opción</option>
								<?php
								foreach($universidades as $universidad){?>
									<option value="<?php echo $universidad['iduniversidad'];?>" <?php echo set_select('uni',$universidad['iduniversidad']);?>><?php echo $universidad['nombre_comercial'];?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right">Nombre de Campus:</td>
						<td><input type="text" value="<?php echo set_value("nombre");?>" name="nombre" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td align="right">Código de Campus:<a data-original-title="Sólo se utiliza si el campus pertenece a U.V.M." href="#N" rel="tooltip" data-placement="right" class="tip"><i class="icon-question-sign"></i></a></td>
						<td><input type="text" value="<?php echo set_value("code");?>" name="code" maxlength="250" size="30"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input class="btn btn-success" type="submit" value="Guardar" />
							<a class="btn btn-small" href="<?php echo site_url('campus'); ?>" title="Listado campuses">Cancelar</a>
						</td>
					</tr>
				</table>
				<?php echo form_close();?>
			<?php
			}else{?>

			<?php
			}
			?>
			<script type="text/javascript">
					$(document).ready( function() {
						$('.tip').tooltip();
						var url, campus;
						
						$('.delUni').click(function(event) {
							event.preventDefault();
							url = $(this).attr('href');
							campus = $(this).attr('title');
							
							$('#text-uni').html(campus);
							$('#myModal').modal('show');
						});
						
						$('#confirmar').click(function() {
							window.location.href=url;
						});
					});
				</script>
		</div>
<?php $this->load->view('common/footer');?>