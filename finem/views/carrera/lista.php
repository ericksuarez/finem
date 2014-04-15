<?php $this->load->view('common/header');?>
<br />

<div id="contenido">
    <?php echo form_open('carrera/lista',array('method' => 'GET'));?>
    <div class='span3'>
        <select id='uni' name='uni'>
            <option value=''>Seleccione una Universidad</option>
            <?php
            foreach($universidades as $u){
                $b['universidad'] = $_GET['uni'];
                $selected = ($b['universidad'] == $u['iduniversidad']) ? 'selected = "selected"' : '';?>
            <option <?php echo $selected;?> value='<?php echo $u['iduniversidad'];?>'><?php echo $u['nombre_comercial'];?></option>
            <?php
            }
            ?>
        </select>
    </div>
    
    <div class='span3'>
        <select id='campus' name='cam'>
            <option value=''>Seleccione un Campus</option>
            <?php
            foreach($campi as $u){
                $b['cam'] = $_GET['cam'];
                $selected = ($b['cam'] == $u['idcampus']) ? 'selected = "selected"' : '';?>
            <option <?php echo $selected;?> value='<?php echo $u['idcampus'];?>'><?php echo $u['nombre'];?></option>
            <?php
            }
            ?>
        </select>
    </div>
    
    <div class='span6'>
        <input name='car' type='text' id='carrera' value='<?php echo $_GET['car'];?>' placeholder='Escriba una carrera'/>
        
        <input type='submit' value='Buscar' id='buscar' class='btn'/>
        <a href='<?php echo site_url('carrera/lista');?>' class='btn'>Limpiar Búsqueda</a>
        
    </div>
    <div class='clearfix'></div>
    
    <?php echo form_close();?>
    <div id='results'>
        <?php if (!empty($carreras)) { ?>
        <div class='pull-left'><?php echo  $this->pagination->create_links();?></div>
        <div class='pull-right pagination'>Se han encontrado <?php echo $total;?> resultados.</div>
        <div class='clearfix'></div>
        <table class='table table-bordered table-hover table-condensed'>
            <theader>
                <tr>
                    <th>Universidad</th>
                    <th>Campus</th>
                    <th>Carrera</th>
                    <th>Periodo</th>
                    <th>Duración</th>
                    <th>Costo Periodo</th>
                    <th>Total Periodo</th>
                    <th>Ingreso Periodo</th>
                    <th>Editar|Eliminar</th>
                </tr>
            </theader>
            <tbody>
                <?php foreach($carreras as $c){?>
                <tr>
                    <td><?php echo $c['uni'];?></td>
                    <td><?php echo $c['campus'];?></td>
                    <td><?php echo $c['titulo'];?></td>
                    <td><?php echo ucfirst($c['marca_plan']);?></td>
                    <?php $duration = ($c['marca_plan'] == 'semestral') ? $c['semestres'] : (($c['marca_plan'] == 'cuatrimestral') ? $c['cuatrimestres'] : $c['trimestres']); ?>
                    <td><?php echo $duration;?></td>
                    <td><?php echo '$'.number_format($c['costo_semestral'],2);?></td>
                    <td><?php echo '$'.number_format($c['costo_total'],2);?></td>
                    <td><?php echo '$'.number_format($c['ingresoFE'],2);?></td>
                    <td>
                        <div class='btn-group'>
                            <a href="<?php echo site_url('carrera/editar/'.$c['idcarrera'].'/'.$this->uri->segment(3));?>" class='btn btn-small btn-info con-get'><i class='icon icon-edit'></i></a>
                            <a href="#myModal" role="button" data-toggle="modal" class='btn btn-small btn-danger borrar' data-id='<?php echo $c['idcarrera'];?>' data-info='<?php echo $c['titulo'].' de '.$c['uni'];?>'><i class='icon icon-trash'></i></a>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php } else { 
                $data['mensaje'] = ($error_total == TRUE) ? 'Por favor de clic en el botón de corregir búsqueda.' : 'No se ha encontrado ningún resultado para tu búsqueda.';
                //$data['mensaje'] = 'No se ha encontrado ningún resultado para tu búsqueda.';
                $this->load->view('errors/error_custom',$data);
            }
        ?>
    </div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Borrar</h3>
    </div>
    <div class="modal-body">
        <p>¿De verdad desea borrar la carrera <em><span id='info_borrar'>xxx</span></em>?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <a href='#N' id='link_borrar' class="btn btn-danger">Borrar</a>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        
        /*setTimeout(function() {
            $('#uni').trigger('change');
        },10);
        
        setTimeout(function() {
           $('#buscar').trigger('click');
        },500);
        */
        $('#uni').change(function(){
            var opcion;
            
            opcion = $(this).val();
            if(opcion != ''){
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('carrera/ajax_campus');?>",
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
        
        /*$('#buscar').click(function(){
            var uni,campus,carrera;
            uni = $("#uni option:selected").val();
            
            //alert(uni);
            campus = $("#campus option:selected").val();
            carrera = $("#carrera").val();
            //alert(campus);
            $("#results").html('<center><img src="<?php echo base_url('images/loading.gif');?>" alt="Cargando..." /></center>');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('carrera/buscar/'.$this->uri->segment(3));?>",
                cache: false,
                data: {universidad: uni, campus: campus, carrera: carrera}
            }).done(function( html ) {
                $("#error_ajax").css('display','none');
                $("#results").html(html);
            }).fail(function(jqXHR, textStatus) {
                //alert(textStatus);
                $("#error_ajax").html('<p>Error al ejecutar la búsqueda.</p>');
                $("#error_ajax").css('display','block');
                $("#results").html("<center><i class='icon icon-frown' style='font-size: 20em;'><br /><span style='font-size: 16px;'>No hemos encontrado resultados.</span></i></center>");
                //alert( "Falla en el sistema. Contacte a su administrador.");
            });
        });
        
        $('#carrera').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            //alert(keycode);
            if(keycode == '13'){
                $('#buscar').click();
            }
        }); */
        
        $('.borrar').live('click',function(){
            var info = $(this).attr('data-info');
            var id = $(this).attr('data-id');
            $("#info_borrar").html(info);
            $("#link_borrar").attr('href','<?php echo site_url('carrera/borrar/');?>/'+id);
        });
        
    });
</script>

<?php $this->load->view('common/footer');?>