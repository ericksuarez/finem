<?php $this->load->view('common/header'); ?>

<div id="contenido" >
    <?php $this->load->view('investigacion/general'); ?>
    <div id="print-zone">
    <?php echo ($expediente['investigado'] == 'NO') ? form_open(current_url(), array('class' => 'form-horizontal')) : ''; ?>
    <div class="row-fluid">
        <div class="span12">

            <fieldset>

                <!-- Form Name -->
                <legend>DATOS DEL PADRE</legend>
                <!-- Text input-->
                <div class="control-group">
                    
                    <?php $tmp = (isset($info['padre_oficial'])) ? $info['padre_oficial'] : ''; ?>
                    <select name='padre_oficial'>
                        <option value=''>Seleccione una opción</option>
                        <option value="ife" <?php echo repoblar_select('padre_oficial', 'ife', $tmp); ?> >Credencial para Votar</option>
                        <option value="pasaporte" <?php echo repoblar_select('padre_oficial', 'pasaporte', $tmp); ?> >Pasaporte Mexicano</option>
                        <option value="cartilla" <?php echo repoblar_select('padre_oficial', 'cartilla', $tmp); ?> >Cartilla del Servicio Militar</option>
                        <option value="cedula" <?php echo repoblar_select('padre_oficial', 'cedula', $tmp); ?> >Cédula Profesional</option>
                    </select>
                    &nbsp;
                    <em>Número:</em>
                    <input value='<?php echo repoblar_texto('padre_identi','identificacion_padre',$info);?>'name="padre_identi" class="input-small" id="padre_identi" type="text" placeholder="Identificación" />
                    
                </div>

            </fieldset>


            <legend>GENERALES</legend>
            <div class="row-fluid">
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_nom">NOMBRE:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_nom','nombre_padre',$info);?>'name="padre_nom" class="input-large" id="padre_nom" type="text" placeholder="Nombre del padre">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_civil">ESTADO CIVIL:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_civil','estado_padre',$info);?>'name="padre_civil" class="input-medium" id="padre_civil" type="text" placeholder="Estado Civil">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_regimen">RÉGIMEN:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_regimen','regimen_padre',$info);?>' name="padre_regimen" class="input-medium" id="padre_regimen" type="text" placeholder="Régimen">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_dependientes">DEPENDIENTES</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_dependientes','dependientes_padre',$info);?>'name="padre_dependientes" class="input-medium" id="padre_dependientes" type="text" placeholder="Dependientes">

                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_fecha">FECHA DE NACIMIENTO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_fecha','fecha_nacimiento_padre',$info);?>'name="padre_fecha" class="input-small" id="padre_fecha" type="text" placeholder="dd-mm-aaaa">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_nacimiento">LUGAR DE NACIMIENTO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_nacimiento','lugar_nacimiento_padre',$info);?>'name="padre_nacimiento" class="input-medium" id="padre_nacimiento" type="text" placeholder="Lugar de nacimiento">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_rfc">R.F.C.:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_rfc','rfc_padre',$info);?>'name="padre_rfc" class="input-medium" id="padre_rfc" type="text" placeholder="R.F.C.">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_edad">EDAD:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_edad','edad_padre',$info);?>'name="padre_edad" class="input-mini" id="padre_edad" type="text" placeholder="00">

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
                            <label class="control-label" for="padre_calle">CALLE Y NÚMERO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_calle','calle_num_padre',$info);?>'name="padre_calle" class="input-large" id="padre_calle" type="text" placeholder="Calle y número">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_localidad">LOCALIDAD:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_localidad','localidad_padre',$info);?>'name="padre_localidad" class="input-medium" id="padre_localidad" type="text" placeholder="Localidad">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_tel">TELÉFONO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_tel','tel_padre',$info);?>' name="padre_tel" class="input-medium" id="padre_tel" type="text" placeholder="Teléfono">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_mail">E-MAIL:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_mail','email_padre',$info);?>' name="padre_mail" class="input-medium" id="padre_mail" type="text" placeholder="E-Mail">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_correspondencia">Domicilio en el que se enviará la correspondencia:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_carrespondencia','domicilio_padre',$info);?>' name="padre_correspondencia" class="input-medium" id="padre_correspondencia" type="text" placeholder="">

                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_colonia">COLONIA:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_colonia','colonia_padre',$info);?>'name="padre_colonia" class="input-small" id="padre_fcolonia" type="text" placeholder="Colonia">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_calles">ENTRE LAS CALLES:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_callles','entre_calles_padre',$info);?>' name="padre_calles" class="input-medium" id="padre_calles" type="text" placeholder="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_cel">CELULAR:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_cel','celular_padre',$info);?>'name="padre_cel" class="input-medium" id="padre_cel" type="text" placeholder="Celular">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_arraigo">ARRAIGO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_arrraigo','arraigo_padre',$info);?>'name="padre_arraigo" class="input-medium" id="padre_arraigo" type="text" placeholder="Arraigo">

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
                            <label class="control-label" for="padre_trabaja">Trabaja el Padre:</label>
                            <div class="controls">
                                <?php $tmp=(isset($info['trabaja_act_padre'])) ? $info['trabaja_act_padre'] : '';?>
                                <select name="padre_trabaja" class="input-mini" id="padre_trabaja">
                                    <option value='si'<?php echo repoblar_select('padre_trabaja', 'si', $tmp); ?>>Si</option>
                                    <option value='no'<?php echo repoblar_select('padre_trabaja', 'no', $tmp); ?>>No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_empresa">Nombre de la Empresa:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_empresa','empresa_dtrabajo_padre',$info);?>'name="padre_empresa" class="input-large" id="padre_empresa" type="text" placeholder="Empresa">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_puesto">Puesto:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_puesto','puesto_dtrabajo_padre',$info);?>'name="padre_puesto" class="input-medium" id="padre_puesto" type="text" placeholder="Puesto">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_trdom">Domicilio:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_trdom','dom_dtrabajo_padre',$info);?>'name="padre_trdom" class="input-large" id="padre_trdom" type="text" placeholder="Domicilio">

                            </div>
                        </div>

                        <!-- Prepended text-->
                        <div class="control-group">
                            <label class="control-label" for="padre_ingreso">Ingreso Mensual Bruto</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input value='<?php echo repoblar_texto('padre_ingreso','ingreso_m_padre',$info);?>' name="padre_ingreso" class="input-small money" id="padre_ingreso" type="text" placeholder="0.00">
                                </div>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_verificacion">Verificación empleo, Informante:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('pade_verificacion','informante_padre',$info);?>'name="padre_verificacion" class="input-large" id="padre_verificacion" type="text" placeholder="">

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span6">

                    <fieldset>



                        <!-- Select Basic -->
                        <div class="control-group">
                            <label class="control-label" for="padre_tipoempresa">Empresa</label>
                            <div class="controls">
                                <?php $tmp=(isset($info['tipo_emp_padre'])) ? $info['tipo_emp_padre'] : '';?>
                                <select name="padre_tipoempresa" class="input-small" id="padre_tipoempresa">
                                    <option value='publica' <?php echo repoblar_select('padre_tipoempresa', 'publica', $tmp); ?>>Pública</option>
                                    <option value ='privada' <?php echo repoblar_select('padre_tipoempresa', 'privada', $tmp); ?>>Privada</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_nivel">Nivel:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_nivel','nivel_emp_padre',$info);?>'name="padre_nivel" class="input-medium" id="padre_nivel" type="text" placeholder="Nivel">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_trarraigo">Arraigo:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_trarraigo','arraigo_emp_padre',$info);?>'name="padre_trarraigo" class="input-medium" id="padre_trarraigo" type="text" placeholder="Arraigo">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="padre_trtelefono">Teléfono:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('padre_trtelefono','tel_emp_padre',$info);?>'name="padre_trtelefono" class="input-medium" id="padre_trtelefono" type="text" placeholder="Teléfono">
                            </div>
                        </div>

                    </fieldset>




                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <fieldset>

                <!-- Form Name -->
                <legend>DATOS DE LA MADRE</legend>

                <!-- Text input-->
                <div class="control-group">
                    
                    <?php $tmp = (isset($info['madre_oficial'])) ? $info['madre_oficial'] : ''; ?>
                    <select name='madre_oficial'>
                        <option value=''>Seleccione una opción</option>
                        <option value="ife" <?php echo repoblar_select('madre_oficial', 'ife', $tmp); ?> >Credencial para Votar</option>
                        <option value="pasaporte" <?php echo repoblar_select('madre_oficial', 'pasaporte', $tmp); ?> >Pasaporte Mexicano</option>
                        <option value="cartilla" <?php echo repoblar_select('madre_oficial', 'cartilla', $tmp); ?> >Cartilla del Servicio Militar</option>
                        <option value="cedula" <?php echo repoblar_select('madre_oficial', 'cedula', $tmp); ?> >Cédula Profesional</option>
                    </select>
                    &nbsp;
                    <em>Número:</em>
                    <input value='<?php echo repoblar_texto('madre_idemti','identificacion_madre',$info);?>'name="madre_identi" class="input-small" id="madre_identi" type="text" placeholder="Identificación" />
                    
                </div>

            </fieldset>


            <legend>GENERALES</legend>
            <div class="row-fluid">
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_nom">NOMBRE:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_nom','nombre_madre',$info);?>'name="madre_nom" class="input-large" id="madre_nom" type="text" placeholder="Nombre del padre">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_civil">ESTADO CIVIL:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_civil','estado_madre',$info);?>' name="madre_civil" class="input-medium" id="madre_civil" type="text" placeholder="Estado Civil">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_regimen">RÉGIMEN:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_regimen','regimen_madre',$info);?>'name="madre_regimen" class="input-medium" id="madre_regimen" type="text" placeholder="Régimen">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_dependientes">DEPENDIENTES</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_dependientes','dependientes_madre',$info);?>'name="madre_dependientes" class="input-medium" id="madre_dependientes" type="text" placeholder="Dependientes">

                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_fecha">FECHA DE NACIMIENTO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_fecha','fecha_nacimiento_madre',$info);?>' name="madre_fecha" class="input-small" id="madre_fecha" type="text" placeholder="dd-mm-aaaa">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_nacimiento">LUGAR DE NACIMIENTO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_nacimiento','lugar_nacimiento_madre',$info);?>' name="madre_nacimiento" class="input-medium" id="madre_nacimiento" type="text" placeholder="Lugar de nacimiento">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_rfc">R.F.C.:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_rfc','rfc_madre',$info);?>' name="madre_rfc" class="input-medium" id="madre_rfc" type="text" placeholder="R.F.C.">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_edad">EDAD:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_edad','edad_madre',$info);?>'name="madre_edad" class="input-mini" id="madre_edad" type="text" placeholder="00">

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
                            <label class="control-label" for="madre_calle">CALLE Y NÚMERO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_calle','calle_num_madre',$info);?>' name="madre_calle" class="input-large" id="madre_calle" type="text" placeholder="Calle y número">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_localidad">LOCALIDAD:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_localidad','localidad_madre',$info);?>'name="madre_localidad" class="input-medium" id="madre_localidad" type="text" placeholder="Localidad">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_tel">TELÉFONO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_tel','tel_madre',$info);?>'name="madre_tel" class="input-medium" id="madre_tel" type="text" placeholder="Teléfono">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_mail">E-MAIL:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_mail','email_madre',$info);?>' name="madre_mail" class="input-medium" id="madre_mail" type="text" placeholder="E-Mail">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_correspondencia">Domicilio en el que se enviará la correspondencia:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_carrespondencia','arraigo_emp_madre',$info);?>' name="madre_correspondencia" class="input-medium" id="madre_correspondencia" type="text" placeholder="">

                            </div>
                        </div>

                    </fieldset>





                </div>
                <div class="span6">

                    <fieldset>


                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_colonia">COLONIA:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_colonia','colonia_madre',$info);?>' name="madre_colonia" class="input-small" id="madre_fcolonia" type="text" placeholder="Colonia">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_calles">ENTRE LAS CALLES:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_calles','entre_calles_madre',$info);?>' name="madre_calles" class="input-medium" id="madre_calles" type="text" placeholder="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_cel">CELULAR:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_cel','celular_madre',$info);?>' name="madre_cel" class="input-medium" id="madre_cel" type="text" placeholder="Celular">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_arraigo">ARRAIGO:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_arraigo','arraigo_madre',$info);?>'name="madre_arraigo" class="input-medium" id="madre_arraigo" type="text" placeholder="Arraigo">

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
                            <label class="control-label" for="madre_trabaja">Trabaja el Padre:</label>
                            <div class="controls">
                                <?php $tmp=isset($info['trabaja_act_madre']) ? $info['trabaja_act_madre'] : '';?>
                                <select name="madre_trabaja" class="input-mini" id="madre_trabaja">
                                    <option value='si'<?php echo repoblar_select('madre_trabaja', 'si', $tmp); ?>>Si</option>
                                    <option value='no'<?php echo repoblar_select('madre_trabaja', 'no', $tmp); ?>>No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_empresa">Nombre de la Empresa:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_empresa','empresa_dtrabajo_madre',$info);?>' name="madre_empresa" class="input-large" id="madre_empresa" type="text" placeholder="Empresa">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_puesto">Puesto:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_puesto','puesto_dtrabajo_madre',$info);?>'name="madre_puesto" class="input-medium" id="madre_puesto" type="text" placeholder="Puesto">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_trdom">Domicilio:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_trdom','dom_dtrabajo_madre',$info);?>'name="madre_trdom" class="input-large" id="madre_trdom" type="text" placeholder="Domicilio">

                            </div>
                        </div>

                        <!-- Prepended text-->
                        <div class="control-group">
                            <label class="control-label" for="madre_ingreso">Ingreso Mensual Bruto</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">$</span>
                                    <input value='<?php echo repoblar_texto('madre_ingreso','ingreso_m_madre',$info);?>' name="madre_ingreso" class="input-small money" id="madre_ingreso" type="text" placeholder="0.00">
                                </div>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_verificacion">Verificación empleo, Informante:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_verificaion','informante_madre',$info);?>' name="madre_verificacion" class="input-large" id="madre_verificacion" type="text" placeholder="">

                            </div>
                        </div>

                    </fieldset>



                </div>
                <div class="span6">

                    <fieldset>



                        <!-- Select Basic -->
                        <div class="control-group">
                            <label class="control-label" for="madre_tipoempresa">Empresa</label>
                            <div class="controls">
                                <?php $tmp='';?>
                                <select name="madre_tipoempresa" class="input-small" id="madre_tipoempresa">
                                    <option value='publica'<?php echo repoblar_select('madre_tipoempresa', 'publica', $tmp); ?>>Pública</option>
                                    <option value='privada'<?php echo repoblar_select('madre_tipoempresa', 'privada', $tmp); ?>>Privada</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_nivel">Nivel:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_nivel','nivel_emp_madre',$info);?>'name="madre_nivel" class="input-medium" id="madre_nivel" type="text" placeholder="Nivel">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_trarraigo">Arraigo:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_trarraigo','arraigo-emp_madre',$info);?>'name="madre_trarraigo" class="input-medium" id="madre_trarraigo" type="text" placeholder="Arraigo">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label" for="madre_trtelefono">Teléfono:</label>
                            <div class="controls">
                                <input value='<?php echo repoblar_texto('madre_trtelefono','tel_emp_madre',$info);?>'name="madre_trtelefono" class="input-medium" id="madre_trtelefono" type="text" placeholder="Teléfono">

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