<?php
$user = $this->phpsession->get('user','finem');
$usuarios = $this->config->item('super_admin');?>
<br />
<br />
<?php
if(!isset($informacion['contrato']['idcontrato'])){
    $data['mensaje'] = 'No existe ningún contrato para esta matrícula.';
    $this->load->view('errors/error_custom',$data);
}else{
    $user = $this->phpsession->get('user','finem');
    $usuarios = $this->config->item('super_admin');
    $test = in_array($user['idusuario'], $usuarios) ? 'si' : 'no';
    $marca_plan = obtener_campo('marca_plan.carrera', 'idcarrera.'.$expediente['especialidad']);
    $resta1 = resta_dias(date('Y-m-d H:i:s'),$informacion['disposicion']['subida_restante']);
    $resta2 = resta_dias(date('Y-m-d H:i:s'),$informacion['disposicion']['subida_calificacion']);
    $resta3 = resta_dias(date('Y-m-d H:i:s'),$informacion['disposicion']['subida_adeudo']);
    $resta4 = resta_dias(date('Y-m-d H:i:s'),$informacion['disposicion']['subida_insoluto']);
    $resta5 = resta_dias(date('Y-m-d H:i:s'),$informacion['disposicion']['subida_insoluto2']);
    $maximo = 61;
    ?>
    
    <?php
    $tmp = $this->phpsession->flashget('pestania');
    $pestania = (!empty($_POST['pestania'])) ? $_POST['pestania'] : (!empty($tmp) ? $tmp : '');
    ?>
    <div class='tabbable tabs-left pull-left' style='width:18%'>
        <ul id="myTab" class="nav nav-tabs">
            <li class="<?php echo (empty($pestania)) ? 'active' : (($pestania == 'general-li') ? 'active' : '' ); ?>"><a id="general-li" href="#general">Cobranza</a></li>
            <li class="<?php echo (!empty($pestania) && $pestania == 'pagare-li') ? 'active' : ''; ?>"><a id='pagare-li' href="#pagares">Pagares</a></li>
            <li class="<?php echo (!empty($pestania) && $pestania == 'recal-li') ? 'active' : ''; ?>"><a id='recal-li' href="#recal">Recalendarización</a></li>
        </ul>
    </div>


    <div class="tab-content pull-right" style='width:80%;'>
        <div id="general" class="tab-pane <?php echo (empty($pestania) || $pestania == 'general-li') ? 'active' : ''; ?>">

            <table class='table table-bordered table-hover'>
                <tr>
                    <td>Línea Global</td>
                    <td>$<?php echo number_format($informacion['analisis']['linea_global'],2);?></td>
                </tr>
                <tr>
                    <td>Línea Autorizada</td>
                    <td>$<?php echo number_format($informacion['analisis']['importe'],2);?></td>
                </tr>
                <tr class='<?php echo $resta1 >= ($maximo - 1) ? 'error' : '';?>'>
                    <td>Línea Restante</td>
                    <td>
                        <?php
                        if(in_array($user['idusuario'], $usuarios)){
                            echo form_open('expediente/cambiar_linea',array('class'=>'input-append'));?>
                            <input type='hidden' name='expediente' value='<?php echo $expediente['idexpediente'];?>' />
                            <input type='hidden' name='linea_parcial' value='<?php echo $informacion['analisis']['linea_global'];?>' />
                            <input type='text' name='linea' class='money input-small' value='<?php echo number_format($informacion['disposicion']['linea_restante'],2);?>' />
                            <input name='linea_user' type='submit' value='Guardar' class='btn btn-success' style='height:30px;'/>
                            &nbsp;
                            <button name='linea_system' value='clicked' id='linea_sistema' class='btn btn-info'><i class='icon icon-wrench'></i> Actualizar por Sistema</button>
                        <?php
                            echo form_close();
                        }else{
                        ?>
                        $<?php echo number_format($informacion['disposicion']['linea_restante'],2);?>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr class='<?php echo $resta2 >= ($maximo - 1) ? 'error' : '';?>'>
                    <td>Calificación</td>
                    <td><?php echo $informacion['disposicion']['calificacion'];?></td>
                </tr>
                <tr class='<?php echo $resta3 >= ($maximo - 1) ? 'error' : '';?>'>
                    <td>Adeudo</td>
                    <td>$<?php echo number_format($informacion['disposicion']['adeudo'],2);?></td>
                </tr>
                <tr class='<?php echo $resta4 >= ($maximo - 1) ? 'error' : '';?>'>
                    <td>Saldo Insoluto</td>
                    <td>$<?php echo number_format($informacion['disposicion']['saldo_insoluto'],2);?> a fecha de 
                        <span class='<?php echo $resta5 >= ($maximo - 1) ? 'text-error' : '';?>'>
                            <?php echo !empty($informacion['disposicion']['subida_insoluto2']) ? fecha_contrato($informacion['disposicion']['subida_insoluto2']) : '---';?>
                        </span>
                    </td>
                </tr>
            </table>

        </div>

        <div id="pagares" class="tab-pane <?php echo (!empty($pestania) && $pestania == 'pagare-li') ? 'active' : ''; ?>">

            <?php
            if(!empty($informacion['pagares'])){?>
            
            <?php
            //echo $resta4;
            if(/*$test == 'si' &&*/ ($resta1 < $maximo && $resta2 < $maximo && $resta3 < $maximo && $resta4 < $maximo && $resta5 < $maximo) ){?>
            <a href='<?php echo site_url('expediente/newpagare/'.$expediente['idexpediente']);?>' class='btn btn-success pull-right'>
                Agregar un Pagaré <i class='icon icon-plus-sign'></i>
            </a>
            <?php
            }elseif( ($resta1 >= ($maximo - 1) || $resta2 >= ($maximo - 1) || $resta3 >= ($maximo - 1) || $resta4 >= ($maximo - 1) || $resta5 >= ($maximo - 1)) ){?>
            <div class='alert alert-warning'>
                <p>La información de cobranza no ha sido actualizada en más de 2 meses por lo que no se pueden crear pagarés nuevos.</p>
            </div>
            <?php
            }elseif(empty($informacion['disposicion'])){
            ?>
            <div class='alert alert-warning'>
                <p>La información de cobranza no ha sido actualizada jamás por lo que no se pueden crear pagarés nuevos.</p>
            </div>
            <?php
            }
            ?>
            <div class='clearfix'></div>
            <?php
            }
            ?>
            <br />
            <table class='table table-bordered table-hover'>
                <tr>
                    <th style='width: 30%;'>Número de pagaré</th>
                    <th>Subir Tabla de pagos</th>
                    <th>Ver|Editar|Eliminar</th>
                    <th>Cartas</th>
                </tr>
                <?php
                if(!empty($informacion['pagares'])){
                    foreach($informacion['pagares'] as $p){
                        $disabled = menor_en_arreglo($p['numero'],$informacion['recals']);?>
                <tr>
                    <?php
                    if($p['numero'] == 1){?>
                        <td>Pagaré <?php echo $p['numero'];?></td>
                        <td>
                            <?php if($disabled == FALSE){?>
                            <a data-number='<?php echo $p['numero'];?>' data-id="<?php echo $p['idpagare'];?>" class="btn btn-info subir" href="#subir" role="button" data-toggle="modal"><i class='icon icon-cloud-upload'></i></a>
                            <?php } ?>
                        </td>
                        <td>
                            <div class='btn-group'>
                                <a href='<?php echo site_url('contrato/pagare/'.$expediente['idexpediente'].'/'.$p['numero']);?>' class="btn" target='_blank'><i class='icon icon-eye-open'></i></a>
                                <?php if($disabled == FALSE){?>
                                <a data-terminado='<?php echo $p['terminado'];?>' data-id="<?php echo $expediente['idexpediente'];?>" data-number='<?php echo $p['numero'];?>' class="btn editar" href="#editar" role="button" data-toggle="modal" ><i class='icon icon-pencil'></i></a>
                                <a data-id="<?php echo $p['idpagare'];?>" data-number='<?php echo $p['numero'];?>' data-exp="<?php echo $expediente['idexpediente'];?>" class="btn btn-danger borrar" href="#borrar" role="button" data-toggle="modal"><i class='icon icon-trash'></i></a>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <a target='_blank' href='<?php echo base_url('uploads/contrato/consentimiento.pdf');?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Seguro de Vida</a>
                            <br />
                            <a target='_blank' href='<?php echo site_url('carta/cobranza/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Carta de Cobranza</a>
                            <br />
                            <a target='_blank' href='<?php echo site_url('carta/liberacion/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Carta de Liberación</a>
                        </td>
                    <?php
                    }else{
                    ?>
                        <td>Pagaré <?php echo $p['numero'];?></td>
                        <td>
                            <?php if($disabled == FALSE){?>
                            <a data-number='<?php echo $p['numero'];?>' data-id="<?php echo $p['idpagare'];?>" data-marcaplan='<?php echo $marca_plan;?>' class="btn btn-info crear"><i class='icon icon-cloud-upload'></i></a>
                            <span data-span="<?php echo $p['idpagare'];?>"></span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class='btn-group'>
                                <a href='<?php echo site_url('contrato/pagare/'.$expediente['idexpediente'].'/'.$p['numero']);?>' class="btn" target='_blank'><i class='icon icon-eye-open'></i></a>
                                <?php if($disabled == FALSE){?>
                                <a data-terminado='<?php echo $p['terminado'];?>' data-id="<?php echo $expediente['idexpediente'];?>" data-number='<?php echo $p['numero'];?>' class="btn editar" href="#editar" role="button" data-toggle="modal" ><i class='icon icon-pencil'></i></a>
                                <a data-id="<?php echo $p['idpagare'];?>" data-number='<?php echo $p['numero'];?>' data-exp="<?php echo $expediente['idexpediente'];?>" class="btn btn-danger borrar" href="#borrar" role="button" data-toggle="modal"><i class='icon icon-trash'></i></a>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <a target='_blank' href='<?php echo base_url('uploads/contrato/consentimiento.pdf');?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Seguro de Vida</a>
                            <br />
                            <a target='_blank' href='<?php echo site_url('carta/cobranza/'.$expediente['idexpediente'].'/'.$p['numero']);?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Carta de Cobranza</a>
                            <br />
                            <a target='_blank' href='<?php echo site_url('carta/liberacion/'.$expediente['idexpediente'].'/'.$p['numero']);?>' class='btn btn-link'><i class='icon icon-file-text'></i>&nbsp;Carta de Liberación</a>
                        </td>
                    <?php
                    }   
                    ?>
                </tr>
                <?php
                        if(in_array($p['numero'],$informacion['recals'])){?>
                <tr class='warning'>
                    <td colspan='4'>
                        <center><strong>Se ha hecho una recalendarización en este punto</strong></center>
                    </td>
                </tr>
                <?php
                        }
                    }                    
                    ?>
                
                
                <?php
                }else{?>
                <tr>
                <td>Pagaré 1</td>
                    <td>

                    </td>
                    <td>
                        <div class='btn-group'>
                            <button data-id="0" class="btn" disabled='disabled'><i class='icon icon-eye-open'></i></button>
                            <a data-terminado='no' data-id="<?php echo $expediente['idexpediente'];?>" data-number='1' class="btn editar" href="#editar" role="button" data-toggle="modal" ><i class='icon icon-pencil'></i></a>
                            <button data-id="0" class="btn btn-danger" disabled='disabled'><i class='icon icon-trash'></i></button>
                        </div>
                    </td>
                    <td>
                        <p class='text-alert'>Guarde el pagaré para ver las cartas.</p>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>

        </div>
        
        <div id="recal" class="tab-pane <?php echo (!empty($pestania) && $pestania == 'recal-li') ? 'active' : ''; ?>">
            <h3>Recalendarización</h3>
            
            <?php echo form_open('expediente/ampliar_linea'); ?>
                <input type='hidden' name='expediente' value='<?php echo $expediente['idexpediente']; ?>' />
                <input type='hidden' name='pestania' value='recal-li' />
                <table class='table table-bordered table-hover'>
                    <tr>
                        <td style='width: 30%;'>Nueva Línea Global</td>
                        <td><input type='text' name='linea' class='money input' value='<?php echo repoblar_texto('linea','linea_global',$informacion['disposicion']);?>' /></td>
                    </tr>
                    <tr>
                        <td>Nuevo Pago Mensual</td>
                        <td><input type='text' name='pago' class='money input' value='<?php echo repoblar_texto('pago','pago_mensual',$informacion['disposicion']);?>' /></td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input name='linea_user' type='submit' value='Guardar' class='btn btn-success' style='height:30px;'/>
                        </td>
                    </tr>
                </table>
                
                
                

            <?php echo form_close(); ?>
            
            

        </div>


    </div>
    <div class='clearfix'></div>

    <!-- Modal -->
    <div id="editar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Editar Pagaré</h3>
        </div>
        <div id='editar-body' class="modal-body">
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button id='editar-button' class="btn btn-primary">Guardar Cambios</button>
        </div>
    </div>

    <?php echo form_open_multipart(current_url()); ?> 
    <!-- Modal -->
    <div id="subir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
            <h3>Subir tabla de pagos.</h3>
        </div>

        <div class="modal-body">
            <div class='alert'>Únicamente puede subir achivos CSV</div>                           
            <input type='hidden' name='idalumno' value="<?php echo $expediente['alumno_idalumno']; ?>" />
            <input type='hidden' value='<?php echo $expediente['matricula']; ?>' name='mat' />
            <input type='hidden' value='<?php echo $informacion['contrato']['idcontrato'];?>' name='idcontrato' />
            <input type='hidden' value='0' name='numero' id='tabla-numero' />

            <input type='file' name='tabla_contrato' />
            <!-- <input type='submit' value='subir' clasS='btn btn-success' /> -->

        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <!--<button type='submit' class="btn btn-primary">Subir</button>-->
            <input type="hidden" name="formhid" value="tabla_pagos">
            <input type='submit' value='subir' class='btn btn-success' />
        </div>

    </div>
    <?php echo form_close(); ?>
    
    <!-- Modal -->
    <?php echo form_open('expediente/borrarpagare'); ?>
    <div id="borrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Borrar Pagaré <span id='borrar-numero'>0</span></h3>
        </div>
        <div class="modal-body">
            <input id='borrar-hidden' type='hidden' value='0' name='numero' />
            <input id='borrar-id' type='hidden' value='0' name='id' />
            <input id='borrar-exp' type='hidden' value='0' name='exp' />
            <p>Especifique sus motivos.</p>
            <textarea name='comentario' style='width:90%; height:100px;'></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <input type='submit' value='Borrar' class="btn btn-danger" />
        </div>
    </div>
    <?php echo form_close();?>

    <script type="text/javascript">





        $(document).ready(function(){
            var superuser = '<?php echo $test;?>';
            $('#myTab a').click(function (e) {
                e.preventDefault();

                $(this).tab('show');
                $('html, body').animate({scrollTop:0}, 'slow');

            });

            $('.subir').click(function(){
                var number = $(this).attr('data-number');
                $('#tabla-numero').val(number);
            });

            $('.editar').click(function(){
                var exp = $(this).attr('data-id');
                var number = $(this).attr('data-number');
                var terminado = $(this).attr('data-terminado');

                if(terminado == 'no'){
                    $("#editar-button").addClass('enviar');
                }else{

                    if(superuser == 'si'){
                        $("#editar-button").addClass('enviar');
                    }else{
                        $("#editar-button").removeClass('enviar');
                    }

                }


                $("#editar-body").html('Cargando Pagaré ' + number + ' <i class="icon icon-spin icon-spinner"></i>').load('<?php echo site_url('expediente/pagare/');?>/'+exp+'/'+number);
            });

            $(".enviar").live('click',function(){
                $("#editar-form").submit();
            });
            
            $('.borrar').click(function(){
                var id = $(this).attr('data-id');
                var number = $(this).attr('data-number');
                var exp = $(this).attr('data-exp');
                $('#borrar-hidden').val(number);
                $('#borrar-id').val(id);
                $('#borrar-exp').val(exp);
                $('#borrar-numero').html(number);
            });
            
            $('.crear').click(function(){
                var id,number,loading,x,span,plan,idexp;
                idexp = <?php echo $expediente['idexpediente'];?>;
                x = $(this);
                x.addClass('hide');
                id = x.attr('data-id');
                number = x.attr('data-number');
                plan = x.attr('data-marcaplan');
                loading = '<i class="icon icon-spin icon-spinner icon-2x"></i>';
                span = $('span[data-span="' + id + '"]');
                span.html(loading);
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('expediente/tabla_pagare');?>",
                    cache: false,
                    data: {idpagare: id, numero: number, marca_plan:plan, idexpediente:idexp}
                }).done(function( html ) {
                    $("#error_ajax").css('display','none');
                    $("#neutral_ajax").html(html);
                    $("#neutral_ajax").css('display','block');
                    span.html('');
                    x.removeClass('hide');
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).fail(function(jqXHR, textStatus,errorThrown) {
                    //alert(errorThrown);
                    $("#error_ajax").html('<p>Error al ejecutar la búsqueda.</p>');
                    $("#error_ajax").css('display','block');
                    span.html('');
                    x.removeClass('hide');
                    //$("#results").html("<center><i class='icon icon-frown' style='font-size: 20em;'><br /><span style='font-size: 16px;'>No hemos encontrado resultados.</span></i></center>");
                    //alert( "Falla en el sistema. Contacte a su administrador.");
                });
            });


        });

    </script>
<?php
}
?>



