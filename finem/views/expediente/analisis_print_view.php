<div class="tab-content" style='width:900px;'>
    <?php    
    $autorizacion = $informacion['autorizacion'];
    $info = $informacion['info'];
    $info['modalidad'] = (obtener_campo('marca_plan.carrera','idcarrera.'.$expediente['especialidad']));
    ?>
    <h1>Análisis.</h1>
    <table class="table table-condensed">            
        <tbody>
            <tr>
                <td><strong>Estado de la operación</strong></td>
                <td>
                    <?php
                    
                    $status = array(
                        'aprobado' => 'Aprobado',
                        'declinado' => 'Declinado',
                        'pendiente' => 'Pendiente por integrar información'
                    );
                    echo $status[$autorizacion['estado_operacion']];
                    ?>                    
                </td>            
                <td><strong>Fecha de elaboración</strong></td>
                <td>
                    <?php
                    if (isset($autorizacion['fecha_elaboracion'])) {
                        echo date('d-m-Y', strtotime($autorizacion['fecha_elaboracion']));
                    }
                    ?>
                </td>            
                <td><strong>Matrícula</strong></td>
                <td><?php echo $info['matricula']; ?></td>
            </tr>            
        </tbody>
    </table>
    <legend><h3>Información general</h3></legend>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td style="width:23%;">Nombre de solicitante:</td>
                <td style="width:77%;"><?php echo $info['nombre_completo']; ?></td>
            </tr>
            <tr>
                <td style="width:23%;">Producto:</td>
                <td style="width:77%;"><?php echo $info['producto']; ?></td>
            </tr>
            <tr>
                <td style="width:23%;">Institución educativa:</td>
                <td style="width:77%;"><?php echo $info['universidad']; ?></td>
            </tr>
            <tr>
                <td style="width:23%;">Plantel:</td>
                <td style="width:77%;"><?php echo $info['campus']; ?></td>
            </tr>
            <tr>
                <td style="width:23%;">Carrera</td>
                <td style="width:77%;"><?php echo $info['carrera']; ?></td>
            </tr>
            <tr>
                <td style="width:23%;">Porcentaje avance:</td>
                <td style="width:77%;"><?php echo ($info['avance_por']); ?> %</td>
            </tr>
        </tbody>
    </table>                
    <legend><h3>Financiamiento</h3></legend>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td style="width:23%;">
                    <label for="linea_global">Línea global:</label>
                </td>
                <td style="width:77%;">
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type="text" name="linea_global" value="<?php echo repoblar_texto('linea_global', 'linea_global', $autorizacion) ?>" id="linea_global" class="money">
                    </div>
                </td>   
            </tr>
            <tr>
                <td style="width:23%;">
                    <label for="importe">Importe:</label>
                </td>
                <td style="width:77%;">
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type="text" name="importe" value="<?php echo repoblar_texto('importe', 'importe', $autorizacion); ?>" id="importe" class="money">
                    </div>
                </td> 
            </tr>
            <tr>
                <td style="width:23%;">
                    Esquema de crédito:
                </td>
                <td style="width:77%;">
                    <?php echo ucfirst($info['modalidad']); ?>
                </td> 
            </tr>
           <tr>
                <td style="width:23%;">
                    Plazo del Crédito (meses):
                </td>
                <td style="width:77%;">
                    <input type="text" name="plazo_credito" value="<?php echo repoblar_texto('plazo_credito', 'plazo', $autorizacion); ?>" class="numeric" id="porc_credito">
                </td> 
            </tr>
            <tr>
                <td style="width:23%;">
                    Porcentaje del crédito
                </td>
                <td style="width:77%;">
                    <div class="input-append">
                        <input type="text" name="porc_credito" value="<?php echo repoblar_texto('porc_credito', 'credito_autorizado', $autorizacion); ?>" class="money" id="porc_credito">
                        <span class="add-on">%</span>
                    </div>
                </td> 
            </tr>
        </tbody>
    </table>
    <legend><h3>Resultado paramétrico</h3></legend>
    <table class="table table-condensed">
        <thead>
            <tr>
                <td style="width:20%">Concepto</td>
                <td style="width:15%">Resultado</td>
                <td>Observaciones</td>
                <td>Condiciones</td>
            </tr>
        </thead>
        <tbody>   
            <tr>
                <td>Capacidad de pago</td>
                <td>
                    <label for="res_pago" class="checkbox">
                        Satisfactorio <input type="checkbox" name="res_pago" value="si" id="res_pago" <?php echo repoblar_radio('res_pago', 'si', $autorizacion['capacidad_resultado']) ?>>
                    </label>
                </td>
                <td>
                    <?php echo repoblar_texto('obs_pago', 'capacidad_observaciones', $autorizacion); ?>
                </td>
                <td>
                    <?php echo repoblar_texto('cond_pago', 'capacidad_condiciones', $autorizacion); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <legend><h3>Calificación</h3></legend>
    <table class="table table-condensed">
        <thead>
            <tr>
                <td>Concepto</td>
                <td>Resultado</td>
                <td>Observaciones</td>
                <td>Condiciones</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Buró de crédito</td>
                <td>
                    <label for="res_buro" class="checkbox">
                        Satisfactorio <input type="checkbox" name="res_buro" value="si" id="res_buro" <?php echo repoblar_radio('res_buro', 'si', $autorizacion['buro_resultado']) ?>>
                    </label>
                </td>
                <td>
                    <?php echo repoblar_texto('obs_buro', 'buro_observaciones', $autorizacion); ?>
                </td>
                <td>
                    <?php echo repoblar_texto('cond_buro', 'buro_condiciones', $autorizacion); ?>
                </td>
            </tr>
            <tr>
                <td>Estudio socioeconómico</td> 
                <td>
                    <label for="res_estudio" class="checkbox">
                        Satisfactorio <input type="checkbox" name="res_estudio" value="si" id="res_estudio" <?php echo repoblar_radio('res_estudio', 'si', $autorizacion['estudio_resultado']) ?>>
                    </label>
                </td>
                <td>
                    <?php echo repoblar_texto('obs_estudio', 'estudio_observaciones', $autorizacion); ?>
                </td>
                <td>
                    <?php echo repoblar_texto('cond_estudio', 'estudio_condiciones', $autorizacion); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <legend><h3>Aval</h3></legend>
    <table class="table table-condensed">
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Respaldo</td>
                <td>Valor estimado</td>                    
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($informacion['aval']) AND is_array($informacion['aval']) AND count($informacion['aval']) > 1) {
                foreach ($informacion['aval'] as $key => $arreglo) {
                    ?>
                    <tr>
                        <td><?php echo $arreglo['nombre_completo']; ?></td>
                        <td>
                            <?php echo repoblar_texto('aval' . ($key + 1) . '_respaldo', 'aval' . ($key + 1) . '_respaldo', $autorizacion); ?>
                        </td>
                        <td>
                            <?php echo repoblar_texto('aval' . ($key + 1) . '_valor', 'aval' . ($key + 1) . '_valor', $autorizacion); ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <legend><h3>Observaciones</h3></legend>        
    <div style='width:90%; margin:0px auto; text-align: center;'>
        <strong>Tipo observación: </strong>
    <?php
    $tipo_observacion = array('edad' => 'Edad', 'inmueble' => 'Inmueble', 'calificacion' => 'Calificación',
        'buro' => 'Aclar. buró', 'sin_aval' => 'Sin aval');
    echo $tipo_observacion[$autorizacion['tipo_observacion']];
    ?><br>
        <?php echo repoblar_texto('comentario_observacion', 'observacion', $autorizacion); ?>
    </div>
    <legend><h3>Políticas de otorgamiento de crédito</h3></legend>        
    <div style='width:90%; margin:0px auto; text-align: center;'>            
        <?php echo repoblar_texto('politicas', 'politicas_otorgamiento', $autorizacion); ?>
    </div>
    <legend><h3>Autorización de crédito</h3></legend>      
    <?php
    if (isset($_SESSION['finem'])) {
        $session_user = $_SESSION['finem']['user'];
    } else { // SESIÓN DEL ANTIGUO SISTEMA            
        $session_user = $_SESSION;
    } // print_r($autorizacion);
    ?>
    <table class="table table-condensed">            
        <tbody>
            <tr>
                <td style='text-align: center;'>
    <?php if ($autorizacion['firma_1'] == 0 || empty($autorizacion['firma_1'])) { ?>
                        <input type='password' name='firma[1]' class='input-small' <?php echo ($session_user['id_user'] != 6) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                    <?php } else { ?>
                        <h4>Autorizado</h4>
                    <?php } ?>
                </td>
                <td style='text-align: center;'>
                    <?php if ($autorizacion['firma_2'] == 0 || empty($autorizacion['firma_2'])) { ?>
                        <input type='password' name='firma[2]' class='input-small' <?php echo ($session_user['id_user'] != 2) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                    <?php } else { ?>
                        <h4>Autorizado</h4>
                    <?php } ?>
                </td>
                <td style='text-align: center;'>
                    <?php if ($autorizacion['firma_3'] == 0 || empty($autorizacion['firma_3'])) { ?>
                        <input type='password' name='firma[3]' class='input-small' <?php echo ($session_user['id_user'] != 3) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                    <?php } else { ?>
                        <h4>Autorizado</h4>
                    <?php } ?>
                </td>
                <td style='text-align: center;'>
                    <?php if ($autorizacion['firma_4'] == 0 || empty($autorizacion['firma_4'])) { ?>
                        <input type='password' name='firma[4]' class='input-small' <?php echo ($session_user['id_user'] != 97) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                    <?php } else { ?>
                        <h4>Autorizado</h4>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td style='text-align: center;'>
                    <strong>CONSUELO VAZQUEZ CASTILLO</strong>
                    <br>DIRECCIÓN CRÉDITO 
                </td>
                <td style='text-align: center;'>
                    <strong>FRANCISCO MACIEL MORFIN</strong>
                    <br>DIRECTOR GENERAL
                </td>
                <td style='text-align: center;'>
                    <strong>JAIME ARZATE MALDONADO</strong>
                    <br>GERENTE JURÍDICO
                </td>
                <td style='text-align: center;'>
                    <strong>JOSÉ LUIS CABRERA MEDELLIN</strong>
                    <br>GERENTE DE CRÉDITO
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function checkstate() {
        if(document.readyState=="complete"){
            window.close();
        } else {
            setTimeout("checkstate()",1000)
        }
    }
    window.print();
    checkstate();
</script>