<?php $this->load->view('common/header');?>
<br />

<div id="contenido">
    <div class='clearfix'></div>
    
    <br />
    
    <?php echo form_open(current_url());?>
    <table class='table table-bordered table-hover centrado6'>
        <tbody>
            <tr>
                <td style='width: 30%'>Universidad</td>
                <td>
                    <select id='uni' name='uni'>
                        <option value=''>Seleccione una Universidad</option>
                        <?php
                        foreach($universidades as $u){?>
                        <option <?php echo set_select('uni',$u['iduniversidad']);?> value='<?php echo $u['iduniversidad'];?>'><?php echo $u['nombre_comercial'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Campus</td>
                <td>
                    <select id='campus' name='campus'>
                        <option value=''>Seleccione un Campus</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Carrera</td>
                <td><input type='text' class='abarca100' value='<?php echo set_value('titulo');?>' name='titulo' /></td>
            </tr>
            <tr>
                <td>Periodo</td>
                <td>
                    <select name='marca_plan'>
                        <option value=''>Seleccione un valor</option>
                        <option <?php echo set_select('marca_plan','semestral');?> value='semestral'>Semestral</option>
                        <option <?php echo set_select('marca_plan','cuatrimestral');?> value='cuatrimestral'>Cuatrimestral</option>
                        <option <?php echo set_select('marca_plan','trimestral');?> value='trimestral'>Trimestral</option>
                    </select>
                </td>
            </tr>
            <tr>
                
                <td>No. de Periodos</td>
                <td><input class="input-mini" type='text' value='<?php echo set_value('duracion');?>' name='duracion' /></td>
            </tr>
            <tr>
                <td>Costo Periodo</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo set_value('costo_semestral');?>' name='costo_semestral' />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Costo Carrera</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo set_value('costo_total');?>' name='costo_total' />
                    </div>
                </td>
            </tr>
            <tr>
                <td>Ingreso FE</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo set_value('ingresoFE');?>' name='ingresoFE' /> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>No. de Materias</td>
                <td><input class="input-mini" type='text' value='<?php echo set_value('numero_materias');?>' name='numero_materias' /></td>
            </tr>
            <tr>
                <td>Costo Materia</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class="input-small numerico" id="prependedInput" type="text" value='<?php echo set_value('costo_materia');?>' name='costo_materia' />
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
    <?php echo form_close();?>
    
    <div class='clearfix'></div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        //alert('hola');
        setTimeout(function() {
            $('#uni').trigger('change');
        },10);
        
        $('#uni').change(function(){
            var opcion;
            
            opcion = $(this).val();
            if(opcion != ''){
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('carrera/ajax_campus/');?>",
                    cache: false,
                    data: {universidad: opcion}
                }).done(function( html ) {
                    $("#error_ajax").css('display','none');
                    $("#campus").html(html);
                }).fail(function(jqXHR, textStatus) {
                    //alert(textStatus);
                    $("#error_ajax").html('<p>Error al poblar los campus.</p>');
                    $("#error_ajax").css('display','block');
                    $("#results").html("<center><i class='icon icon-frown' style='font-size: 20em;'><br /><span style='font-size: 16px;'>No hemos encontrado resultados.</span></i></center>");
                    //alert( "Falla en el sistema. Contacte a su administrador.");
                });
            }else{
                $("#campus").html('<option value="">Seleccione un Campus</option>');
            }
            
        });
        
    });
</script>

<?php $this->load->view('common/footer');?>