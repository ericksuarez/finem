<?php $this->load->view('common/header'); ?>
<?php
$foo = $this->config->item('super_admin');
$user = $this->phpsession->get('user','finem');        
$tmp = $this->phpsession->flashget('get');

if(!empty($tmp)){
    $string = '?';
    foreach($tmp as $k => $v){
        $string .= $k.'='.$v.'&';
    }
    redirect(current_url().$string);
}
?>
<div id="contenido" >
    <h2>Consulta de Expedientes</h2>
    
    <div id="filtro" class="row-fluid collapse in">
        <div style="font-size:7pt;" class="span12">			
            <div style="width:95%; margin:0px auto;" class="row-fluid">
                <div class="span12">
                    <?php echo form_open('investigacion/lista',array('class'=>'form-inline','method' => 'get'));
                    $get = $_GET;
                    ?>
                        <fieldset>
                            		
                            <div class="row-fluid">
                                <div class="span2">	
                                    <label for="matricula">Matrícula:</label>
                                    <input type="text" value="<?php echo repoblar_texto('matricula','matricula',$get);?>" placeholder="Marícula..." id="matricula" name="matricula" class="span12">							
                                </div>
                                <div class="span2">
                                    <label for="nom_uno">Nombre 1:</label>					
                                    <input type="text" value="<?php echo repoblar_texto('nom_uno','nom_uno',$get);?>" placeholder="Nombre..." id="nom_uno" name="nom_uno" class="span12">
                                </div>
                                <div class="span2">
                                    <label for="nom_dos">Nombre 2:</label>							
                                    <input type="text" value="<?php echo repoblar_texto('nom_dos','nom_dos',$get);?>" placeholder="Nombre..." id="nom_dos" name="nom_dos" class="span12">							
                                </div>
                                <div class="span2">
                                    <label for="apaterno">Apellido Paterno:</label>
                                    <input type="text" value="<?php echo repoblar_texto('apaterno','apaterno',$get);?>" placeholder="Apellido paterno..." id="apaterno" name="apaterno" class="span12">
                                </div>					
                                <div class="span2">
                                    <label for="amaterno">Apellido Materno:</label>							
                                    <input type="text" value="<?php echo repoblar_texto('amaterno','amaterno',$get);?>" placeholder="Apellido Materno..." id="amaterno" name="amaterno" class="span12">							
                                </div>					
                                <div class="span2">								
                                    <!-- SIN FILTRO -->
                                    <br>
                                    <button class="btn btn-primary" name="buscar" type="submit">
                                        Buscar <i class="icon-arrow-right icon-white"></i>
                                    </button>	
                                    <input type="hidden" value="buscar_alumno" name="formhid">
                                </div>	
                            </div>					
                            <div class="row-fluid">						
                                <div class="span2">	
                                    <label for="uni">Universidad</label>					
                                    <select class="span12" id="uni" name="uni">
                                        <option value="">  Seleccione una Universidad  </option>
                                        <?php foreach ($universidades as $universidad) { 
                                            $selected= repoblar_select('uni',$universidad['iduniversidad'],$get['uni']); ?>         
                                            <option value="<?php echo $universidad['iduniversidad']; ?>" <?php echo $selected; ?>><?php echo $universidad['nombre_comercial']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>						
                                </div>
                                <div class="span2">	
                                    <label for="campus">Campus</label>							
                                    <select class="span12" id="campus" name="cam">
                                        <option value=""> Seleccione un Campus </option>
                                        <?php
                                        if(!empty($campi)){
                                            foreach($campi as $u){
                                                $selected= repoblar_select('cam',$u['idcampus'],$get['cam']);
                                                //echo $_POST['cam'];?>
                                            <option <?php echo $selected;?> value='<?php echo $u['idcampus'];?>'><?php echo $u['nombre'];?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>							
                                </div>
                                <div class='span2'></div>
                                <div class='span2'></div>
                                <div class='span2'></div>
                                <!--
                                <div class="span2">	
                                    <label for="producto">Producto:</label>							
                                    <select class="span12" id="producto" name="producto"><option value="0">  -  </option><option value="CLAUES2">CLAUES2</option><option value="EDUNAF3">EDUNAF3</option><option value="EXTRANJERO">EXTRANJERO</option><option value="FIN100">FIN100</option><option value="FIN1500">FIN1500</option><option value="NAFFIJO">NAFFIJO</option><option value="NAFPARC">NAFPARC</option></select>	
                                </div>			
                                <div class="span2">	
                                    <label for="matricula">Agencia</label>
                                    <select class="span12" id="agencia" name="agencia"><option value="0">  -  </option><option value="6">BOROS INVESTIGACIONES</option><option value="39">C&amp;CAGENCIA</option><option value="72">CEIDH</option><option value="73">CEIDH</option><option value="68">CMG</option><option value="52">CONSERMEX</option><option value="142">DE LA MORA</option><option value="157">GETS</option><option value="83">HUM RESOUR</option><option value="158">INDEPEND</option><option value="87">JAVIER LOP</option><option value="139">JMT</option><option value="155">MILLA</option></select>						
                                </div>
                                <div class="span2">	
                                    <label for="uni">Status</label>					
                                    <select class="span12" id="status" name="status"><option value="0">  -  </option><option value="1">Sin Estatus</option><option value="2">Ingresado</option><option value="3">Buró</option><option value="4">Investigación en Proceso</option><option value="5">Investigación Concluida</option><option value="6">Análisis</option><option value="7">Aprobado</option><option value="8">Aprobado (Segundo Pagaré)</option><option value="9">Rechazado</option><option value="10">Renovación</option><option value="11">Renovación Socioeconómico</option><option value="12">Mesa Control</option></select>						
                                </div>
                                -->
                                <div class="span2">	
                                    <!-- SIN FILTRO -->
                                    <br />
                                    <a title="Nueva búsqueda." href="<?php echo site_url('investigacion/lista');?>" class="btn" style="color:black; text-decoration:none;">Limpiar.</a>															
                                </div>
                            </div>										
                        </fieldset>
                    <?php echo form_close();?>
                </div>
            </div>					
        </div>
    </div>
    <div class='clearfix'></div>
    <?php
    echo $this->pagination->create_links();
    ?>





    <?php
    if(!empty($expedientes)){?>
    <table class="table table-bordered table-hover">

        <tr>

            <th>Matrícula</th>
            <th>Universidad</th>
            <th>Campus</th>
            <th>Nombre</th>
            <th width="20%">Investigar|Imprimir|Terminar</th>

        </tr>

        <?php foreach ($expedientes as $expediente) { ?>

            <tr>

                <td><?php echo $expediente['matricula']; ?></td>
                <td><?php echo $expediente['universidad']; ?></td>
                <td><?php echo $expediente['campus']; ?></td>
                <td><?php echo $expediente['apater'] . ' ' . $expediente['amater'] . ' ' . $expediente['nombre'] . ' ' . $expediente['nombre_dos']; ?></td>
                
                
                <td>
                    
                        <a class="btn" href="<?php echo site_url('investigacion/personal/' . $expediente['idexpediente']); ?>"><i class="icon-pencil"></i></a>
                        &nbsp;
                        <a class="btn" href="<?php echo site_url('investigacion/imprimir/' . $expediente['idexpediente']); ?>" target='_blank'><i class="icon-print"></i></a>
                        &nbsp;
                        <a class="btn btn-success check" href="#check" role="button" data-toggle="modal" data-id="<?php echo $expediente['idexpediente'];?>" data-mat="<?php echo $expediente['matricula'];?>"><i class="icon-check"></i></a>
                    
                </td>

            </tr>

            <?php
        }
        ?>

    </table>
    <?php
    }else{
        $data['mensaje'] = 'No se han encontrado resultados.';
        $this->load->view('errors/error_custom',$data);
                
    }
    ?>


</div>

<div id="check" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Terminar Investigación</h3>
    </div>
    <div class="modal-body">
        <p>
            <span class='text-warning'>
                Usted esta terminando la matrícula con número 
            </span>
            <span id='matricula-numero' class='text-error'>
                XXXXX. 
            </span>
            <span class='text-warning'>
                Si usted prosigue <em>no podrá editar más</em> la información de ésta.
            </span>
        </p>
        <p>¿Desea terminar la investigación?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <a id='matricula-link' href='#N' class="btn btn-primary btn-success">Aceptar</a>
    </div>
</div>







<script type="text/javascript">
    $(document).ready(function(){
        
        $(".check").click(function(){
            var id = $(this).attr('data-id');
            var mat = $(this).attr('data-mat');
            
            $("#matricula-numero").html(mat);
            $("#matricula-link").attr('href','<?php echo site_url('investigacion/terminar/');?>/'+id);
        });
        
        $('#uni').change(function(){
            var opcion;
            
            opcion = $(this).val();
            if(opcion != '') {
                
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
    });
</script>

<?php $this->load->view('common/footer'); ?>