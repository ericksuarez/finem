<?php $this->load->view('common/header'); ?>
<br />
<div class="container" style="margin:auto;">
    <div class="row-fluid">
        <div class="span12">
            <div style="width:95%; margin:0px auto; border:0px solid blue;">
                <h3>
                    <legend>Alta matrícula.</legend>
                </h3>
                <div class="alert">
                    Debe llenar campos obligatorios (*).
                </div>
                <div style="width:50%; margin:0px auto;">
                    <form class="form-horizontal" method="post" action="">
                        <div class="control-group">
                            <label for="uni" class="control-label">Universidad</label>
                            <div class="controls">
                                <select id='uni' name='uni'>
                                    <option value=''>Seleccione una Universidad</option>
                                    <?php
                                    foreach($universidades as $u){?>
                                    <option <?php echo set_select('uni',$u['iduniversidad']);?> value='<?php echo $u['iduniversidad'];?>'><?php echo $u['nombre_comercial'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select> *
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="campus" class="control-label">Campus</label>
                            <div class="controls">
                                <select id='campus' name='cam'>
                                    <option value=''>Seleccione un Campus</option>
                                    <?php
                                    if(!empty($campi)){
                                        foreach($campi as $u){?>
                                        <option <?php echo set_select('cam',$u['idcampus']);?> value='<?php echo $u['idcampus'];?>'><?php echo $u['nombre'];?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select> *
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="matricula" class="control-label">Matrícula</label>
                            <div class="controls">
                                <input type="text" value="<?php echo set_value('mat');?>" placeholder="Matrícula ... " name="mat" id="matricula"> *
                            </div>
                        </div>
                        <div style="background-color:transparent;" class="form-actions">
                            <button name="dar_alta" class="btn btn-primary" type="submit">Guardar</button>
                            <input type="hidden" value="alta_matricula" name="formhid">
                            <a style="color:black; text-decoration:none;" class="btn" href="<?php echo site_url('expediente/lista');?>">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script type='text/javascript'>
    $(document).ready(function(){
        
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
        
    });
</script>
<?php $this->load->view('common/footer'); ?>