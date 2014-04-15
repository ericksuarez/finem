<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/btn-group.css" />
		<div id="contenido">
			

			<?php
			if($seccion=='lista'){?>
				<h2>Consulta</h2>
				<?php
				//echo $this->pagination->create_links();
				?>

				
				<div class="busqueda">
				</div>
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<th>Ciclo</th>
						<th>Activo</th>
						<th>Vigente</th>
					</tr>
					<?php
					foreach($ciclos as $ciclo){?>
						<tr>
							<td><?php echo $ciclo['ciclo'];?></td>
							<?php
							if($ciclo['activo']=='SI'){?>
								<td><a class="btn btn-mini" href="<?php echo site_url('ciclo/modificar/'.$ciclo['idciclo'].'/inactivo');?>">Desactivar</a></td>
							<?php }else{?>
								<td><a class="btn btn-mini" href="<?php echo site_url('ciclo/modificar/'.$ciclo['idciclo'].'/activo');?>">Activar</a></td>
							<?php }?>

							<?php
							if($ciclo['main']=='SI'){?>
								<td><span class="btn btn-mini"><i class="icon-asterisk"></i>Principal</span></td>
							<?php }elseif($ciclo['activo']=='SI'){?>
								<td><a class="btn btn-mini" href="<?php echo site_url('ciclo/principal/'.$ciclo['idciclo']);?>">Hacer Principal</a></td>
							<?php }else{?>
								<td>No puedes hacer principal este ciclo.</td>
							<?php
							}?>
						</tr>
					<?php
					}
					?>
				</table>

			<?php
			}elseif($seccion=='ver'){?>
				<h2>Expediente</h2>
			<?php
			}elseif($seccion=='nuevo'){?>
				<h2>Nuevo Ciclo</h2>
				<?php echo form_open(current_url());?>
				<table class="table table-bordered table-hover" style="width:500px;" align="center">
					<tr>
						<td width="30%" align="right">Ciclo :</td>
						<td><input type="text" value="<?php echo set_value("ciclo");?>" name="ciclo" maxlength="10" size="30"></td>
					</tr>	
					<tr>
						<td width="30%" align="right">Vigente :</td>
						<td>
							<?php if($browser == 'Internet Explorer' && $browser_ver < 9){?>
								<table class="btn-groupie7">
									<tr>
										<td>
											<input id="radio_1" type="radio" value="SI" name="vigente" <?php echo set_radio('vigente', 'SI'); ?>>
											<label for="radio_1">SI</label>
										</td>
										<td>
											<input id="radio_2" type="radio" value="NO" name="vigente" <?php echo set_radio('vigente', 'NO'); ?>>
											<label for="radio_2">NO</label>
										</td>
									</tr>
								</table>
							<?php
							}else{?>
								<div class="btn-group">
									<input id="radio_1" type="radio" value="SI" name="vigente" <?php echo set_radio('vigente', 'SI'); ?>>
									<label class="btn" for="radio_1">SI</label>
									<input id="radio_2" type="radio" value="NO" name="vigente" <?php echo set_radio('vigente', 'NO'); ?>>
									<label class="btn" for="radio_2">NO</label>
								</div>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="30%" align="right">Activo :</td>
						<td>
							<?php if($browser == 'Internet Explorer' && $browser_ver < 9){?>
								<table class="btn-groupie7">
									<tr>
										<td>
											<input id="radio_3" type="radio" value="SI" name="activo" <?php echo set_radio('activo', 'SI'); ?>>
											<label for="radio_3">SI</label>
										</td>
										<td>
											<input id="radio_4" type="radio" value="NO" name="activo" <?php echo set_radio('activo', 'NO'); ?>>
											<label for="radio_4">NO</label>
										</td>
									</tr>
								</table>
							<?php
							}else{?>
								<div class="btn-group">
									<input id="radio_3" type="radio" value="SI" name="activo" <?php echo set_radio('activo', 'SI'); ?>>
									<label class="btn" for="radio_3">SI</label>
									<input id="radio_4" type="radio" value="NO" name="activo" <?php echo set_radio('activo', 'NO'); ?>>
									<label class="btn" for="radio_4">NO</label>
								</div>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input class="btn btn-success" type="submit" value="Guardar" /></td>
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