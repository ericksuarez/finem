<?php $this->load->view('common/header'); ?>

<div id="contenido" >
    <?php $this->load->view('investigacion/general'); ?>
    <div id="print-zone">
    <?php echo ($expediente['investigado'] == 'NO') ? form_open(current_url(), array('class' => 'form-horizontal')) : ''; ?>
    
    <?php
    for($i = 1; $i < 3; $i++){?>
    <div class="row-fluid">
        <div class="span12">

            <fieldset>

                <!-- Form Name -->
                <legend>DATOS DEL AVAL<?php echo $i;?></legend>

                <!-- Text input-->
                <div class="control-group">
                    <?php $tmp = (isset($info['aval_oficial'.$i])) ? $info['aval_oficial'.$i] : ''; ?>
                    <select name='aval_oficial<?php echo $i;?>'>
                        <option value=''>Seleccione una opción</option>
                        <option value="ife" <?php echo repoblar_select('aval_oficial'.$i, 'ife', $tmp); ?> >Credencial para Votar</option>
                        <option value="pasaporte" <?php echo repoblar_select('aval_oficial'.$i, 'pasaporte', $tmp); ?> >Pasaporte Mexicano</option>
                        <option value="cartilla" <?php echo repoblar_select('aval_oficial'.$i, 'cartilla', $tmp); ?> >Cartilla del Servicio Militar</option>
                        <option value="cedula" <?php echo repoblar_select('aval_oficial'.$i, 'cedula', $tmp); ?> >Cédula Profesional</option>
                    </select>
                    &nbsp;
                    <em>Número:</em>
                    <input name="aval_identi<?php echo $i;?>" class="input-small" id="aval_identi<?php echo $i;?>" type="text" placeholder="Identificación" value="<?php echo repoblar_texto('aval_identi'.$i, 'identificacion_aval'.$i, $info);?>">
                    
                </div>

            </fieldset>


            <legend>GENERALES</legend>
            <div class="row-fluid">
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_nom<?php echo $i;?>">NOMBRE:</label>
                            <div class="controls">
                                <input name="aval_nom<?php echo $i;?>" class="input-large" id="aval_nom<?php echo $i;?>" type="text" placeholder="Nombre del padre" value="<?php echo repoblar_texto('aval_nom'.$i, 'nombre_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_civil<?php echo $i;?>">ESTADO CIVIL:</label>
                            <div class="controls">
                                <input name="aval_civil<?php echo $i;?>" class="input-medium" id="aval_civil<?php echo $i;?>" type="text" placeholder="Estado Civil" value="<?php echo repoblar_texto('aval_civil'.$i, 'estado_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_regimen<?php echo $i;?>">RÉGIMEN:</label>
                            <div class="controls">
                                <input name="aval_regimen<?php echo $i;?>" class="input-medium" id="aval_regimen<?php echo $i;?>" type="text" placeholder="Régimen" value="<?php echo repoblar_texto('aval_regimen'.$i, 'regimen_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_dependientes<?php echo $i;?>">DEPENDIENTES</label>
                            <div class="controls">
                                <input name="aval_dependientes<?php echo $i;?>" class="input-medium" id="aval_dependientes<?php echo $i;?>" type="text" placeholder="Dependientes" value="<?php echo repoblar_texto('aval_dependientes'.$i, 'dependientes_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_conyuge<?php echo $i;?>">NOMBRE DEL CONYUGE:</label>
                            <div class="controls">
                                <input name="aval_conyuge<?php echo $i;?>" class="input-medium" id="aval_conyuge<?php echo $i;?>" type="text" placeholder="Nombre del conyuge" value="<?php echo repoblar_texto('aval_conyuge'.$i, 'nombre_conyuge_aval'.$i, $info);?>">

                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_fecha<?php echo $i;?>">FECHA DE NACIMIENTO:</label>
                            <div class="controls">
                                <input name="aval_fecha<?php echo $i;?>" class="input-small" id="aval_fecha<?php echo $i;?>" type="text" placeholder="dd-mm-aaaa" value="<?php echo repoblar_texto('aval_fecha'.$i, 'fecha_nacimiento_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_nacimiento<?php echo $i;?>">LUGAR DE NACIMIENTO:</label>
                            <div class="controls">
                                <input name="aval_nacimiento<?php echo $i;?>" class="input-medium" id="aval_nacimiento<?php echo $i;?>" type="text" placeholder="Lugar de nacimiento" value="<?php echo repoblar_texto('aval_nacimiento'.$i, 'lugar_nacimiento_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_rfc<?php echo $i;?>">R.F.C.:</label>
                            <div class="controls">
                                <input name="aval_rfc<?php echo $i;?>" class="input-medium" id="aval_rfc<?php echo $i;?>" type="text" placeholder="R.F.C." value="<?php echo repoblar_texto('aval_rfc'.$i, 'rfc_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_edad<?php echo $i;?>">EDAD:</label>
                            <div class="controls">
                                <input name="aval_edad<?php echo $i;?>" class="input-mini" id="aval_edad<?php echo $i;?>" type="text" placeholder="00" value="<?php echo repoblar_texto('aval_edad'.$i, 'edad_aval'.$i, $info);?>">

                            </div>
                        </div>

                    </fieldset>



                </div>




            </div>
        </div>
    </div>


    <div class="row-fluid">
        <div class="span12">

            <legend>DOMICILIO</legend>
            <div class="row-fluid">
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_calle<?php echo $i;?>">CALLE Y NUMERO:</label>
                            <div class="controls">
                                <input name="aval_calle<?php echo $i;?>" class="input-large" id="aval_calle<?php echo $i;?>" type="text" placeholder="Calle y número" value="<?php echo repoblar_texto('aval_calle'.$i, 'calle_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_delegacion<?php echo $i;?>">MUNICIPIO ó DELEGACIÓN:</label>
                            <div class="controls">
                                <input name="aval_delegacion<?php echo $i;?>" class="input-medium" id="aval_delegacion<?php echo $i;?>" type="text" placeholder="Municipio o delegación" value="<?php echo repoblar_texto('aval_delegacion'.$i, 'municipio_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_cp<?php echo $i;?>">C.P.:</label>
                            <div class="controls">
                                <input name="aval_cp<?php echo $i;?>" class="input-medium" id="aval_cp<?php echo $i;?>" type="text" placeholder="C.P." value="<?php echo repoblar_texto('aval_cp'.$i, 'cp_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_tel<?php echo $i;?>">TELÉFONO:</label>
                            <div class="controls">
                                <input name="aval_tel<?php echo $i;?>" class="input-medium" id="aval_tel<?php echo $i;?>" type="text" placeholder="Teléfono" value="<?php echo repoblar_texto('aval_tel'.$i, 'tel_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_mail<?php echo $i;?>">E-MAIL:</label>
                            <div class="controls">
                                <input name="aval_mail<?php echo $i;?>" class="input-medium" id="aval_mail<?php echo $i;?>" type="text" placeholder="E-Mail" value="<?php echo repoblar_texto('aval_mail'.$i, 'email_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_correspondencia<?php echo $i;?>">Domicilio en el que se enviará la correspondencia:</label>
                            <div class="controls">
                                <input name="aval_correspondencia<?php echo $i;?>" class="input-medium" id="aval_correspondencia<?php echo $i;?>" type="text" placeholder="" value="<?php echo repoblar_texto('aval_correspondencia'.$i, 'domicilio_aval'.$i, $info);?>"> 

                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="control-group">
                            <label class="control-label" for="aval_relacion<?php echo $i;?>">Relación con el solicitante</label>
                            <div class="controls">                     
                                <textarea name="aval_relacion<?php echo $i;?>" id="aval1_relacion" placeholder="Relación con el Solicitante" ><?php echo repoblar_texto('aval_relacion'.$i, 'relacion_aval'.$i, $info);?></textarea>
                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_colonia<?php echo $i;?>">COLONIA:</label>
                            <div class="controls">
                                <input name="aval_colonia<?php echo $i;?>" class="input-small" id="aval_fcolonia<?php echo $i;?>" type="text" placeholder="Colonia" value="<?php echo repoblar_texto('aval_colonia'.$i, 'colonia_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_calles<?php echo $i;?>">ENTRE LAS CALLES:</label>
                            <div class="controls">
                                <input name="aval_calles<?php echo $i;?>" class="input-medium" id="aval1_calles<?php echo $i;?>" type="text" placeholder="" value="<?php echo repoblar_texto('aval_calles'.$i, 'entre_calles_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_estado<?php echo $i;?>">ESTADO:</label>
                            <div class="controls">
                                <input name="aval_estado<?php echo $i;?>" class="input-medium" id="aval_estado<?php echo $i;?>" type="text" placeholder="" value="<?php echo repoblar_texto('aval_estado'.$i, 'domestado_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_cel<?php echo $i;?>">CELULAR:</label>
                            <div class="controls">
                                <input name="aval_cel<?php echo $i;?>" class="input-medium" id="aval_cel<?php echo $i;?>" type="text" placeholder="Celular" value="<?php echo repoblar_texto('aval_cel'.$i, 'celular_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_arraigo<?php echo $i;?>">ARRAIGO:</label>
                            <div class="controls">
                                <input name="aval_arraigo<?php echo $i;?>" class="input-medium" id="aval1_arraigo<?php echo $i;?>" type="text" placeholder="Arraigo" value="<?php echo repoblar_texto('aval_arraigo'.$i, 'arraigo_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="control-group">
                            <label class="control-label" for="aval_problema<?php echo $i;?>">Problema acceso ó vigilancia</label>
                            <div class="controls">                     
                                <textarea name="aval_problema<?php echo $i;?>" id="aval_problema<?php echo $i;?>" placeholder="Problema acceso o vigilancia"><?php echo repoblar_texto('aval_problema'.$i, 'problema_aval'.$i, $info);?></textarea>
                            </div>
                        </div>


                    </fieldset>





                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <legend>TRABAJO</legend>
            <div class="row-fluid">
                <div class="span6">

                    <fieldset>
                        <!-- Select Basic -->
                        <div class="control-group">
                            <label class="control-label" for="aval_trabaja">Trabaja el Aval:</label>
                            <div class="controls">
                                <?php $tmp= (isset($info['trabaja_act_aval'.$i])) ? $info['trabaja_act_aval'.$i] : ''; ?>
                                <select name="aval_trabaja<?php echo $i;?>" class="input-mini" id="aval_trabaja<?php echo $i;?>" >
                                    <option value='si' <?php echo repoblar_select('aval_trabaja'.$i,'si', $tmp); ?>>Si</option>
                                    <option value='no' <?php echo repoblar_select('aval_trabaja'.$i, 'no', $tmp); ?>>No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_empresa<?php echo $i;?>">Nombre de la Empresa:</label>
                            <div class="controls">
                                <input name="aval_empresa<?php echo $i;?>" class="input-large" id="aval_empresa<?php echo $i;?>" type="text" placeholder="Empresa" value="<?php echo repoblar_texto('aval_trabaja'.$i, 'empresa_dtrabajo_aval'.$i, $info);?>" >
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_puesto<?php echo $i;?>">Puesto específico:</label>
                            <div class="controls">
                                <input name="aval_puesto<?php echo $i;?>" class="input-medium" id="aval_puesto<?php echo $i;?>" type="text" placeholder="Puesto" value="<?php echo repoblar_texto('aval_puesto'.$i, 'puesto_dtrabajo_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_trdom<?php echo $i;?>">Domicilio completo:</label>
                            <div class="controls">
                                <input name="aval_trdom<?php echo $i;?>" class="input-large" id="aval_trdom<?php echo $i;?>" type="text" placeholder="Domicilio" value="<?php echo repoblar_texto('aval_trdom'.$i, 'dom_dtrabajo_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Prepended text-->
                        <div class="control-group">
                            <label class="control-label" for="aval_ingreso<?php echo $i;?>">Ingreso Mensual Bruto</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input name="aval_ingreso<?php echo $i;?>" class="input-small money" id="aval_ingreso<?php echo $i;?>" type="text" placeholder="0.00" value="<?php echo repoblar_texto('aval_ingreso'.$i, 'ingreso_m_aval'.$i, $info);?>">
                                </div>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_verificacion<?php echo $i;?>">Verificación empleo, Informante:</label>
                            <div class="controls">
                                <input name="aval_verificacion<?php echo $i;?>" class="input-large" id="aval_verificacion<?php echo $i;?>" type="text" placeholder="" value="<?php echo repoblar_texto('aval_verificacion'.$i, 'verificacion_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_piso<?php echo $i;?>">Piso:</label>
                            <div class="controls">
                                <input name="aval_piso<?php echo $i;?>" class="input-large" id="aval_piso<?php echo $i;?>" type="text" placeholder="Piso" value="<?php echo repoblar_texto('aval_piso'.$i, 'piso_avaltra'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_departamento<?php echo $i;?>">Departamento:</label>
                            <div class="controls">
                                <input name="aval_departamento<?php echo $i;?>" class="input-large" id="aval_departamento<?php echo $i;?>" type="text" placeholder="Departamento" value="<?php echo repoblar_texto('aval_departamento'.$i, 'departamento_emp_aval'.$i, $info);?>">

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span6">

                    <fieldset>



                        <!-- Select Basic -->
                        <div class="control-group">
                            <label class="control-label" for="aval_tipoempresa<?php echo $i;?>">Empresa</label>
                            <div class="controls">
                                <?php $tmp=(isset($info['tipo_emp_aval'.$i])) ? $info['tipo_emp_aval'.$i] : '';?>
                                <select name="aval_tipoempresa<?php echo $i;?>" class="input-small" id="aval_tipoempresa<?php echo $i;?>">
                                    <option value='publica'<?php echo repoblar_select('aval_tipoempresa' .$i, 'publica', $tmp); ?>>Pública</option>
                                    <option value='privada'<?php echo repoblar_select('aval_tipoempresa'.$i, 'privada', $tmp); ?>>Privada</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_nivel<?php echo $i;?>">Nivel:</label>
                            <div class="controls">
                                <input name="aval_nivel<?php echo $i;?>" class="input-medium" id="aval_nivel<?php echo $i;?>" type="text" placeholder="Nivel"  value="<?php echo repoblar_texto('aval_nivel'.$i, 'nivel_emp_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_trarraigo<?php echo $i;?>">Arraigo:</label>
                            <div class="controls">
                                <input name="aval_trarraigo<?php echo $i;?>" class="input-medium" id="aval_trarraigo<?php echo $i;?>" type="text" placeholder="Arraigo" value="<?php echo repoblar_texto('aval_trarraigo'.$i, 'arraigo_emp_aval'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_trtelefono<?php echo $i;?>">Teléfono:</label>
                            <div class="controls">
                                <input name="aval_trtelefono<?php echo $i;?>" class="input-medium" id="aval_trtelefono<?php echo $i;?>" type="text" placeholder="Teléfono" value="<?php echo repoblar_texto('aval_trtelefono'.$i, 'tel_emp_aval'.$i, $info);?>">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_ext<?php echo $i;?>">Extensiones:</label>
                            <div class="controls">
                                <input name="aval_ext<?php echo $i;?>" class="input-medium" id="aval_ext<?php echo $i;?>" type="text" placeholder="Ext" value="<?php echo repoblar_texto('aval_ext'.$i, 'extencion_emp_aval'.$i, $info);?>">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_area<?php echo $i;?>">Área:</label>
                            <div class="controls">
                                <input name="aval_area<?php echo $i;?>" class="input-medium" id="aval_area<?php echo $i;?>" type="text" placeholder="Área" value="<?php echo repoblar_texto('aval_area'.$i, 'area_emp_aval'.$i, $info);?>">
                            </div>
                        </div>

                    </fieldset>




                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <div class="row-fluid">
                <div class="span6">

                    <fieldset>

                        <!-- Form Name -->
                        <legend>RESPALDO AUTOMOVIL<?php echo $i;?></legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a1<?php echo $i;?>">No. de Serie:</label>
                            <div class="controls">
                                <input name="aval_a1<?php echo $i;?>" class="input-medium" id="aval_a1<?php echo $i;?>" type="text" placeholder="No. de Serie"  value="<?php echo repoblar_texto('aval_a1'.$i, 'respaldoau_noserie'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a2<?php echo $i;?>">No. de Factura:</label>
                            <div class="controls">
                                <input name="aval_a2<?php echo $i;?>" class="input-medium" id="aval_a2<?php echo $i;?>" type="text" placeholder="No. de Factura" value="<?php echo repoblar_texto('aval_a2'.$i, 'respaldoau_nofactura'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a3<?php echo $i;?>">Marca:</label>
                            <div class="controls">
                                <input name="aval_a3<?php echo $i;?>" class="input-medium" id="aval_a3<?php echo $i;?>" type="text" placeholder="Marca" value="<?php echo repoblar_texto('aval_a3'.$i, 'respaldoau_marca'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a4<?php echo $i;?>">Tipo:</label>
                            <div class="controls">
                                <input name="aval_a4<?php echo $i;?>" class="input-medium" id="aval_a4<?php echo $i;?>" type="text" placeholder="Tipo" value="<?php echo repoblar_texto('aval_a4'.$i, 'respaldoau_notipo'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a5">Modelo:</label>
                            <div class="controls">
                                <input name="aval_a5<?php echo $i;?>" class="input-medium" id="aval_a5<?php echo $i;?>" type="text" placeholder="Modelo" value="<?php echo repoblar_texto('aval_a5'.$i, 'respaldoau_modelo'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a6<?php echo $i;?>">Placas:</label>
                            <div class="controls">
                                <input name="aval_a6<?php echo $i;?>" class="input-medium" id="aval_a6<?php echo $i;?>" type="text" placeholder="Placas"  value="<?php echo repoblar_texto('aval_a6'.$i, 'respaldoau_placas'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a7<?php echo $i;?>">Aseguradora:</label>
                            <div class="controls">
                                <input name="aval_a7<?php echo $i;?>" class="input-medium" id="aval_a7<?php echo $i;?>" type="text" placeholder="Aseguradora"     value="<?php echo repoblar_texto('aval_a7'.$i, 'respaldoau_aseguradora'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_a8<?php echo $i;?>">Cobertura:</label>
                            <div class="controls">
                                <input name="aval_a8<?php echo $i;?>" class="input-medium" id="aval_a8<?php echo $i;?>" type="text" placeholder="Cobertura"   value="<?php echo repoblar_texto('aval_a8'.$i, 'respaldoau_cobertura'.$i, $info);?>">

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval1_a9<?php echo $i;?>">Valor Comercial:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input name="aval_a9<?php echo $i;?>" class="input-medium money" id="aval1_a9<?php echo $i;?>" type="text" placeholder="Valor comercial"  value="<?php echo repoblar_texto('aval_a9'.$i, 'respaldoau_valor'.$i, $info);?>" />
                                </div>
                                

                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval1_a10<?php echo $i;?>">Adeudo Actual:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input name="aval_a10<?php echo $i;?>" class="input-medium money" id="aval1_a10<?php echo $i;?>" type="text" placeholder="Adeudo actual" value="<?php echo repoblar_texto('aval_a10'.$i, 'respaldoau_adeudo'.$i, $info);?>" />
                                </div>
                                

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span6">

                    <fieldset>

                        <!-- Form Name -->
                        <legend>RESPALDO INMUEBLE<?php echo $i;?></legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i1<?php echo $i;?>">Domicilio:</label>
                            <div class="controls">
                                <input name="aval_i1<?php echo $i;?>" class="input-medium" id="aval_i1<?php echo $i;?>" type="text" placeholder="Domicilio" value="<?php echo repoblar_texto('aval_i1'.$i, 'respaldoin_domicilio'.$i, $info);?>">

                            </div>
                        </div>
                        <br>
                        <!-- Appended Input-->
                        <div class="control-group">
                            <label class="control-label" for="aval1_i2<?php echo $i;?>">Superficie del Terreno</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input name="aval_i2<?php echo $i;?>" class="input-medium" id="aval_i2<?php echo $i;?>" type="text" placeholder="0"  value="<?php echo repoblar_texto('aval_i2'.$i, 'respaldoin_superficie'.$i, $info);?>">
                                    <span class="add-on">m&sup2;</span>
                                </div>

                            </div>
                        </div>

                        <!-- Appended Input-->
                        <div class="control-group">
                            <label class="control-label" for="aval1_i3<?php echo $i;?>">Construcción</label>
                            <div class="controls">
                                <div class="input-append">
                                    <input name="aval_i3<?php echo $i;?>" class="input-medium" id="aval_i3<?php echo $i;?>" type="text" placeholder="0" value="<?php echo repoblar_texto('aval_i3'.$i, 'respaldoin_construccion'.$i, $info);?>">
                                    <span class="add-on">m&sup2;</span>
                                </div>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i4<?php echo $i;?>">Edo. de Conservación:</label>
                            <div class="controls">
                                <input name="aval_i4<?php echo $i;?>" class="input-medium" id="aval_i4<?php echo $i;?>" type="text" placeholder="Edo. de Conservación" value="<?php echo repoblar_texto('aval_i4'.$i, 'respaldoin_edodeconservacion'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i5<?php echo $i;?>">Registro Público:</label>
                            <div class="controls">
                                <input name="aval_i5<?php echo $i;?>" class="input-medium" id="aval_i5<?php echo $i;?>" type="text" placeholder="Registro público"  value="<?php echo repoblar_texto('aval_i5'.$i, 'respaldoin_registro'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i6<?php echo $i;?>">Gravámenes:</label>
                            <div class="controls">
                                <input name="aval_i6<?php echo $i;?>" class="input-medium" id="aval_i6<?php echo $i;?>" type="text" placeholder="Gravámenes"   value="<?php echo repoblar_texto('aval_i6'.$i, 'respaldoin_gravemenes'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i7<?php echo $i;?>">Acreedor:</label>
                            <div class="controls">
                                <input name="aval_i7<?php echo $i;?>" class="input-medium" id="aval_i7" type="text" placeholder="Acreedor" value="<?php echo repoblar_texto('aval_i7'.$i, 'respaldoin_acredor'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i8<?php echo $i;?>">Propietario:</label>
                            <div class="controls">
                                <input name="aval_i8<?php echo $i;?>" class="input-medium" id="aval_i8<?php echo $i;?>" type="text" placeholder="Propietario" value="<?php echo repoblar_texto('aval_i8'.$i, 'respaldoin_propietario'.$i, $info);?>">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i9<?php echo $i;?>">Valor Comercial:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input name="aval_i9<?php echo $i;?>" class="input-medium money" id="aval_i9<?php echo $i;?>" type="text" placeholder="Valor Comercial" value="<?php echo repoblar_texto('aval_i9'.$i, 'respaldoin_valor'.$i, $info);?>" />
                                </div>
                                

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="aval_i10<?php echo $i;?>">Adeudo Actual:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input name="aval_i10<?php echo $i;?>" class="input-medium money" id="aval_i10<?php echo $i;?>" type="text" placeholder="Adeudo Actual" value="<?php echo repoblar_texto('aval_10'.$i, 'respaldoin_acuerdo'.$i, $info);?>" />
                                </div>
                                

                            </div>
                        </div>

                    </fieldset>


                </div>
            </div>
        </div>
    </div>



    
    
    <?php
    }
    ?>
    
    <div class="row-fluid">
        <div class="span12">

            <fieldset>

                <!-- Form Name -->
                <legend>COMENTARIOS</legend>
                    
                <textarea name="comentarios" id="comentarios" style="width: 100%; height: 200px;" placeholder="Comentarios"><?php echo repoblar_texto('comentarios', 'comentario', $info);?></textarea>
                    
                

            </fieldset>

            <legend style="font-size:16px">INVESTIGADOR: </legend>
            <div class="row-fluid">
                <div class="span4">

                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Nombre (s) </legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="investigador_nom"></label>
                            <div class="">
                                <input name="investigador_nom" class="input-xlarge" id="investigador_nom" type="text" placeholder="Nombre (s)" value="<?php echo repoblar_texto('investigador_nom', 'nombre_investigador', $info);?>">

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span4">


                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Apellido Paterno</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="investigador_paterno"></label>
                            <div class="">
                                <input name="investigador_paterno" class="input-xlarge" id="investigador_paterno<?php echo $i;?>" type="text" placeholder="Apellido Paterno" value="<?php echo repoblar_texto('investigador_paterno', 'apellidop_investigador', $info);?>">

                            </div>
                        </div>

                    </fieldset>

                </div>

                <div class="span4">


                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Apellido Materno</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="investigador_materno"></label>
                            <div class="">
                                <input name="investigador_materno" class="input-xlarge" id="investigador_materno"  type="text" placeholder="Apellido Materno" value="<?php echo repoblar_texto('investigador_materno', 'apellidom_investigador', $info);?>">

                            </div>
                        </div>

                    </fieldset>

                </div>

            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <legend style="font-size:16px">RESPONSABLE DE LA AGENCIA:</legend>
            <div class="row-fluid">
                <div class="span4">

                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Nombre (s)</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="responsable_nom"></label>
                            <div class="">
                                <input name="iresponsable_nom" class="input-xlarge" id="responsable_nom" type="text" placeholder="Nombre (s)" value="<?php echo repoblar_texto('iresponsable_nom', 'nombre_respagencia', $info);?>">

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span4">


                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Apellido Paterno</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="responsable_paterno"></label>
                            <div class="">
                                <input name="responsable_paterno" class="input-xlarge" id="responsable_paterno" type="text" placeholder="Apellido Paterno" value="<?php echo repoblar_texto('responsable_paterno', 'apellidop_respagencia', $info);?>">

                            </div>
                        </div>

                    </fieldset>

                </div>

                <div class="span4">


                    <fieldset>

                        <!-- Form Name -->
                        <legend style="font-size:14px">Apellido Materno</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="" for="responsable_materno"></label>
                            <div class="">
                                <input name="responsable_materno" class="input-xlarge" id="responsable_materno" type="text" placeholder="Apellido Materno" value="<?php echo repoblar_texto('responsable_materno', 'apellidom_respagencia', $info);?>">

                            </div>
                        </div>

                    </fieldset>

                </div>

            </div>
        </div>
    </div>
    <?php if($expediente['investigado'] == 'NO'){?>
    <div class='pull-right'>
        <input type='submit' value='Guardar' class='btn btn-success' />
    </div>
    <?php
    }
    ?>
    <div class='pull-left'>
        <!--<button type='button' name="imprimible" class="btn btn-default" id="imprimible">Version Imprimible</button>-->
    </div>
    <div class='clearfix'></div>
    <?php echo ($expediente['investigado'] == 'NO') ? form_close() : ''; ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/print.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.money').keyup();
        
        $("#imprimible").click(function(){
            PrintElem("#print-zone",'<?php echo base_url();?>');
        });
    });
</script>

<?php $this->load->view('common/footer'); ?>