<?php $this->load->view('common/header'); ?>
<?php $this->load->view('investigacion/general'); ?>
<style>
    .oculto {visibility:hidden;}
    .visible {visibility:visible;}
</style> 
<div class='tabbable tabs-left pull-left affix' style='width:18%'>
    <ul id="myTab" class="nav nav-tabs">
        <?php $pestania = (!empty($_POST['pestania'])) ? $_POST['pestania'] : '';?>
        <li class="<?php echo (empty($pestania)) ? 'active' : (($pestania == 'general-li') ? 'active' : '' );?>"><a data-id='general-li' href="#general">Datos Generales</a></li>
        <li class='<?php echo ($pestania == 'personal-li') ? 'active' : '';?>'><a data-id='personal-li' href="#personal">Datos Personales</a></li>
        <li class='<?php echo ($pestania == 'avales-li') ? 'active' : '';?>'><a data-id='avales-li' href="#avales">Avales</a></li>
        <li class='<?php echo ($pestania == 'comentarios-li') ? 'active' : '';?>'><a data-id='comentarios-li' href="#comentarios">Comentarios</a></li>
    </ul>
</div>

<input type='hidden' name='pestania' id='pestania' value="<?php echo $pestania;?>" />
<input type='hidden' name='idalumno' value="<?php echo $expediente['alumno_idalumno'];?>" />
<div class="tab-content pull-right" style='width:80%;'>
    <div id="general" class="tab-pane <?php echo (empty($pestania)) ? 'active' : (($pestania == 'general-li') ? 'active' : '' );?>">
        <table class="table table-bordered table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Número de matr&iacute;cula</strong></td>
                    <td><?php echo $expediente['matricula'];?></td>
                </tr>
                <tr>
                    <td width="23%"><strong>Universidad</strong></td>
                    <td width="77%">
                        <select id="uni" name="universidad">
                            <option value="0" <?php echo set_select('universidad', ' ', true); ?> >Seleccione una opción</option>
                            <?php foreach ($informacion['universidades'] as $universidad) { 
                                $selected= repoblar_select('universidad',$universidad['mayor']['iduniversidad'],$expediente['universidad_iduniversidad']); ?>         
                                <option value="<?php echo $universidad['mayor']['iduniversidad']; ?>" <?php echo $selected; ?>><?php echo $universidad['mayor']['nombre_comercial']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td width="23%"><strong>Campus</strong></td>
                    <td>
                        <select id='campus' name='cam'>
                            <option value=''>Seleccione un Campus</option>
                            <?php
                            $campi = $informacion['campi'];
                            if(!empty($campi)){
                                foreach($campi as $u){
                                    $selected= repoblar_select('cam',$u['idcampus'],$expediente['campus_idcampus']);
                                    //echo $_POST['cam'];?>
                                <option <?php echo $selected;?> value='<?php echo $u['idcampus'];?>'><?php echo $u['nombre'];?></option>
                                <?php
                                }
                            }
                            ?>
                        </select> 
                    </td>
                </tr>     
                <tr>
                    <td>
                        <label for="carrera">
                            <strong>Carrera</strong>
                        </label>
                    </td>
                    <td id="carreras">
                        <?php
                        //echo $expediente['especialidad'];
                        echo crea_selects($informacion['carreras'], 'especialidad', 
                                (isset($_POST['especialidad']) ? $_POST['especialidad'] : $expediente['especialidad']), 
                                'id="especialidad"', $posCero = '', $valCero = ' Selecciona una carrera'); 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Producto</strong></td>
                    <td>
                        <select name="producto">
                            <option value="0" <?php echo set_select('producto', '0', true); ?> >Seleccione una opción</option>
                            <?php foreach ($informacion['productos'] as $a) { 
                                $selected= repoblar_select('producto',$a['idproducto'],$expediente['producto_idproducto']);?>
                                <option value="<?php echo $a['idproducto']; ?>" <?php echo $selected; ?>><?php echo $a['nombre']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Ciclo</strong></td>
                    <td>
                        <select name="ciclox">
                            <option value="0" <?php echo set_select('ciclox', '0', true); ?> >Seleccione una opción</option>
                            <?php foreach ($informacion['ciclos'] as $a) { 
                                $selected= repoblar_select('ciclox',$a['idciclo'],$expediente['ciclo_idciclo']);?>
                                <option value="<?php echo $a['idciclo']; ?>" <?php echo $selected; ?>><?php echo $a['ciclo']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Nivel</strong></td>
                    <td>
                        <Select name="nivel">
                            <option value="0" <?php echo set_select('nivel', '0'); ?> >Seleccione una opción</option>
                            <option value="lic" <?php echo repoblar_select('nivel','lic',$expediente['nivel']); ?> > Licenciatura</option>
                            <option value="especialidad" <?php echo repoblar_select('nivel','especialidad',$expediente['nivel']); ?> > Especialidad</option>
                            <option value="maestria" <?php echo repoblar_select('nivel','maestria',$expediente['nivel']); ?> > Maestría</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Ciclo en el que inicia</strong></td>
                    <td>
                        <Select name="ciclo_escolar">
                            <option value="0" <?php echo set_select('ciclo_escolar', '0', true); ?> >Seleccione una opción</option>
                            <?php for ($i = 1; $i < 13; $i++) { 
                                $selected= repoblar_select('ciclo_escolar',$i,$expediente['ciclo_escolar']);?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Porcentaje de Avance</strong></td>
                    <td>
                        <div class="input-append">

                            
                            <input type='text' name='avance_por' value='<?php echo repoblar_texto('avance_por', 'avance_por', $expediente);?>' class='input-mini' />
                            <span class="add-on">%</span>


                        </div>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="personal" class="tab-pane <?php echo ($pestania == 'personal-li') ? 'active' : '';?>">
        <table class="table table-bordered table-striped">
            <thead></thead>
            <tbody>
                <tr>
                    <td><strong>Identificación Oficial</strong></td>
                    <td>
                        <?php
                        $tmp = (isset($informacion['alumno']['oficial'])) ? $informacion['alumno']['oficial'] : '';?>
                        <select name='oficial'>
                            <option value=''>Seleccione una opción</option>
                            <option value="ife" <?php echo repoblar_select('oficial','ife',$tmp); ?> >Credencial para Votar</option>
                            <option value="pasaporte" <?php echo repoblar_select('oficial','pasaporte',$tmp); ?> >Pasaporte Mexicano</option>
                            <option value="cartilla" <?php echo repoblar_select('oficial','cartilla',$tmp); ?> >Cartilla del Servicio Militar</option>
                            <option value="cedula" <?php echo repoblar_select('oficial','cedula',$tmp); ?> >Cédula Profesional</option>
                        </select>
                        &nbsp;
                        <em>Número:</em>
                        <input type='text' name='numero_oficial' value='<?php echo repoblar_texto('numero_oficial','numero_oficial',$informacion['alumno']);?>' />
                    </td>
                </tr>
                <tr>
                    <td width="24%"><strong>Nombre</strong></td>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                            <tr>
                                <td><input type="text" name="nombre1" class="span2" value="<?php echo repoblar_texto('nombre1','nombre',$informacion['alumno']); ?>"/></td>
                                <td><input type="text" name="nombre2" class="span2" value="<?php echo repoblar_texto('nombre2','nombre_dos',$informacion['alumno']) ?>" /></td>
                                <td><input type="text" name="apater" class="span2" value="<?php echo repoblar_texto('apater','apater',$informacion['alumno']); ?>" /></td>
                                <td><input type="text" name="amater" class="span2" value="<?php echo repoblar_texto('amater','amater',$informacion['alumno']); ?>" /></td>
                            </tr>
                            <tr>
                                <td><span class="label label-info">Nombre (1)</span></td>
                                <td><span class="label label-info">Nombre (2)</span></td>
                                <td><span class="label label-info">Apellido paterno</span></td>
                                <td><span class="label label-info">Apellido materno</span></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td><strong>Fecha de nacimiento</strong></td>
                    <td><input type="text" name="nac" value="<?php echo (repoblar_texto('nac','nacimiento',$informacion['alumno'])); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Lugar de nacimiento</strong></td>
                    <td><input type="text" name="nac_place" value="<?php echo repoblar_texto('nac_place','lugar_nac',$informacion['alumno']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>RFC</strong></td>
                    <td><input type="text" name="rfc" value="<?php echo repoblar_texto('rfc','rfc',$informacion['alumno']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Estado civil</strong></td>
                    <td>
                        <?php
                        $tmp = (isset($informacion['alumno']['estado_civil'])) ? $informacion['alumno']['estado_civil'] : '';?>
                        <select name="civil" >
                            <option value="0" <?php echo set_select('civil', '0', true); ?> >Seleccione una opción</option>
                            <option value="soltero" <?php echo repoblar_select('civil','soltero',$tmp); ?>>Soltero</option>
                            <option value="casado" <?php echo repoblar_select('civil','casado',$tmp); ?>>Casado</option>
                            <option value="divorciado" <?php echo repoblar_select('civil','divorciado',$tmp); ?>>Divorciado</option>
                            <option value="libre" <?php echo repoblar_select('civil','libre',$tmp); ?>>Unión Libre</option>
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td><strong>Nombre Conyuge</strong></td>
                    <td><input type='text' name='conyuge' value='<?php echo repoblar_texto('conyuge','nombre_conyuge',$informacion['alumno']);?>'</td>
                </tr>
                
                <tr>
                    <td><strong>Promedio general</strong></td>
                    <td><input type="text" name="promedio" value="<?php echo repoblar_texto('promedio','promedio',$informacion['alumno']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Correo electr&oacute;nico</strong></td>
                    <td><input type="text" name="email" value="<?php echo repoblar_texto('email','email',$informacion['alumno']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Celular</strong></td>
                    <td><input type="text" name="cellphone" value="<?php echo repoblar_texto('cellphone','celular',$informacion['alumno']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Tel&eacute;fono fijo</strong></td>
                    <td><input type="text" name="phone" value="<?php echo repoblar_texto('phone','telefono',$informacion['adom']); ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Direcci&oacute;n</strong></td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                            <tr>
                                <td><input type="text" name="postal" class="span2" value="<?php echo repoblar_texto('postal','codigo_postal',$informacion['adom']); ?>" /></td>
                                <td><input type="text" name="colonia" class="span2" value="<?php echo repoblar_texto('colonia','colonia',$informacion['adom']); ?>" /></td>
                                <td><input type="text" name="delegacion" class="span2" value="<?php echo repoblar_texto('delegacion','delegacion',$informacion['adom']); ?>" /></td>
                                <td><input type="text" name="ciudad" class="span2" value="<?php echo repoblar_texto('ciudad','ciudad',$informacion['adom']); ?>" /></td>
                            </tr>
                            <tr>
                                <td><span class="label label-info">Código Postal</span></td>
                                <td><span class="label label-info">Colonia  </span></td>
                                <td><span class="label label-info">Delegaci&oacute;n / Municipio</span></td>
                                <td><span class="label label-info">Ciudad /Localidad</span></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="estado" class="span2" value="<?php echo repoblar_texto('estado','estado',$informacion['adom']); ?>" /></td>
                                <td><input type="text" name="calle" class="span2" value="<?php echo repoblar_texto('calle','calle',$informacion['adom']); ?>" /></td>
                                
                                <td><input type="text" name="exterior" class="span2" value="<?php echo repoblar_texto('exterior','exterior',$informacion['adom']); ?>" /></td>
                                <td><input type="text" name="interior" class="span2" value="<?php echo repoblar_texto('interior','interior',$informacion['adom']); ?>" /></td>
                            </tr>
                            <tr>
                                <td><span class="label label-info">Estado </span></td>
                                <td><span class="label label-info">Calle </span></td>
                                <td><span class="label label-info">No. Exterior </span></td>
                                
                                <td><span class="label label-info">No. Interior </span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><strong>La casa donde habita es</strong></td>
                    <td>
                        <?php
                        $tmp =  (isset($informacion['adom']['casa'])) ? $informacion['adom']['casa'] : '';?>
                        <select name="casa" >
                            <option value="0" <?php echo set_select('casa', '0', true); ?>>Seleccione una opción</option>
                            <option value="propia" <?php echo repoblar_select('casa', 'propia',$tmp); ?>>Propia</option>
                            <option value="rentada" <?php echo repoblar_select('casa', 'rentada',$tmp); ?>>Rentada</option>
                            <option value="prestada" <?php echo repoblar_select('casa', 'prestada',$tmp); ?>>Prestada</option>
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>Actividad laboral</strong></p>
                        <p>&iquest;El alumno trabaja? </p>
                        <?php
                        $tiene_trabajo = (isset($informacion['alumno']['tiene_trabajo'])) ? $informacion['alumno']['tiene_trabajo'] : '';?>
                        <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                            <tr>
                                <td>
                                    <input type="radio" name="trabajox" value="SI" onClick="javascript:unhide('datos_laborales');" <?php echo repoblar_radio('trabajox', 'SI',$tiene_trabajo); ?>/>                    
                                    S&iacute;</td>
                                <td>
                                    <input type="radio" name="trabajox" value="NO" onClick="javascript:hide('datos_laborales');" <?php echo repoblar_radio('trabajox', 'NO',$tiene_trabajo); ?> />
                                    No</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <?php $oculto = repoblar_radio('trabajox', 'SI',$tiene_trabajo); ?>
                        <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered <?php echo !empty($oculto) ? 'visible' : 'oculto'; ?>" id="datos_laborales">
                            <tr>
                                <td width="34%">Actividad</td>
                                <td>
                                    <?php
                                    $actividad = (isset($informacion['awork']['actividad'])) ? $informacion['awork']['actividad'] : '';?>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                        <tr>
                                            <td width="50%">
                                                <input type="radio" name="actividad_alumno" value="formal" <?php echo repoblar_radio('actividad_alumno', 'formal',$actividad); ?> />
                                                Formal</td>
                                            <td><input type="radio" name="actividad_alumno" value="informal" <?php echo repoblar_radio('actividad_alumno', 'informal',$actividad); ?> />
                                                Informal</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre de la empresa</td>
                                <td><input type="text" name="empresa" value="<?php echo repoblar_texto('empresa','nombre_empresa',$informacion['awork']); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Antig&uuml;edad</td>
                                <td>
                                    <div class="input-append">
                                        <input type="text" name="antiguedad" value="<?php echo repoblar_texto('antiguedad', 'antiguedad', $informacion['awork']); ?>" />
                                        <span class="add-on">año(s)</span>


                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Puesto</td>
                                <td><input type="text" name="puesto" value="<?php echo repoblar_texto('puesto','puesto',$informacion['awork']); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Tel&eacute;fono</td>
                                <td><input type="text" name="telefono_emp" value="<?php echo repoblar_texto('telefono_emp','telefono',$informacion['awork']); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Ingreso mensual</td>
                                <td>
                                    <div class="input-prepend">
                                        
                                        <span class="add-on">$</span>
                                        <input type="text" name="ingreso" value="<?php echo repoblar_texto('ingreso','ingreso_mensual',$informacion['awork']); ?>" class='money' />


                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Egreso mensual</td>
                                <td>
                                    <div class="input-prepend">
                                        
                                        <span class="add-on">$</span>
                                        <input type="text" name="egreso" value="<?php echo repoblar_texto('egreso','egreso_mensual',$informacion['awork']); ?>" class='money' />


                                    </div>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="avales" class="tab-pane <?php echo ($pestania == 'avales-li') ? 'active' : '';?>">
        <?php for ($i = 1; $i < 3; $i++) { ?>
            <div id="aval<?php echo $i; ?>">
                <input type='hidden' name='idaval_a<?php echo $i;?>' value='<?php echo (isset($informacion['aval'.$i]['idaval'])) ? $informacion['aval'.$i]['idaval'] : '';?>' />
                <h3>Aval <?php echo $i; ?></h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Identificación Oficial</strong></td>
                            <td>
                                <?php
                                $tmp = (isset($informacion['aval'.$i]['oficial'])) ? $informacion['aval'.$i]['oficial'] : '';?>
                                <select name='oficiala<?php echo $i; ?>'>
                                    <option value=''>Seleccione una opción</option>
                                    <option value="ife" <?php echo repoblar_select('oficiala'.$i,'ife',$tmp); ?> >Credencial para Votar</option>
                                    <option value="pasaporte" <?php echo repoblar_select('oficiala'.$i,'pasaporte',$tmp); ?> >Pasaporte Mexicano</option>
                                    <option value="cartilla" <?php echo repoblar_select('oficiala'.$i,'cartilla',$tmp); ?> >Cartilla del Servicio Militar</option>
                                    <option value="cedula" <?php echo repoblar_select('oficiala'.$i,'cedula',$tmp); ?> >Cédula Profesional</option>
                                </select>
                                &nbsp;
                                <em>Número:</em>
                                <input type='text' name='numero_oficiala<?php echo $i;?>' value='<?php echo repoblar_texto('numero_oficiala'.$i,'numero_oficial',$informacion['aval'.$i]);?>' />
                            </td>
                        </tr>
                        <tr>
                            <td width="24%"><strong>Nombre</strong></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                    <tr>
                                        <td><input type="text" name="nombre1_a<?php echo $i; ?>" value="<?php echo repoblar_texto('nombre1_a' . $i,'nombre', $informacion['aval'.$i]); ?>" class="span2" /></td>
                                        <td><input type="text" name="nombre2_a<?php echo $i; ?>" value="<?php echo repoblar_texto('nombre2_a' . $i,'nombre_dos',$informacion['aval'.$i]); ?>" class="span2" /></td>
                                        <td><input type="text" name="apater_a<?php echo $i; ?>" value="<?php echo repoblar_texto('apater_a' . $i,'apaterno',$informacion['aval'.$i]); ?>" class="span2" /></td>
                                        <td><input type="text" name="amater_a<?php echo $i; ?>" value="<?php echo repoblar_texto('amater_a' . $i,'amaterno',$informacion['aval'.$i]); ?>" class="span2" /></td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-info">Nombre (1)</span></td>
                                        <td><span class="label label-info">Nombre (2)</span></td>
                                        <td><span class="label label-info">Apellido paterno</span></td>
                                        <td><span class="label label-info">Apellido materno</span></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><strong>Parentesco</strong></td>
                            <td><input type="text" name="parentesco_a<?php echo $i; ?>" value="<?php echo repoblar_texto('parentesco_a' . $i,'parentesco',$informacion['aval'.$i]); ?>" class="" /></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de nacimiento</strong></td>
                            <td><input type="text" name="naca_<?php echo $i;?>"  value="<?php echo (repoblar_texto('naca_'.$i,'nacimiento',$informacion['aval'.$i])); ?>" /></td>
                        </tr>
                        <tr>
                            <td><strong>Lugar de nacimiento</strong></td>
                            <td><input type="text" name="nac_placea_<?php echo $i;?>" value="<?php echo repoblar_texto('nac_placea_'.$i,'lugar_nac',$informacion['aval'.$i]); ?>" /></td>
                        </tr>
                        <tr>
                            <td><strong>Estado civil</strong></td>
                            <td>
                                <?php
                                $civila = (isset($informacion['aval'.$i]['edo_civil'])) ? $informacion['aval'.$i]['edo_civil'] : '';?>
                                
                                <select name="civil_a<?php echo $i; ?>" >
                                    <option value="0" <?php echo set_select('civil_a' . $i, '0', true); ?> >Seleccione una opción</option>
                                    <option value="soltero" <?php echo repoblar_select('civil_a' . $i, 'soltero',$civila); ?> >Soltero</option>
                                    <option value="casado" <?php echo repoblar_select('civil_a' . $i, 'casado',$civila); ?>>Casado</option>
                                    <option value="divorciado" <?php echo repoblar_select('civil_a' . $i, 'divorciado',$civila); ?>>Divorciado</option>
                                    <option value="libre" <?php echo repoblar_select('civil_a' . $i, 'libre',$civila); ?> >Unión Libre</option>
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Nombre Conyuge</strong></td>
                            <td><input type='text' name='conyugea_<?php echo $i;?>' value='<?php echo repoblar_texto('conyugea_'.$i,'nombre_conyuge',$informacion['aval'.$i]);?>'</td>
                        </tr>
                        
                        <tr>
                            <td><strong>Direcci&oacute;n</strong></td>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                    <tr>
                                        <td><input type="text" name="postal_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('postal_a' . $i,'cp',$informacion['aval'.$i]); ?>" /></td>
                                        <td><input type="text" name="colonia_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('colonia_a' . $i,'colonia',$informacion['aval'.$i]); ?>" /></td>
                                        <td><input type="text" name="delegacion_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('delegacion_a' . $i,'delegacion',$informacion['aval'.$i]); ?>" /></td>
                                        <td><input type="text" name="ciudad_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('ciudad_a' . $i,'ciudad',$informacion['aval'.$i]); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-info">Código Postal</span></td>
                                        <td><span class="label label-info">Colonia  </span></td>
                                        <td><span class="label label-info">Delegaci&oacute;n / Municipio</span></td>
                                        <td><span class="label label-info">Ciudad /Localidad</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="estado_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('estado_a' . $i,'estado',$informacion['aval'.$i]); ?>" /></td>
                                        <td><input type="text" name="calle_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('calle_a' . $i,'calle',$informacion['aval'.$i]); ?>" /></td>
                                        <td><input type="text" name="exterior_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('exterior_a' . $i,'exterior',$informacion['aval'.$i]); ?>" /></td>
                                        
                                        <td><input type="text" name="interior_a<?php echo $i; ?>" class="span2" value="<?php echo repoblar_texto('interior_a' . $i,'interior',$informacion['aval'.$i]); ?>" /></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><span class="label label-info">Estado </span></td>
                                        <td><span class="label label-info">Calle </span></td>
                                        <td><span class="label label-info">No. Exterior </span></td>
                                        
                                        <td><span class="label label-info">No. Interior </span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono Fijo</strong></td>
                            <td><input type='text' name='telefono_fijo_a<?php echo $i;?>' value="<?php echo repoblar_texto('telefono_fijo__a' . $i,'telefono',$informacion['aval'.$i]); ?>" /></td>
                        </tr>
                        <tr>
                            <td><strong>La casa donde habita es</strong></td>
                            <td>
                                <?php
                                $casa = (isset($informacion['aval'.$i]['casa_habita'])) ? $informacion['aval'.$i]['casa_habita'] : '';?>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                    <tr>
                                        <td>
                                            <select name="casa_a<?php echo $i; ?>" >
                                                <option value="0" <?php echo set_select('casa_a' . $i, '0', true); ?>>Seleccione una opción</option>
                                                <option value="propia" <?php echo repoblar_select('casa_a' . $i, 'propia',$casa); ?>>Propia</option>
                                                <option value="rentada" <?php echo repoblar_select('casa_a' . $i, 'rentada',$casa); ?> >Rentada</option>
                                                <option value="prestada" <?php echo repoblar_select('casa_a' . $i, 'prestada',$casa); ?> >Prestada</option>
                                            </select>    
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><p><strong>&iquest;Tiene autom&oacute;vil?</strong>                  </p>
                                
                                <?php
                                $automovil = (isset($informacion['aval'.$i]['automovil'])) ? $informacion['aval'.$i]['automovil'] : '';?>
                                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                    <tr>
                                        <td><input type="radio" name="trabajo_a<?php echo $i; ?>" value="SI" onClick="javascript:unhide('automovil_a<?php echo $i; ?>');" <?php echo repoblar_radio('trabajo_a' . $i, 'SI',$automovil); ?> />
                                            S&iacute;</td>
                                        <td><input type="radio" name="trabajo_a<?php echo $i; ?>" value="NO" onClick="javascript:hide('automovil_a<?php echo $i; ?>');" <?php echo repoblar_radio('trabajo_a' . $i, 'NO', $automovil); ?> />
                                            No</td>
                                    </tr>
                                </table></td>
                            <td>
                                <?php $oculto = repoblar_radio('trabajo_a' . $i, 'SI',$automovil); ?>
                                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered <?php echo (!empty($oculto)) ? 'visible' : 'oculto'; ?>" id="automovil_a<?php echo $i; ?>">
                                    <tr>
                                        <td width="20%">Modelo</td>
                                        <td width="80%"><input type="text" name="modelo_a<?php echo $i; ?>" value="<?php echo repoblar_texto('modelo_a' . $i,'modelo',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><p><strong>Actividad laboral del aval</strong>                </p></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered visible">
                                    <tr>
                                        <td width="34%">Actividad</td>
                                        <td>
                                            <?php
                                            $tmp = (isset($informacion['aval'.$i]['actividad_aval'])) ? $informacion['aval'.$i]['actividad_aval'] : '';?>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                                <tr>
                                                    <td width="50%"><input type="radio" name="actividad_a<?php echo $i; ?>" value="formal" <?php echo repoblar_radio('actividad_a' . $i, 'formal',$tmp); ?> />
                                                        Formal</td>
                                                    <td><input type="radio" name="actividad_a<?php echo $i; ?>" value="informal" <?php echo repoblar_radio('actividad_a' . $i, 'informal',$tmp); ?> />
                                                        Informal</td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de la empresa</td>
                                        <td><input type="text" name="empresa_a<?php echo $i; ?>" value="<?php echo repoblar_texto('empresa_a' . $i,'nombre_empresaA',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Antig&uuml;edad</td>
                                        <td>
                                            <div class="input-append">
                                                <input type="text" name="antiguedad_a<?php echo $i; ?>" value="<?php echo repoblar_texto('antiguedad_a' . $i,'antiguedadA',$informacion['aval'.$i]); ?>" class="" />
                                                <span class="add-on">año(s)</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Puesto</td>
                                        <td><input type="text" name="puesto_a<?php echo $i; ?>" value="<?php echo repoblar_texto('puesto_a' . $i,'puestoA',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tel&eacute;fono</td>
                                        <td><input type="text" name="telefono_a<?php echo $i; ?>" value="<?php echo repoblar_texto('telefono_a' . $i,'telefono_empresaA',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Ingreso mensual Estudio Socioeconómico</td>
                                        <td>
                                            <div class="input-prepend">
                                                <span class="add-on">$</span>
                                                <input type="text" name="ingreso_a<?php echo $i; ?>" value="<?php echo repoblar_texto('ingreso_a' . $i,'ingresoA',$informacion['aval'.$i]); ?>" class="money" />
                                                
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Egreso mensual Estudio Socioeconómico</td>
                                        <td>
                                            <div class="input-prepend">
                                                <span class="add-on">$</span>
                                                <input type="text" name="egreso_a<?php echo $i; ?>" value="<?php echo repoblar_texto('egreso_a' . $i,'egresoA',$informacion['aval'.$i]); ?>" class="money" />
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><p><strong>Actividad laboral del c&oacute;nyuge del aval</strong></p></td>
                            <td><table border="0" cellspacing="0" cellpadding="0" class="table table-bordered visible">
                                    <tr>
                                        <td width="34%">Actividad</td>
                                        <td width="66%">
                                            <?php
                                            $tmp = (isset($informacion['aval'.$i]['actividad_con'])) ? $informacion['aval'.$i]['actividad_con'] : '';?>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                                                <tr>
                                                    <td width="50%"><input type="radio" name="conyuact_a<?php echo $i; ?>" value="formal" <?php echo repoblar_radio('conyuact_a' . $i, 'formal',$tmp); ?> />
                                                        Formal</td>
                                                    <td><input type="radio" name="conyuact_a<?php echo $i; ?>" value="informal" <?php echo repoblar_radio('conyuact_a' . $i, 'informal',$tmp); ?>  />
                                                        Informal</td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de la empresa</td>
                                        <td><input type="text" name="conyuemp_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyuemp_a' . $i,'nombre_empresaC',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Antig&uuml;edad</td>
                                        <td>
                                            <div class="input-append">
                                                <input type="text" name="conyuant_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyuant_a' . $i,'antiguedadC',$informacion['aval'.$i]); ?>" class="" />
                                                <span class="add-on">año(s)</span>
                                                
                                                
                                            </div>
                                             
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Puesto</td>
                                        <td><input type="text" name="conyupuesto_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyupuesto_a' . $i,'puestoC',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tel&eacute;fono</td>
                                        <td><input type="text" name="conyutel_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyutel_a' . $i,'telefono_empresaC',$informacion['aval'.$i]); ?>" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Ingreso mensual Estudio Socioeconómico</td>
                                        <td>
                                            <div class="input-prepend">
                                                <span class="add-on">$</span>
                                                <input type="text" name="conyuing_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyuing_a' . $i,'ingresoC',$informacion['aval'.$i]); ?>" class="money" />
                                                
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Egreso mensual Estudio Socioeconómico</td>
                                        <td>
                                            <div class="input-prepend">
                                                <span class="add-on">$</span>
                                                <input type="text" name="conyueg_a<?php echo $i; ?>" value="<?php echo repoblar_texto('conyueg_a' . $i,'egresoC',$informacion['aval'.$i]); ?>" class="money" />
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>

    </div>
    
    <div id="comentarios" class="tab-pane <?php echo ($pestania == 'comentarios-li') ? 'active' : '';?>">
        <table class="table table-bordered table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td width="23%">
                        <strong>Comentarios</strong></td>
                    <td width="77%">
                        <textarea name="comentarios" style="width: 400px; height: 200px;"><?php echo repoblar_texto('comentarios','comentario',$informacion['alumno']); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class='clearfix'></div>

<script type="text/javascript">
    
    $(document).ready(function(){
        
       
        $('#myTab a').click(function (e) {
            var pestania;
            e.preventDefault();
            pestania = $(this).attr('data-id');
            //alert(pestania);
            $("#pestania").val(pestania);            
            $(this).tab('show');         
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        
        
        
    });
</script>

<?php $this->load->view('common/footer'); ?>