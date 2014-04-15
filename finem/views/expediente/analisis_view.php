<?php
$user = $this->phpsession->get('user','finem');
$usuarios = $this->config->item('super_admin');?>
<br />

<br />

<?php
/*if( $expediente['avance_por'] != 0){
    $data['mensaje'] = 'Debes guardar la solicitud antes de realizar un análisis.';
    $this->load->view('errors/error_custom',$data);
}else{*/?>

<div class='tabbable tabs-left pull-left affix' style='width:18%'>
    <ul id="myTab" class="nav nav-tabs">
        <?php $pestania = (!empty($_POST['pestania'])) ? $_POST['pestania'] : ''; ?>
        <li class="<?php echo (empty($pestania)) ? 'active' : (($pestania == 'cedula-li') ? 'active' : '' ); ?>"><a data-id='cedula-li' href="#cedula">Cédula</a></li>
        <li class='<?php echo ($pestania == 'ficha-li') ? 'active' : ''; ?>'><a data-id='ficha-li' href="#ficha">Autorización</a></li>
        <!--<li class='<?php echo ($pestania == 'tabla-li') ? 'active' : ''; ?>'><a data-id='tabla-li' href="#tabla">Tabla Global</a></li>-->
    </ul>
</div>


<div class="tab-content pull-right" style='width:80%;'>

    <div id="cedula" class="tab-pane <?php echo (empty($pestania)) ? 'active' : (($pestania == 'cedula-li') ? 'active' : '' ); ?>"  >
        <?php
        $info = $informacion['info'];
        $selects = $informacion['selects'];
        $aval_info = $informacion['aval'];
        $aval = $informacion['aval'];
        $invav_info = $informacion['aval'];
        $buro_info = $informacion['buro_info'];
        $capacidad_pago = $informacion['capacidad_pago'];
        $autorizacion = $informacion['autorizacion'];
        ?>
        <div class="row-fluid" id="print_area">
            <div class="span12">
                <!--
                <style type="text/css">
                    body, textarea, select, option, input[type=text], label { font-size:11px;}
                    h1 {font-size:170%;}
                    h2 {font-size:150%;}
                    h3 {font-size:130%;}
                    h4 {font-size:120%;}
                    h5 {font-size:110%;}
                    h6 {font-size:105%;}
                    .black{ font-weight: bold;}
                </style>
                -->
                <h1>Cédula de análisis</h1>
                <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#F2F2F2;">			
                    <?php 
                    $bstatus = (isset($info['bstatus'])) ? $info['bstatus'] : '';
                    //echo $bstatus;
                    
                    if($bstatus != 1 || in_array($user['idusuario'], $usuarios)){
                        echo form_open(current_url(), 'method="POST" id="cedula"');
                    }
                    ?>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table style="width:100%;">						
                                <tr>
                                    <td width="20%" align="right" class="black" >Nombre de promotor:</td>
                                    <td width="65%" align="left" style="width:60%">
                                        &nbsp;&nbsp;
                                        <?php
                                        $creador = $informacion['creacion'];
                                        if ($creador[0]['nombre'] == '') {
                                            ?>
                                            Sistema.
                                        <?php
                                        } else {
                                            echo $creador[0]['nombre'] . ' ' . $creador[0]['apellidop'] . ' ' . $creador[0]['apellidom'];
                                        }
                                        ?>
                                    </td>
                                    <td width="10%" align="right" class="black" >Fecha:</td>
                                    <td width="15%" align="left"   style="width:15%"><?php echo (isset($info['fecha_generacion'])) ?  date('d-m-Y',strtotime($info['fecha_generacion'])) : ''; ?></td>
                                </tr>			
                            </table>
                        </div>		
                        <h2>Información general </h2>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table width="100%">												
                                <tbody>
                                    <tr>
                                        <td width="15%" align="right" class="black"  >Universidad:</td>
                                        <td width="42%" align="left"  ><?php echo $info['universidad']; ?></td>
                                        <td width="10%" align="right" class="black"  >Campus:</td>
                                        <td width="30%" align="left"  ><?php echo $info['campus']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width="100%">												
                                <tr>
                                    <td width="15%" align="right" class="black"  >Carrera:</td>
                                    <td width="40%" align="left"  ><?php echo $info['carrera']; ?></td>
                                    <td width="5%" align="right" class="black"  >Ciclo:</td>
                                    <td width="15%" align="left"  ><?php echo $info['ciclo_nuevo']; ?></td>
                                    <td width="15%" align="right" class="black"  >Matrícula:</td>
                                    <td width="15%" align="left"  ><?php echo $info['matricula']; ?></td>					
                                </tr>	
                            </table>
                            <table width="100%">												
                                <tr>
                                    <td width="15%" align="right" class="black" >Tipo de Ingreso:</td>
                                    <td width="15%" align="left">
                                        <?php $tmp = (isset($info['tipo_ingreso'])) ? $info['tipo_ingreso'] : '';?>
                                        <select class="input-medium" id="tipo_ingreso" name="tipo_ingreso">
                                            <option value="0">  -  </option>
                                            <option value="nuevo_ingreso" <?php echo repoblar_select('tipo_ingreso', 'nuevo_ingreso', $tmp);?>>Nuevo ingreso</option>
                                            <option value="re_ingreso" <?php echo repoblar_select('tipo_ingreso', 're_ingreso', $tmp);?>>Re ingreso</option>
                                        </select>
                                    </td>
                                    <td width="10%" align="right" class="black"  >Avance:</td>
                                    <td width="10%" align="left"  ><?php echo $expediente['avance_por'];?><input class='input-mini'type='hidden' name='avance_por' value="<?php echo $expediente['avance_por'];?>" />%</td>
                                    <td width="10%" align="right" class="black" >Grado:</td>
                                    <td width="10%" align="left">
                                        <?php echo $selects['grado']; ?>

                                    </td>
                                    <td width="10%" align="right" class="black"  >Promedio:</td>
                                    <td width="10%" align="left"  ><?php echo $info['promediog']; ?></td>
                                </tr>
                                <tr>
                                    <td align="right" class="black"  >Modalidad:</td>
                                    <td align="left" >
                                        <?php $tmp = obtener_campo('marca_plan.carrera','idcarrera.'.$expediente['especialidad']);
                                        echo $tmp;?>
                                        <input type='hidden' name='modalidad' value='<?php echo $tmp;?>'/>
                                        <!--<select class="input-medium" id="periodo_texto" name="modalidad">
                                            <option value="0">  -  </option>
                                            <option value="trimestral" <?php echo repoblar_select('modalidad', 'trimestral', $tmp);?> >Trimestral</option>
                                            <option value="cuatrimestral" <?php echo repoblar_select('modalidad', 'cuatrimestral', $tmp);?> >Cuatrimestral</option>
                                            <option value="semestral" <?php echo repoblar_select('modalidad', 'semestral', $tmp);?> >Semestral</option>
                                        </select>-->
                                    </td>
                                    <td align="right" >&nbsp;</td>
                                    <td align="left" >&nbsp;</td>
                                    <td align="right" >&nbsp;</td>
                                    <td align="left" >&nbsp;</td>
                                    <td align="right" >&nbsp;</td>
                                    <td align="left" >&nbsp;</td>
                                </tr>			
                            </table>
                        </div>

                        <h2>Condiciones financieras </h2>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table width="100%">												
                                <tr>
                                    <td width="20%" align="right" class="black"  >Línea solicitada:</td>
                                    <td width="20%" align="left">
                                        <input class="moneda input-medium" type="text" name="linea_solicitada" value="<?php echo repoblar_texto('linea_solicitada','linea_solicitada',$info); ?>">
                                    </td>
                                    <td width="10%" align="center"  style="text-align:left;">
                                        <?php $tmp= (isset($info['tipo_linea'])) ? $info['tipo_linea'] : '';?><?php //echo $selects['tipo_linea']; ?>
                                        <select class="input-small" id="tipo_linea" name="tipo_linea">
                                            <option value="">  -  </option>
                                            <option value="total" <?php echo repoblar_select('tipo_linea', 'total', $tmp);?> >Total</option>
                                            <option value="parcial" <?php echo repoblar_select('tipo_linea', 'parcial', $tmp);?> >Parcial</option>
                                        </select>
                                    </td>
                                    <td width="10%" align="right" class="black"  >Adeudo:</td>
                                    <td width="15%" align="left" >
                                        <input type="text" name="adeudo" value="<?php echo repoblar_texto('adeudo','adeudo',$info); ?>" class="span12 moneda">
                                    </td>
                                    <td width="10%" align="right" class="black"  >Producto:</td>
                                    <td width="15%" align="left"  >
                                        <?php echo $info['producto']; ?>
                                    </td>
                                </tr>			
                            </table>
                        </div>
                        <h2>Datos generales</h2>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table width="100%">
                                <tr>
                                    <td width="20%" align="right" class="black"  >Nombre del alumno: </td>
                                    <td align="left"  ><?php echo $info['nombre_completo']; ?></td>
                                    <td width="10%" align="right" class="black"  >Edad:</td>
                                    <td width="10%" align="left"  ><?php echo $info['edad']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <h2>Información avales</h2>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="10%" align="right" class="black"  >Aval 1:</td>
                                        <td width="35%" align="left"  ><?php echo $aval_info[0]['nombre_completo']; ?></td>
                                        <td width="15%" align="right" class="black"  >Parentesco:</td>
                                        <td width="15%" align="left" >
                                            <?php echo $aval_info[0]['parentesco']; ?>
                                        </td>
                                        <td width="15%" align="right" class="black"  >Edad:</td>
                                        <td width="10%" align="left" ><?php echo $invav_info[0]['edad']; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="right" class="black"  >Aval 2:</td>
                                        <td align="left"  ><?php echo $aval_info[1]['nombre_completo']; ?></td>
                                        <td align="right" class="black" >Parentesco:</td>
                                        <td align="left" >
                                            <?php echo $aval_info[1]['parentesco']; ?>
                                        </td>
                                        <td align="right" class="black"  >Edad:</td>
                                        <td align="left"  ><?php echo $invav_info[1]['edad']; ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <h2>Buró de Crédito</h2>
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Cuentas Abiertas</th>
                                        <th>Saldo actual</th>
                                        <th>Saldo vencido</th>
                                        <th>MOP</th>
                                        <th>Comentarios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="5%" align="right" class="black"> Alumno:</td>
                                        <!-- <td width="10%" align="right" class="black">Cuentas abiertas:</td> -->
                                        <td width="15%" align="left">
                                            <input type="text" name="cuenta_alu" value="<?php echo repoblar_texto('cuenta_alu','cuenta_alu',$buro_info); ?>" class="input-small moneda">
                                        </td>
                                        <!-- <td width="10%" align="right" class="black">Saldo actual:</td> -->
                                        <td width="15%" align="left" >
                                            <input type="text" name="saldo_actual_alu" value="<?php echo repoblar_texto('saldo_actual_alu','saldo_actual_alu',$buro_info); ?>" class="input-small moneda">
                                        </td>
                                        <!-- <td width="10%" align="right" class="black">Saldo vencido:</td> -->
                                        <td width="15%" align="left">
                                            <input type="text" name="saldo_vencido_alu" value="<?php echo repoblar_texto('saldo_vencido_alu','saldo_vencido_alu',$buro_info); ?>" class="input-small moneda">
                                        </td>
                                        <!-- <td width="10%" align="right" class="black">MOP:</td> -->
                                        <td width="15%" align="left">
                                            <input type="text" name="mop_alumno" value="<?php echo repoblar_texto('mop_alumno','mop_alumno',$buro_info); ?>" class="input-small moneda">
                                        </td>
                                        <td width="35%" align="right">
                                            <input type="text" name="com_alumno" value="<?php echo repoblar_texto('com_alumno','com_alumno',$buro_info); ?>" class="span12">
                                        </td>
                                    </tr>
                                    <?php
                                    for($i = 1; $i < 3; $i++){?>
                                    <tr>
                                        <td align="right" class="black"  > Aval <?php echo $i;?>:</td>							
                                        <td align="left">
                                            <input type="text" name="cuenta_aval<?php echo $i;?>" value="<?php echo repoblar_texto('cuenta_aval'.$i,'cuenta_aval'.$i,$buro_info); ?>" class="input-small moneda">
                                        </td>							
                                        <td align="left">
                                            <input type="text" name="saldo_actual_aval<?php echo $i;?>" value="<?php echo repoblar_texto('saldo_actual_aval'.$i,'saldo_actual_aval'.$i,$buro_info); ?>" class="input-small moneda">
                                        </td>							
                                        <td align="left">
                                            <input type="text" name="saldo_vencido_aval<?php echo $i;?>" value="<?php echo repoblar_texto('saldo_vencido_aval'.$i,'saldo_vencido_aval'.$i,$buro_info); ?>" class="input-small moneda">
                                        </td>							
                                        <td align="left">
                                            <input type="text" name="mop_aval<?php echo $i;?>" value="<?php echo repoblar_texto('mop_aval'.$i,'mop_aval'.$i,$buro_info); ?>" class="input-small moneda">
                                        </td>
                                        <td align="right">
                                            <input type="text" name="com_aval<?php echo $i;?>" value="<?php echo repoblar_texto('com_aval'.$i,'com_aval'.$i,$buro_info); ?>" class="span12">
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <h3>Comentarios</h3>
                        <textarea rows="3" class="span12" name="comentario_buro" style="width:100%;"><?php echo repoblar_texto('comentario_buro','comentario_buro',$info); ?></textarea>            

                        <div class="pull-right">
                            Ingreso mínimo por universidad:
                            <input class="moneda" type="text" name="ingreso_minimo" id="ingreso_minimo" value="<?php echo repoblar_texto('ingreso_minimo','ingreso_minimo',$info); ?>">
                        </div>
                        <h2>Capacidad de pago</h2>			
                        <div style="border:solid 1px #CCC; padding:5px; margin-top:15px; background-color:#FFF;">
                            <?php $tmp = (isset($capacidad_pago['inmueble'])) ? $capacidad_pago['inmueble'] : '';?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="30%" height="22" align="right" class="black"  ><p>Presenta   bien inmueble:</p></td>
                                    <td width="7%" align="center">
                                        <input type="radio" name="inmueble" id="inmueble_si" value="si" <?php echo repoblar_radio('inmueble','si',$tmp); ?>/>
                                        <label for="inmueble_si">Sí</label>
                                    </td>
                                    <td width="7%" align="center">
                                        <input type="radio" name="inmueble" id="inmueble_no" value="no" <?php echo repoblar_radio('inmueble','no',$tmp); ?>/>
                                        <label for="inmueble_no">No</label>
                                    </td>
                                    <?php $tmp = (isset($capacidad_pago['excepcion'])) ? $capacidad_pago['excepcion'] : '';?>
                                    <td width="30%" align="right" class="black"  ><p>Excepción de bien inm.:</p></td>
                                    <td width="7%" align="center" >
                                        <input type="radio" name="excepcion" id="excepcion_si" value="si" <?php echo repoblar_radio('excepcion','si',$tmp); ?> />
                                        <label for="excepcion_si">Sí</label>
                                    </td>
                                    <td width="12%" align="center" >
                                        <input type="radio" name="excepcion" id="excepcion_no" value="no" <?php echo repoblar_radio('excepcion','no',$tmp); ?>/>
                                        <label for="excepcion_no">No</label>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td align="right" >&nbsp;</td>
                                        <td align="right" >&nbsp;</td>
                                        <td align="right" >&nbsp;</td>
                                        <td align="left" >&nbsp;</td>
                                        <td align="center" >Comentarios</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" align="right" class="black"  >Ingreso Bruto del Alumno:</td>
                                        <td width="15%" align="right">								
                                            <input type="text" name="ingreso_bruto_alu" value="<?php echo repoblar_texto('ingreso_bruto_alu','ingreso_bruto_alu',$capacidad_pago); ?>" class="input-small moneda ingresos">
                                        </td>
                                        <td width="10%" align="right" class="black"  >Documento:</td>
                                        <td width="15%" align="left" >
                                            <?php //echo $selects['documentacion_alumno']; ?>
                                            <?php $tmp = (isset($capacidad_pago['documentacion_alumno'])) ? $capacidad_pago['documentacion_alumno'] : '';?>
                                            <select class="span12" id="documentacion_alumno" name="documentacion_alumno">
                                                <option value="0">  -  </option>
                                                <option value="recipo_pension" <?php echo repoblar_select('documentacion_alumno', 'recipo_pension', $tmp);?> >Recibo de pensión</option>
                                                <option value="recibo_nomina" <?php echo repoblar_select('documentacion_alumno', 'recibo_nomina', $tmp);?>>Recibo de nómina</option>
                                                <option value="carta_membretada" <?php echo repoblar_select('documentacion_alumno', 'carta_membretada', $tmp);?>>Carta de ingresos membretada</option>
                                                <option value="edo_cta" <?php echo repoblar_select('documentacion_alumno', 'edo_cta', $tmp);?>>Estado de cuenta bancario</option>
                                                <option value="dec_impuesto" <?php echo repoblar_select('documentacion_alumno', 'dec_impuesto', $tmp);?>>Declaración de impuestos</option>
                                                <option value="recibo_honorarios" <?php echo repoblar_select('documentacion_alumno', 'recibo_honorarios', $tmp);?> >Recibo de honorarios o renta</option>
                                                <option value="carta_declara" <?php echo repoblar_select('documentacion_alumno', 'carta_declara', $tmp);?>>Carta declaratoria de ingresos</option>
                                            </select>
                                        </td>
                                        <td width="30%" align="left">
                                            <input class="span12" type="text" name="comentario_bruto_alumno" value="<?php echo repoblar_texto('comentario_bruto_alumno','comentario_bruto_alumno',$capacidad_pago); ?>">
                                        </td>
                                    </tr>
                                    <?php
                                    for($i = 1; $i < 3; $i++){?>
                                    <tr>
                                        <td align="right" class="black"  >Ingreso Bruto del Aval <?php echo $i;?>:</td>
                                        <td align="right"  class="">
                                            <input type="text" name="ingreso_bruto_aval<?php echo $i;?>" value="<?php echo repoblar_texto('ingreso_bruto_aval'.$i,'ingreso_bruto_aval'.$i,$capacidad_pago); ?>" class="input-small moneda ingresos">
                                        </td>
                                        <td align="right" class="black"  >Documento:</td>
                                        <td align="left" >
                                            <?php $tmp = (isset($capacidad_pago['documentacion_aval'.$i])) ? $capacidad_pago['documentacion_aval'.$i] : '';//echo $selects['documentacion_aval1']; ?>
                                            <select class="span12" id="documentacion_aval<?php echo $i;?>" name="documentacion_aval<?php echo $i;?>">
                                                <option value="0">  -  </option>
                                                <option value="recipo_pension" <?php echo repoblar_select('documentacion_aval'.$i, 'recipo_pension', $tmp);?> >Recibo de pensión</option>
                                                <option value="recibo_nomina" <?php echo repoblar_select('documentacion_aval'.$i, 'recibo_nomina', $tmp);?>>Recibo de nómina</option>
                                                <option value="carta_membretada" <?php echo repoblar_select('documentacion_aval'.$i, 'carta_membretada', $tmp);?>>Carta de ingresos membretada</option>
                                                <option value="edo_cta" <?php echo repoblar_select('documentacion_aval'.$i, 'edo_cta', $tmp);?>>Estado de cuenta bancario</option>
                                                <option value="dec_impuesto" <?php echo repoblar_select('documentacion_aval'.$i, 'dec_impuesto', $tmp);?>>Declaración de impuestos</option>
                                                <option value="recibo_honorarios" <?php echo repoblar_select('documentacion_aval'.$i, 'recibo_honorarios', $tmp);?> >Recibo de honorarios o renta</option>
                                                <option value="carta_declara" <?php echo repoblar_select('documentacion_aval'.$i, 'carta_declara', $tmp);?>>Carta declaratoria de ingresos</option>
                                            </select>
                                        </td>
                                        <td align="left">
                                            <input class="span12" type="text" name="comentario_bruto_aval<?php echo $i;?>" value="<?php echo repoblar_texto('comentario_bruto_aval'.$i,'comentario_bruto_aval'.$i,$capacidad_pago); ?>">
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                    <tr>
                                        <td align="right" >&nbsp;</td>
                                        <td align="left" ></td>
                                        <td align="right" >&nbsp;</td>
                                        <td align="left" ></td>
                                        <td align="left" ></td>
                                    </tr>
                                    <tr>
                                        <td align="right" class="black"  >Total de Ingresos Comprobados:</td>                            
                                        <td align="right">
                                            <input class="moneda input-small" type="text" id="ingresos_comprobados" name="ingresos_comprobados" value="<?php echo repoblar_texto('ingresos_comprobados','ingresos_comprobados',$capacidad_pago); ?>">
                                        </td>
                                        <td align="right" class="black"  >Ingreso Estudio Socioeconómico</td>
                                        <td align="left" colspan="2">

                                            &nbsp;&nbsp;&nbsp;&nbsp;$ <?php
                                            echo number_format($info['total_ingresos_ese'], 2);
                                            //echo number_format($aval[0]['ingresoA'] + $aval[0]['ingresoC'] + $aval[1]['ingresoA'] + $aval[1]['ingresoC'] + $info['ingreso'],2); 
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" class="black"  >Pago a Realizar Buró de Crédito</td>
                                        <td align="right">
                                            <input class="moneda input-small" type="text" name="pago_buro" value="<?php echo repoblar_texto('pago_buro','pago_buro',$capacidad_pago); ?>">
                                        </td>
                                        <td align="right" class="black"  >Egresos Estudio Socioeconómico</td>
                                        <td align="left" colspan="2">
                                            &nbsp;&nbsp;&nbsp;&nbsp;$ <?php 
                                            echo number_format($info['total_egresos_ese'], 2);
                                            //echo number_format($aval[0]['egresoA'] + $aval[0]['egresoC'] + $aval[1]['egresoA'] + $aval[1]['egresoC'] + $info['egreso'],2);//number_format($info['total_egresos_ese'], 2); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h3>Comentarios</h3>
                        <textarea rows="10" class="span12" name="comentario_gral" style="width:100%;"><?php echo repoblar_texto('comentario_gral','comentario_gral',$info); ?></textarea>            			
                        <table style="width:100%;">
                            <tr>
                                <td style="width:50%;">
                                    <strong>Elaboró: </strong><?php echo (isset($info['elaboro_idusuario'])) ? obtener_campo('nombre,apellidop,apellidom.usuario', 'idusuario.'.$info['elaboro_idusuario'],TRUE) : ''; ?>
                                </td>
                                <td style="width:50%;">
                                    <strong>Revisó: </strong> <?php echo (isset($info['reviso_idusuario'])) ? obtener_campo('nombre,apellidop,apellidom.usuario', 'idusuario.'.$info['reviso_idusuario'],TRUE) : ''; ?>
                                </td>
                            </tr>				
                        </table>
                        <div class="form-actions" style="text-align:center;">	
                            <?php
                            // CONDICION PARA QUE PUEDAN CERRAR CIERTOS USUARIOS LA CÉDULA.
                            //$permiso['cerrar']['nivel'] = array(4, 7);
                            //$permiso['cerrar']['id_user'] = array(71);

                            //if (in_array($_SESSION['nivel2'], $permiso['cerrar']['nivel']) || in_array($_SESSION['id_user'], $permiso['cerrar']['id_user'])) {
                                
                            ?>
                                <input type="checkbox" name="terminar" value="1" id="bcerrar" <?php echo repoblar_radio('terminar', '1', $bstatus); ?>/> <label for="bcerrar">Revisado</label><br />
                            <?php //} ?>
                            <button style="margin:0px auto;" name="agregar" type="submit" class="btn btn-primary" id="guarda_info">Guardar</button>
                            <input type="hidden" name="formhid" value="cedula_analisis">
                            <button type="button" class="btn" id="imprime"><i class="icon-print"></i> Imprimir</button> 
                        </div>
                    <?php 
                    if($bstatus != 1 || in_array($user['idusuario'], $usuarios)){
                        echo form_close();
                    }?>
                    <!--fin marco-->
                </div>
            </div>
        </div>

    </div>

    <div id="ficha" class="tab-pane <?php echo ($pestania == 'ficha-li') ? 'active' : ''; ?>">
        <?php
        $contador = 0;
        if(isset($autorizacion['firma_1']) && isset($autorizacion['firma_2']) && isset($autorizacion['firma_3']) && isset($autorizacion['firma_4'])){
            $contador = ($autorizacion['firma_1'] == 1) ? $contador+ 1 : $contador - 1;
            $contador = ($autorizacion['firma_2'] == 1) ? $contador+ 1 : $contador - 1;
            $contador = ($autorizacion['firma_3'] == 1) ? $contador+ 1 : $contador - 1;
            $contador = ($autorizacion['firma_4'] == 1) ? $contador+ 1 : $contador - 1;
        }else{
            $contador--;
        }
        ?>
        <legend>
            <h1>Análisis</h1>
        </legend>        
        <?php echo ($contador < 0) ? form_open(current_url()) : ''; ?>
        <input type='hidden' name='pestania' id='pestania' value="<?php echo $pestania; ?>" />
        <input type='hidden' name='idalumno' value="<?php echo $expediente['alumno_idalumno']; ?>" />        
        <table class="table table-condensed table-bordered table-striped">            
            <tbody>
                <tr>
                    <td>Estado de la operación</td>
                    <td>
                        <?php 
                        $status = array(
                            'aprobado' => 'Aprobado', 
                            'declinado' => 'Declinado', 
                            'pendiente' => 'Pendiente por integrar información'
                        ); 
                        echo crea_selects($status, 'status', (isset($_POST['status']) ? $_POST['status'] : $autorizacion['estado_operacion']), 
                                'id="status"', 'Estado de la operación', '-');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="width:23%;">Fecha de elaboración</td>
                    <td style="width:77%;">
                        <?php 
                        if (isset($autorizacion['fecha_elaboracion'])) {
                            echo date('d-m-Y', strtotime($autorizacion['fecha_elaboracion'])); 
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="width:23%;">Matrícula</td>
                    <td style="width:77%;"><?php echo $info['matricula']; ?></td>
                </tr>            
            </tbody>
        </table>
        <legend><h3>Información general</h3></legend>
        <table class="table table-condensed table-bordered table-striped">
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
                    <td style="width:77%;"><?php echo $expediente['avance_por'];?> %</td>
                </tr>
            </tbody>
        </table>                
        <legend><h3>Financiamiento</h3></legend>
        <table class="table table-condensed table-bordered table-striped">
            <tbody>
                <tr>
                    <td style="width:23%;">
                        <label for="linea_global">Línea global:</label>
                    </td>
                    <td style="width:77%;">
                        <div class="input-prepend">
                            <span class="add-on">$</span>
                            <input type="text" name="linea_global" value="<?php echo repoblar_texto('linea_global','linea_global',$autorizacion) ?>" id="linea_global" class="money">
                        </div>
                    </td>   
                </tr>
                <tr>
                    <td style="width:23%;">
                        <label for="importe">Línea Parcial:</label>
                    </td>
                    <td style="width:77%;">
                        <div class="input-prepend">
                            <span class="add-on">$</span>
                            <input type="text" name="importe" value="<?php echo repoblar_texto('importe','importe',$autorizacion); ?>" id="importe" class="money">
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td style="width:23%;">
                        Esquema de crédito:
                    </td>
                    <td style="width:77%;">
                        <?php echo ucfirst(obtener_campo('marca_plan.carrera','idcarrera.'.$expediente['especialidad']));  ?>
                    </td> 
                </tr>
                <tr>
                    <td style="width:23%;">
                        Plazo del Crédito (meses):
                    </td>
                    <td style="width:77%;">
                        <input type="text" name="plazo_credito" value="<?php echo repoblar_texto('plazo_credito','plazo',$autorizacion); ?>" class="numerico" id="plazo_credito">
                            
                    </td> 
                </tr>
                <tr>
                    <td style="width:23%;">
                        Porcentaje del crédito
                    </td>
                    <td style="width:77%;">
                        <div class="input-append">
                            <input type="text" name="porc_credito" value="<?php echo repoblar_texto('porc_credito','credito_autorizado',$autorizacion); ?>" class="money" id="porc_credito">
                            <span class="add-on">%</span>
                        </div>
                    </td> 
                </tr>
            </tbody>
        </table>
        <legend><h3>Resultado paramétrico</h3></legend>
        <table class="table table-condensed table-bordered table-striped">
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
                            Satisfactorio <input type="checkbox" name="res_pago" value="si" id="res_pago" <?php echo repoblar_radio('res_pago','si',$autorizacion['capacidad_resultado'])?>>
                        </label>
                    </td>
                    <td>
                        <input type="text" name="obs_pago" value="<?php echo repoblar_texto('obs_pago','capacidad_observaciones',$autorizacion); ?>" id="obs_pago">
                    </td>
                    <td>
                        <input type="text" name="cond_pago" value="<?php echo repoblar_texto('cond_pago','capacidad_condiciones',$autorizacion); ?>" id="cond_pago">
                    </td>
                </tr>
            </tbody>
        </table>
        <legend><h3>Calificación</h3></legend>
        <table class="table table-condensed table-bordered table-striped">
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
                            Satisfactorio <input type="checkbox" name="res_buro" value="si" id="res_buro" <?php echo repoblar_radio('res_buro','si',$autorizacion['buro_resultado'])?>>
                        </label>
                    </td>
                    <td>
                        <input type="text" name="obs_buro" value="<?php echo repoblar_texto('obs_buro','buro_observaciones',$autorizacion); ?>" id="obs_buro">
                    </td>
                    <td>
                        <input type="text" name="cond_buro" value="<?php echo repoblar_texto('cond_buro','buro_condiciones',$autorizacion); ?>" id="cond_buro">
                    </td>
                </tr>
                <tr>
                    <td>Estudio socioeconómico</td> 
                    <td>
                        <label for="res_estudio" class="checkbox">
                            Satisfactorio <input type="checkbox" name="res_estudio" value="si" id="res_estudio" <?php echo repoblar_radio('res_estudio','si',$autorizacion['estudio_resultado'])?>>
                        </label>
                    </td>
                    <td>
                        <input type="text" name="obs_estudio" value="<?php echo repoblar_texto('obs_estudio','estudio_observaciones',$autorizacion); ?>" id="obs_estudio">
                    </td>
                    <td>
                        <input type="text" name="cond_estudio" value="<?php echo repoblar_texto('cond_estudio','estudio_condiciones',$autorizacion); ?>" id="cond_estudio">
                    </td>
                </tr>
            </tbody>
        </table>
        <legend><h3>Aval</h3></legend>
        <table class="table table-condensed table-bordered table-striped">
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
                        <input type="text" name="aval<?php echo $key + 1; ?>_respaldo" value="<?php echo repoblar_texto('aval'.($key + 1).'_respaldo', 'aval'.($key + 1).'_respaldo', $autorizacion); ?>" id="aval<?php echo $key + 1; ?>_respaldo">
                    </td>
                    <td>
                        <input type="text" name="aval<?php echo $key + 1; ?>_valor" value="<?php echo repoblar_texto('aval'.($key + 1).'_valor', 'aval'.($key + 1).'_valor', $autorizacion); ?>" id="aval<?php echo $key + 1; ?>_valor" class='money'>
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
            Tipo observación: 
            <?php 
            $tipo_observacion = array('edad' => 'Edad', 'inmueble' => 'Inmueble', 'calificacion' => 'Calificación', 
                'buro' => 'Aclar. buró', 'sin_aval' => 'Sin aval');
            echo crea_selects($tipo_observacion, 'tipo_obs', (!empty($_POST['tipo_obs']) ? $_POST['tipo_obs'] : $autorizacion['tipo_observacion']),
                    'id="tipo_obs"', '', ' - '); 
            ?><br>
            <textarea name='comentario_observacion' style='width:70%;'><?php echo repoblar_texto('comentario_observacion','observacion',$autorizacion); ?></textarea>
        </div>
        <legend><h3>Políticas de otorgamiento de crédito</h3></legend>        
        <div style='width:90%; margin:0px auto; text-align: center;'>            
            <textarea name='politicas' style='width:70%;'><?php echo repoblar_texto('politicas','politicas_otorgamiento',$autorizacion); ?></textarea>
        </div>
        <legend><h3>Autorización de crédito</h3></legend>      
        <?php
        if (isset($_SESSION['finem'])) {
            $session_user = $_SESSION['finem']['user']; 
        } else { // SESIÓN DEL ANTIGUO SISTEMA            
            $session_user = $_SESSION;
        }  //print_r($autorizacion);
        ?>
        
        <?php
        $foo = $this->config->item('super_admin');
        if(in_array($session_user['id_user'],$foo) && !empty($autorizacion)){?>
        <a href='<?php echo site_url('expediente/desautorizar/'.$expediente['idexpediente']);?>' class='pull-right btn btn-link'>Quitar autorizaciones</a>
        <?php
        }
        ?>
         <table class="table table-condensed table-bordered table-striped">            
            <tbody>
                <tr>
                    <td style='text-align: center;'>
                        <?php if ($autorizacion['firma_1'] == 0 || empty($autorizacion['firma_1'])) { 
                            $tmp = array(1,6); ?>
                        <input type='password' name='firma[1]' class='input-small' <?php echo (!in_array($session_user['id_user'], $tmp)) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                        <?php } else {?>
                        <h4>Autorizado</h4>
                        <?php } ?>
                    </td>
                    <td style='text-align: center;'>
                        <?php if ($autorizacion['firma_2'] == 0 || empty($autorizacion['firma_2'])) { 
                            $tmp = array(1,2);?>
                        <input type='password' name='firma[2]' class='input-small' <?php echo (!in_array($session_user['id_user'], $tmp)) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                        <?php } else {?>
                        <h4>Autorizado</h4>
                        <?php } ?>
                    </td>
                    <td style='text-align: center;'>
                        <?php if ($autorizacion['firma_3'] == 0 || empty($autorizacion['firma_3'])) {  
                            $tmp = array(1,3);?>
                        <input type='password' name='firma[3]' class='input-small' <?php echo (!in_array($session_user['id_user'], $tmp)) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                        <?php } else {?>
                        <h4>Autorizado</h4>
                        <?php } ?>
                    </td>
                    <td style='text-align: center;'>
                        <?php if ($autorizacion['firma_4'] == 0 || empty($autorizacion['firma_4'])) { 
                            $tmp = array(1,97); ?>
                        <input type='password' name='firma[4]' class='input-small' <?php echo (!in_array($session_user['id_user'], $tmp)) ? 'readonly="readonly"' : ''; ?>>
                        <br>Autoriza
                        <?php } else {?>
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
        <div class="btn-group pull-right">
            <button type="submit" class="btn btn-primary btn-success ">Guardar</button>
            <a href="<?php echo site_url('expediente/imprime_autorizacion/' . $expediente['idexpediente']);?>" target="imprime_autorizacion" title="Imprimir" class="btn" id="print_autorizacion">
                <i class="icon-print"></i> Imprimir
            </a>
        </div>
        <?php echo ($contador < 0) ? form_close() : ''; ?>
    </div>
    
    <div id="tabla" class="tab-pane <?php echo (empty($pestania) && $pestania == 'tabla-li') ? 'active' :  '' ; ?>"  >
        <div style='min-height:300px;'>
            <?php echo form_open_multipart(current_url());?>
            <input type='hidden' name='pestania' value="tabla-li" />
            <input type='hidden' name='formhid' value="tabla_global" />
            <input type='file' name='global' />
            <input type='submit' value='Subir' class='btn btn-success' />
            <?php echo form_close();?>
            
            <?php
            //print_r($informacion);
            if(!empty($informacion['tabla_global'])){?>
            <table class='table table-bordered table-hover'>
                <tr>
                    <th>Periodo</th>
                    <th>Saldo Insoluto</th>
                    <th>Capital</th>
                    <th>Intereses</th>
                    <th>Accesorios</th>
                    <th>IVA</th>
                    <th>Total</th>
                </tr>
                <?php
                foreach($informacion['tabla_global'] as $t){?>
                <tr>
                    <td><?php echo $t['mes'];?></td>
                    <td><?php echo $t['saldo_inicial'];?></td>
                    <td><?php echo $t['principal'];?></td>
                    <td><?php echo $t['interes'];?></td>
                    <td><?php echo $t['accesorios'];?></td>
                    <td><?php echo $t['iva'];?></td>
                    <td><?php echo $t['pago_total'];?></td>
                </tr>
                <?php
                }
                ?>
            </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class='clearfix'></div>

<script type="text/javascript">
    
    function printContent(id){
        str=document.getElementById(id).innerHTML
        newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
        newwin.document.write('<HTML>\n<HEAD>\n')
        newwin.document.write('<TITLE>Print Page</TITLE>\n')
        newwin.document.write('<script>\n')
        newwin.document.write('function chkstate(){\n')
        newwin.document.write('if(document.readyState=="complete"){\n')
        newwin.document.write('window.close()\n')
        newwin.document.write('}\n')
        newwin.document.write('else{\n')
        newwin.document.write('setTimeout("chkstate()",2000)\n')
        newwin.document.write('}\n')
        newwin.document.write('}\n')
        newwin.document.write('function print_win(){\n')
        newwin.document.write('window.print();\n')
        newwin.document.write('chkstate();\n')
        newwin.document.write('}\n')
        newwin.document.write('<\/script>\n')
        newwin.document.write('<link rel="stylsheet" type="text/css" href="http://www.finemsist.com/finem/Jquery/bootstrap/css/bootstrap.min.css">\n')            
        newwin.document.write('<style>body, table { font-family: Arial; font-size: 11px;} </style>')            
        newwin.document.write('</HEAD>\n')
        //onload="print_win()"
        newwin.document.write('<BODY onload="print_win()" >\n')
        //newwin.document.write('<BODY>\n')
        newwin.document.write('<div class="hero-unit" style="font-size:11px;" >\n')
        newwin.document.write(str)
        newwin.document.write('<\/div>\n')
        newwin.document.write('</BODY>\n')
        newwin.document.write('</HTML>\n')
        newwin.document.close()
    }

    $(document).ready(function(){
        
        $('#imprime').click(function () {			
            $('.alert').hide();
            printContent('print_area');	
        });
        
        $('#myTab a').click(function (e) {
            var pestania;
            e.preventDefault();
            pestania = $(this).attr('data-id');
            //alert(pestania);
            $("#pestania").val(pestania);            
            $(this).tab('show');
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        
        <?php
        if($bstatus == 1 && !in_array($user['idusuario'], $usuarios)){?>
            $("#cedula input, #cedula select, #cedula textarea").attr('readonly','readonly');
            $("#cedula input[type=radio], #cedula input[type=checkbox]").attr('onClick','javascript: return false;');
        <?php
        }?>
    });
    
    $('#print_autorizacion').click(function() {
        window.open(this.href, this.target, 'width=350, height=350');
        return false;
    });

</script>
<?php
//}
    ?>


