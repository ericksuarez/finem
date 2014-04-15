<?php $this->load->view('common/header'); ?>

<div id="contenido" >
    <?php $this->load->view('investigacion/general'); ?>
    <div class="row-fluid">
        <div id="print-zone">
        <?php echo ($expediente['investigado'] == 'NO') ? form_open(current_url(), array('class' => 'form-horizontal')) : ''; ?>
        <div class="span12">
             


            <div class="row-fluid">
                <div class="span12">
                    <legend> DATOS DEL SOLICITANTE</legend>
                    <div class="row-fluid">
                        <div class="span6">

                            <fieldset>

                                <br>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="nom_solicitante">Nombre solicitante:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('nom_solicitante','nombre',$info);?>' name="nom_solicitante" class="input-large" id="nom_solicitante" type="text" placeholder="Nombre....">

                                    </div>
                                </div>
                                <!-- Multiple Radios (inline) -->
                                <div class="control-group">
                                    <label class="control-label" for="sxo">SEXO:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['sexo'])) ? $info['sexo'] : '';?>
                                        <select name="sxo" class="input-large" id="sxo">
                                            <option value='m'<?php echo repoblar_select('sxo', 'm', $tmp); ?> >M</option>
                                            <option value='f'<?php echo repoblar_select('sxo', 'f', $tmp); ?>>F</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="edo_civil">ESTADO CIVIL:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('civil','edo_civil',$info);?>' name="edo_civil" class="input-large" id="edo_civil" type="text" placeholder="civil">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="regimen">RÉGIMEN</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('regimen','regimen',$info);?>'name="regimen" class="input-large" id="regimen" type="text" placeholder="régimen">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="num_hermanos">NÚMERO DE HERMANOS:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('num_hermanos','num_hermanos',$info);?>'name="num_hermanos" class="input-large" id="num_hermanos" type="text" placeholder="00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="nom_conyuge">NOMBRE DEL CÓNYUGE</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('nom_conyuge','nombre_conyugue',$info);?>'name="nom_conyuge" class="input-large" id="nom_conyuge" type="text" placeholder="cónyuge">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="edad">EDAD</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('edad','edad',$info);?>' name="edad" class="input-large" id="edad" type="text" placeholder="00">

                                    </div>
                                </div>

                            </fieldset>



                        </div>

                        <div class="span6">

                            <fieldset>


                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="fecha_1">FECHA DE ELABORACIÓN DEL SOCIOECONÓMICO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('fecha_1','fecha_socioeconomico',$info);?>'name="fecha_1" class="input-large" id="fecha_1" type="text" placeholder="dd-mm-aaaa">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="lugar_finan">LUGAR DE FINANCIAMIENTO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('lugar_finan','lugar_finan',$info);?>'name="lugar_finan" class="input-large" id="lugar_finan" type="text" placeholder="lugar">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="rfc">R.F.C.:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('rfc','rfc',$info);?>' name="rfc" class="input-large" id="rfc" type="text" placeholder="R.F.C.">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="edad2">EDAD:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('edad2','edad2',$info);?>'name="edad2" class="input-large" id="edad2" type="text" placeholder="00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="dependientes">DEPENDIENTES</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('dependientes','dependientes',$info);?>' name="dependientes" class="input-large" id="dependientes" type="text" placeholder="00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="edades">EDADES:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('edades','edad_hermano',$info);?>'name="edades" class="input-large" id="edades" type="text" placeholder="00,00,00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="fecha2">FECHA DE NACIMIENTO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('fecha2','fecha_nac',$info);?>'name="fecha2" class="input-large" id="fecha2" type="text" placeholder="dd-mm-aaaa">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="lugar_nacimiento">LUGAR DE NACIMIENTO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('lugar_nacimineto','lugar_nac',$info);?>'name="lugar_nacimiento" class="input-large" id="lugar_nacimiento" type="text" placeholder="Lugar">

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


                        <!-- Select Basic -->
                        <div class="control-group">
                            <label for="situacionpadres" ><legend>SITUACIÓN DE LOS PADRES</legend></label>
                            <div class="controls">
                                <?php $tmp= (isset($info['situacion_padres'])) ? $info['situacion_padres'] : '';?>
                                <select name="situacionpadres" class="input-large" id="situacionpadres">
                                    <option value='unidos'<?php echo repoblar_select('situacionpadres', 'unidos', $tmp); ?>>Unidos</option>
                                    <option value='separados'<?php echo repoblar_select('situacionpadres', 'separados', $tmp); ?>>Separados</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>


                    <div class="row-fluid">
                        <div class="span6">

                            <fieldset>

                                <!-- Form Name -->
                                <legend>Padre</legend>



                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="padre_vive">VIVE:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['vive_padre'])) ? $info['vive_padre'] : '';?>
                                        <select name="padre_vive" class="input-large" id="padre_vive">
                                            <option value='si' <?php echo repoblar_select('trabajo_conyugue', 'si', $tmp); ?>>Si</option>
                                            <option value='no' <?php echo repoblar_select('trabajo_conyugue', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="padre_trabaja">TRABAJA:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['trabaja_padre'])) ? $info['trabaja_padre'] : '';?>
                                        <select name="padre_trabaja" class="input-large" id="padre_trabaja">
                                            <option value='si' <?php echo repoblar_select('padre_trabaja', 'si', $tmp); ?>>Si</option>
                                            <option value='no' <?php echo repoblar_select('padre_trabaja', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="padre_actividad">ACTIVIDAD PRINCIPAL:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('padre_actividad','actividad_padre',$info);?>'name="padre_actividad" class="input-large" id="padre_actividad" type="text" placeholder="Actividad">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="padre_estudios">GRADO DE ESTUDIOS:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('padre_estudius','gradoes_padre',$info);?>'name="padre_estudios" class="input-large" id="padre_estudios" type="text" placeholder="Estudios">

                                    </div>
                                </div>

                            </fieldset>


                        </div>

                        <div class="span6">

                            <fieldset>
                                <legend>Madre</legend>
                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="madre_vive">VIVE:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['vive_madre'])) ? $info['vive_madre'] : '';?>
                                        <select name="madre_vive" class="input-large" id="madre_vive">
                                            <option value='si'<?php echo repoblar_select('madre_vive', 'si', $tmp); ?>>Si</option>
                                            <option value='no' <?php echo repoblar_select('madre_vive', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="madre_trabaja">TRABAJA:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['trabaja_madre'])) ? $info['trabaja_madre'] : '';?>
                                        <select name="madre_trabaja" class="input-large" id="madre_trabaja">
                                            <option value='si'<?php echo repoblar_select('madre_trabaja', 'si', $tmp); ?>>Si</option>
                                            <option value='no'<?php echo repoblar_select('madre_trabaja', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="madre_actividad">ACTIVIDAD PRINCIPAL:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('madre_actividad','actividad_madre',$info);?>'name="madre_actividad" class="input-large" id="madre_actividad" type="text" placeholder="Actividad">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="madre_estudios">GRADO DE ESTUDIOS:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('madre_estudios','grado_madre',$info);?>'name="madre_estudios" class="input-large" id="madre_estudios" type="text" placeholder="Estudios">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row-fluid">
                <div class="span12">
                    <legend>Domicilio:</legend>
                    <div class="row-fluid">
                        <div class="span6">

                            <fieldset>


                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="calle">CALLE Y NÚMERO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('calle','calle',$info);?>' name="calle" class="input-large" id="calle" type="text" placeholder="Calle y número">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="localidad">LOCALIDAD:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('localidad','localidad',$info);?>'name="localidad" class="input-large" id="localidad" type="text" placeholder="Localidad">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="tel">TELÉFONO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('tel','telefono',$info);?>'name="tel" class="input-large" id="tel" type="text" placeholder="teléfono">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="mail">E-MAIL:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('mail','email',$info);?>'name="mail" class="input-large" id="mail" type="text" placeholder="tucorreo@correo.com">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="domicilio_correspondencia">Domicilio  en el que se enviará correspondencia</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('domocilio_correspondencia','domicilio_correspondencia',$info);?>'name="domicilio_correspondencia" class="input-medium" id="domicilio_correspondencia" type="text" placeholder="domicilio">

                                    </div>
                                </div>

                            </fieldset>



                        </div>


                        <div class="span6">

                            <fieldset>


                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="colonia">COLONIA:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('colonia','colonia',$info);?>'name="colonia" class="input-large" id="colonia" type="text" placeholder="Colonia">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="calles">ENTRE LAS CALLES:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('calles','entre_calles',$info);?>'name="calles" class="input-large" id="calles" type="text" placeholder="Calles">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="cel">CELULAR:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('cel','celular',$info);?>'name="cel" class="input-large" id="cel" type="text" placeholder="044-55">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="arraigo">ARRAIGO:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('arraigo','arraigo',$info);?>' name="arraigo" class="input-large" id="arraigo" type="text" placeholder="Arraigo">

                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="control-group">
                                    <label class="control-label" for="problemas_acceso">Problemas acceso o vigilancia:</label>
                                    <div class="controls">                     
                                        <textarea name="problemas_acceso" id="problemas_acceso" placeholder='Problemas....'><?php echo repoblar_texto('problemas_acceso','prob_acceso_vigencia',$info)?></textarea>
                                    </div>
                                </div>

                            </fieldset>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">

                    <div class="control-group">
                        <label class="control-label" for="nivel">Nivel:</label>
                        <div class="controls">
                            <?php $tmp= (isset($info['niv_estudio'])) ? $info['niv_estudio'] : '';?>
                            <select name="nivel" class="input-large" id="nivel">
                                <option value='primaria' <?php echo repoblar_select('nivel', 'primaria', $tmp); ?>>PRIMARIA</option>
                                <option value='secundaria'<?php echo repoblar_select('nivel', 'secundaria', $tmp); ?>>SECUNDARIA</option>
                                <option value='preparatoria'<?php echo repoblar_select('nivel','preparatoria', $tmp); ?>>PREPARATORIA</option>
                                <option value='licenciatura'<?php echo repoblar_select('nivel', 'licenciatura', $tmp); ?>>LICENCIATURA</option>
                                <option value='posgrado' <?php echo repoblar_select('nivel', 'posgrado', $tmp); ?>>POSGRADO</option>
                                <option value='otro' <?php echo repoblar_select('nivel', 'otro', $tmp); ?>>OTRO</option>
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="datos_otros">Otro describir</label>
                        <div class="controls">
                            <input value='<?php echo repoblar_texto('datos_otro','estudio_otro',$info);?>' name="datos_otros" class="input-large" id="dtos_otro" type="text" placeholder="otro">

                        </div>
                    </div>

                    </fieldset>



                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <legend>III. TRABAJO</legend>
                    <div class="row-fluid">
                        <div class="span6">

                            <fieldset>

                                <!-- Form Name -->


                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo">¿Trabajas Actualmente?:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['trabaja_act'])) ? $info['trabaja_act'] : '';?>
                                        <select name="trabajo" class="input-large" id="trabajo">
                                            <option value="si"<?php echo repoblar_select('trabajo', 'si', $tmp); ?>>Si</option>
                                            <option value="no"<?php echo repoblar_select('trabajo', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_nombre">Nombre de la Empresa:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_nombre','empresa_dtrabajo',$info);?>' name="trabajo_nombre" class="input-large" id="trabajo_nombre" type="text" placeholder="Empresa">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_puesto">Puesto:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_puesto','puesto_dtrabajo',$info);?>'name="trabajo_puesto" class="input-large" id="trabajo_puesto" type="text" placeholder="Puesto">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_domicilio">Domicilio Completo:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_domicilio','dom_dtrabajo',$info);?>'name="trabajo_domicilio" class="input-large" id="trabajo_domicilio" type="text" placeholder="Domicilio trabajo">

                                    </div>
                                </div>

                                <!-- Prepended text-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_ingreso">Ingreso Mensual:</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">$</span>
                                            <input value='<?php echo repoblar_texto('trabajo_ingreso','ingreso_m',$info);?>'name="trabajo_ingreso" class="input-large money" id="trabajo_ingreso" type="text" placeholder="000.00">
                                        </div>

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_informante">Informante:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_informante','informante',$info);?>'name="trabajo_informante" class="input-large" id="trabajo_informante" type="text" placeholder="Informante">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_departamento">Departamento:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_departamento','puesto_trabajodep',$info);?>' name="trabajo_departamento" class="input-large" id="trabajo_departamento" type="text" placeholder="Departamento">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_piso">Piso:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_piso','piso',$info);?>'name="trabajo_piso" class="input-large" id="trabajo_piso" type="text" placeholder="Piso">

                                    </div>
                                </div>

                            </fieldset>



                        </div>

                        <div class="span6">

                            <fieldset>


                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_conyuge">¿Trabaja tu Cónyuge?:</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['con_trabajo'])) ? $info['con_trabajo'] : '';?>
                                        <select name="trabajo_conyuge" class="input-large" id="trabajo_conyuge">
                                            <option value="si" <?php echo repoblar_select('trabajo_conyugue', 'si', $tmp); ?>>Si</option>
                                            <option value="no" <?php echo repoblar_select('trabajo_conyugue', 'no', $tmp); ?>>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_giro">Empresa</label>
                                    <div class="controls">
                                        <?php $tmp= (isset($info['tipo_emp'])) ? $info['tipo_emp'] : '';?>
                                        <select name="trabajo_giro" class="input-large" id="trabajo_giro">
                                            <option value="publica" <?php echo repoblar_select('trabajo_giro', 'publica', $tmp); ?>>Publica</option>
                                            <option value="privado" <?php echo repoblar_select('trabajo_giro', 'privado', $tmp);?>>Privada</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_nivel">Nivel:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_nivel','nivel_emp',$info);?>'name="trabajo_nivel" class="input-large" id="trabajo_nivel" type="text" placeholder="nivel">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_Arraigo">Arraigo:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_Arraigo','arraigo_emp',$info);?>'name="trabajo_Arraigo" class="input-large" id="trabajo_Arraigo" type="text" placeholder="Arraigo">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_telefono">Teléfono:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_telefono','tel_emp',$info);?>' name="trabajo_telefono" class="input-large" id="trabajo_telefono" type="text" placeholder="Teléfono">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_ext">Ext:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_ext','ext_emp',$info);?>' name="trabajo_ext" class="input-large" id="trabajo_ext" type="text" placeholder="Extensión">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_puesto2">Puesto específico:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_puesto2','puest_con',$info);?>'name="trabajo_puesto2" class="input-large" id="trabajo_puesto2" type="text" placeholder="Puesto específico">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="control-label" for="trabajo_area">Área:</label>
                                    <div class="controls">
                                        <input value='<?php echo repoblar_texto('trabajo_area','area_con',$info);?>' name="trabajo_area" class="input-large" id="trabajo_area" type="text" placeholder="Área">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <legend>REFERENCIAS PERSONALES</legend>
                    <div class="row-fluid">
                        <div class="span4">

                            <fieldset>

                                <!-- Form Name -->
                                <legend style="font-size:12px">NOMBRE</legend>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_nom1"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_nom1','nomb_refp',$info);?>'name="referencia_nom1" class="input-large" id="referencia_nom1" type="text" placeholder="Referencia 1">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_nom2"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_nom2','nomb_refp2',$info);?>'name="referencia_nom2" class="input-large" id="referencia_nom2" type="text" placeholder="Referencia 2">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_nom3"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_nom3','nomb_refp3',$info);?>'name="referencia_nom3" class="input-large" id="referencia_nom3" type="text" placeholder="Referencia 3">

                                    </div>
                                </div>

                            </fieldset>



                        </div>
                        <div class="span2">

                            <fieldset>

                                <!-- Form Name -->
                                <legend style="font-size:12px">TELÉFONO</legend>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_tel1"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_tel1','tel_refp',$info);?>'name="referencia_tel1" class="input-small" id="referencia_tel1" type="text" placeholder="Teléfono">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_tel2"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_tel2','tel_refp2',$info);?>' name="referencia_tel2" class="input-small" id="referencia_tel2" type="text" placeholder="Teléfono">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_tel3"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_tel3','tel_refp3',$info);?>'name="referencia_tel3" class="input-small" id="referencia_tel3" type="text" placeholder="Teléfono">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                        <div class="span2">

                            <fieldset>

                                <!-- Form Name -->
                                <legend style="font-size:12px">RELACIÓN</legend>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rel1"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referemcia_rel1','rel_refp',$info);?>'name="referencia_rel1" class="input-large" id="referencia_rel1" type="text" placeholder="Relación">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rel2"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_rel2','rel_refp2',$info);?>'name="referencia_rel2" class="input-large" id="referencia_rel2" type="text" placeholder="Relación">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rel3"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_rel3','rel_refp3',$info);?>'name="referencia_rel3" class="input-large" id="referencia_rel3" type="text" placeholder="Relación">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                        <div class="span2">

                            <fieldset>

                                <!-- Form Name -->
                                <legend style="font-size:12px">AÑOS DE CONOCERLO</legend>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_anios1"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_anios1','anio_conoc',$info);?>'name="referencia_anios1" class="input-mini" id="referencia_aÃ±os1" type="text" placeholder="00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_anios2"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_anios2','anio_conoc2',$info);?>'name="referencia_anios2" class="input-mini" id="referencia_aÃ±os2" type="text" placeholder="00">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_anios3"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_anios3','anio_conoc3',$info);?>'name="referencia_anios3" class="input-mini" id="referencia_aÃ±os3" type="text" placeholder="00">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                        <div class="span2">

                            <fieldset>

                                <!-- Form Name -->
                                <legend style="font-size:12px">LO RECOMIENDA</legend>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rec1"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_rec1','recomendacion',$info);?>'name="referencia_rec1" class="input-mini" id="referencia_rec1" type="text" placeholder="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rec2"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_rec2','recomendacion2',$info);?>'name="referencia_rec2" class="input-mini" id="referencia_rec2" type="text" placeholder="">

                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="control-group">
                                    <label class="" for="referencia_rec3"></label>
                                    <div class="">
                                        <input value='<?php echo repoblar_texto('referencia_rec3','recomendacion3',$info);?>'name="referencia_rec3" class="input-mini" id="referencia_rec3" type="text" placeholder="">

                                    </div>
                                </div>

                            </fieldset>


                        </div>
                    </div>
                </div>
            </div>

            <div style='width:100%;'>
                <center>

                    <fieldset>


                        <!-- Multiple Checkboxes (inline) -->
                        <!--
                        <div class="control-group">
                            <label class="control-label" for="terminado"></label>
                            <div class="controls">
                                <label class="checkbox inline" for="terminado-0">
                                    <input name="terminado" id="terminado-0" type="checkbox" value="Terminado" />
                                    Terminado
                                </label>
                            </div>
                        </div>
                        
                        -->
                        <!-- Textarea -->

                        <label class="control-label" for="comentario"></label>

                        <textarea class='span12' style='height: 200px;' name="comentario" id="comentario" placeholder='Comentarios'><?php echo repoblar_texto('comentario','comentario',$info);?></textarea>
                        

                        

                        

                    </fieldset>

                </center>
            </div>
        </div>
    </div>
    <br />
    <br />
    
    <?php if($expediente['investigado'] == 'NO'){?>
    <div class='pull-right'>
        <input type='submit' value='Guardar' class='btn btn-success' />
    </div>
    <?php
    }?>
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