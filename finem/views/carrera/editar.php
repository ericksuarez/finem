<?php $this->load->view('common/header');?>
<br />

<div id="contenido">
    <div class='pull-left'>
        <a href='<?php echo site_url('carrera/lista/'.$this->uri->segment(4));?>' class='btn con-get'><i class='icon icon-list'></i> Regresar a Lista</a>
    </div>
    <div class='clearfix'></div>
    
    <?php
    if(!empty($carrera)){?>
    <br />
    
    <?php echo form_open(current_url());?>
    <table class='table table-bordered table-hover centrado6'>
        <tbody>
            <tr>
                <td style='width: 30%'>Universidad</td>
                <td><?php echo $carrera['uni'];?></td>
            </tr>
            <tr>
                <td>Campus</td>
                <td><?php echo $carrera['campus'];?></td>
            </tr>
            <tr>
                <td>Carrera</td>
                <td><input type='text' class='abarca100' value='<?php echo $carrera['titulo'];?>' name='titulo' /></td>
            </tr>
            <tr>
                <td>Periodo</td>
                <td>
                    <select name='marca_plan'>
                        <option value=''>Seleccione un valor</option>
                        <option <?php echo ($carrera['marca_plan'] == 'semestral') ? 'selected="selected"' : '';?> value='semestral'>Semestral</option>
                        <option <?php echo ($carrera['marca_plan'] == 'cuatrimestral') ? 'selected="selected"' : '';?> value='cuatrimestral'>Cuatrimestral</option>
                        <option <?php echo ($carrera['marca_plan'] == 'trimestral') ? 'selected="selected"' : '';?> value='trimestral'>Trimestral</option>
                    </select>
                </td>
            </tr>
            <tr>
                <?php $duration = ($carrera['marca_plan'] == 'semestral') ? $carrera['semestres'] : (($carrera['marca_plan'] == 'cuatrimestral') ? $carrera['cuatrimestres'] : $carrera['trimestres']); ?>
                <td>No. de Periodos</td>
                <td><input class="input-mini" type='text' value='<?php echo $duration;?>' name='duracion' /></td>
            </tr>
            <tr>
                <td>Costo Periodo</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo $carrera['costo_semestral'];?>' name='costo_semestral' />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Costo Carrera</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo $carrera['costo_total'];?>' name='costo_total' />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Ingreso FE</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo $carrera['ingresoFE'];?>' name='ingresoFE' /> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>No. de Materias</td>
                <td><input class="input-mini" type='text' value='<?php echo $carrera['numero_materias'];?>' name='numero_materias' /></td>
            </tr>
            <tr>
                <td>Costo Materia</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo $carrera['costo_materia'];?>' name='costo_materia' />
                    </div>
                </td>
            </tr>
        </tbody>
        <tfooter>
           <tr>
                <td colspan='2'>
                    <input type='submit' class='btn btn-success pull-right' value='Guardar' />
                </td>
            </tr> 
        </tfooter>
        
    </table>
    <input type='hidden' name='car' value='<?php echo $_GET['car'];?>' />
    <input type='hidden' name='cam' value='<?php echo $_GET['cam'];?>' />
    <input type='hidden' name='uni' value='<?php echo $_GET['uni'];?>' />
    <?php echo form_close();?>
    
    <div class='clearfix'></div>
    <?php
    }else{
        $data['mensaje'] = 'No se han encontrado datos de la carrera que consultaste.';
        $this->load->view('errors/error_custom',$data);
    }
    ?>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        
        
        
    });
</script>

<?php $this->load->view('common/footer');?>