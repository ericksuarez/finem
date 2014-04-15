<?php $this->load->view('common/header'); ?>



<div id="contenido" >

    <?php $this->load->view('investigacion/general'); ?>

    <div id="print-zone">

    <?php echo ($expediente['investigado'] == 'NO') ? form_open(current_url(), array('class' => 'form-horizontal')) : ''; ?>

    <div class="row-fluid">

        <div class="span12">

            <legend>ECONOMÍA FAMILIAR</legend>

            <legend>ESTRUCTURA FAMILIAR (HERMANOS QUE DEPENDEN DE LA ECONOMÍA FAMILIAR)</legend>

            <div class="row-fluid">
            <fieldset>
                <div class="span3">
                <legend style="font-size:12px">Nombre</legend>
                 </div>
                <div class="span1">
                 <legend style="font-size:12px">Edad</legend>
                 </div>
                <div class="span2">
                 <legend style="font-size:12px">Ocupación</legend>
                 </div>
                <div class="span2">
                 <legend style="font-size:12px">Grado escolar</legend>
                 </div>
                <div class="span2">
                 <legend style="font-size:12px">Escuela*</legend>
                 </div>
                <div class="span2">
                 <legend style="font-size:12px">% de beca</legend>
                 </div>
            </fieldset>
            </div>
                        
            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="hermano1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermano1','nombre_hermano1',$info);?>'name="hermano1" class="input-large" id="hermano1" type="text" placeholder="Nombre">
                                </div>
                            </div>
                 </div>
                <div class="span1">
                 <div class="control-group">
                                <label class="" for="hermanoedad1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanoedad1','edad_hermano1',$info);?>' name="hermanoedad1" class="input-mini" id="hermanoedad1" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
                <div class="span2">
                  <div class="control-group">
                                <label class="" for="hermanocupacion1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanocupacion1','ocupacion_hermano1',$info);?>' name="hermanocupacion1" class="input-small" id="hermanocupacion1" type="text" placeholder="Ocupación">
                                </div>
                            </div>
                </div>
                <div class="span2">
                 <div class="control-group">
                                <label class="" for="hermanogrado1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanogrado1','grado_hermano1',$info);?>' name="hermanogrado1" class="input-small" id="hermanogrado1" type="text" placeholder="Escolaridad">
                                </div>
                            </div>
                </div>
                <div class="span2">
                 <div class="control-group">
                                <label class="" for="hermanoescuela1"></label>
                                <div class="">
                                    <?php $tmp=($info['escuela_hermano1']) ? $info['escuela_hermano1'] : '';?>
                                    <select name="hermanoescuela1" class="input-small" id="hermanoescuela1">
                                        <option value='publica'<?php echo repoblar_select('hermanoescuela1', 'publica', $tmp); ?>>Pública</option>
                                        <option value='privada'<?php echo repoblar_select('hermanoescuela1', 'privada', $tmp); ?>>Privada</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                 <div class="control-group">
                                <label class="" for="hermanobeca1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanobeca1','beca_hermano1',$info);?>' name="hermanobeca1" class="input-mini" id="hermanobeca1" type="text" placeholder="0">
                                </div>
                            </div>
                </div>

               </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="hermano2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermano2','nombre_hermano2',$info);?>' name="hermano2" class="input-large" id="hermano2" type="text" placeholder="Nombre">
                                </div>
                            </div>
                </div>
                <div class="span1">
                <div class="control-group">
                                <label class="" for="hermanoedad2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanoedad2','edad_hermano2',$info);?>'  name="hermanoedad2" class="input-mini" id="hermanoedad2" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanocupacion2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanocupacion2','ocupacion_hermano2',$info);?>' name="hermanocupacion2" class="input-small" id="hermanocupacion2" type="text" placeholder="Ocupación">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanogrado2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanogrado2','grado_hermano2',$info);?>' name="hermanogrado2" class="input-small" id="hermanogrado2" type="text" placeholder="Escolaridad">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanoescuela2"></label>
                                <div class="">
                                    <?php $tmp=($info['escuela_hermano2']) ? $info['escuela_hermano2'] : '';?>
                                    <select name="hermanoescuela2" class="input-small" id="hermanoescuela2">
                                        <option value='publica'<?php echo repoblar_select('hermanoescuela2', 'publica', $tmp); ?>>Pública</option>
                                        <option value='privada'<?php echo repoblar_select('hermanoescuela2', 'privada', $tmp); ?>>Privada</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanobeca2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanobeca2','beca_hermano2',$info);?>'name="hermanobeca2" class="input-mini" id="hermanobeca2" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="hermano3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermano3','nombre_hermano3',$info);?>'name="hermano3" class="input-large" id="hermano3" type="text" placeholder="Nombre">
                                </div>
                            </div>
                </div>
                <div class="span1">
                <div class="control-group">
                                <label class="" for="hermanoedad3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanoedad3','edad_hermano3',$info);?>' name="hermanoedad3" class="input-mini" id="hermanoedad3" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanocupacion3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanocupacion3','ocupacion_hermano3',$info);?>'name="hermanocupacion3" class="input-small" id="hermanocupacion3" type="text" placeholder="Ocupación">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanogrado3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('he10rmanogrado3','grado_hermano3',$info);?>'name="hermanogrado3" class="input-small" id="hermanogrado3" type="text" placeholder="Escolaridad">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanoescuela3"></label>
                                <div class="">
                                    <?php $tmp=($info['escuela_hermano3']) ? $info['escuela_hermano3'] : '';?>
                                    <select name="hermanoescuela3" class="input-small" id="hermanoescuela3">
                                        <option value='publica'<?php echo repoblar_select('hermanoescuela3', 'publica', $tmp); ?>>Pública</option>
                                        <option value='privada'<?php echo repoblar_select('hermanoescuela3', 'privada', $tmp); ?>>Privada</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanobeca3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanobeca3','beca_hermano3',$info);?>'name="hermanobeca3" class="input-mini" id="hermanobeca3" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="hermano4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermano5','nombre_hermano4',$info);?>'name="hermano4" class="input-large" id="hermano4" type="text" placeholder="Nombre">
                                </div>
                            </div>
                </div>
                <div class="span1">
                <div class="control-group">
                                <label class="" for="hermanoedad4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanoedad4','edad_hermano4',$info);?>' name="hermanoedad4" class="input-mini" id="hermanoedad4" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanocupacion4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanocupacion4','ocupacion_hermano4',$info);?>' name="hermanocupacion4" class="input-small" id="hermanocupacion4" type="text" placeholder="Ocupación">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanogrado4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanogrado4','grado_hermano4',$info);?>'name="hermanogrado4" class="input-small" id="hermanogrado4" type="text" placeholder="Escolaridad">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanoescuela4"></label>
                                <div class="">
                                    <?php $tmp=($info['escuela_hermano4']) ? $info['escuela_hermano4'] : '';?>
                                    <select name="hermanoescuela4" class="input-small" id="hermanoescuela4">
                                        <option value='publica'<?php echo repoblar_select('hermanoescuela4', 'publica', $tmp); ?>>Pública</option>
                                        <option value='privada'<?php echo repoblar_select('hermanoescuela4', 'privada', $tmp); ?>>Privada</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanobeca4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanobeca4','beca_hermano4',$info);?>'name="hermanobeca4" class="input-mini" id="hermanobeca4" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="hermano5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermano5','nombre_hermano5',$info);?>' name="hermano5" class="input-large" id="hermano5" type="text" placeholder="Nombre">
                                </div>
                            </div>
                </div>
                <div class="span1">
                            <div class="control-group">
                                <label class="" for="hermanoedad5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanoedad5','edad_hermano5',$info);?>'  name="hermanoedad5" class="input-mini" id="hermanoedad5" type="text" placeholder="0">
                                </div>
                            </div>
                    </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanocupacion5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanocupacion5','ocupacion_hermano5',$info);?>' name="hermanocupacion5" class="input-small" id="hermanocupacion5" type="text" placeholder="Ocupación">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanogrado5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanogrado5','grado_hermano5',$info);?>' name="hermanogrado5" class="input-small" id="hermanogrado5" type="text" placeholder="Escolaridad">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanoescuela5"></label>
                                <div class="">
                                    <?php $tmp = ($info['escuela_hermano5']) ? $info['escuela_hermano5'] : '';?>
                                    <select name="hermanoescuela5" class="input-small" id="hermanoescuela5">
                                        <option value='publica'<?php echo repoblar_select('hermanoescuela5', 'publica', $tmp); ?>>Pública</option>
                                        <option value='privada'<?php echo repoblar_select('hermanoescuela5', 'privada', $tmp); ?>>Privada</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="hermanobeca5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('hermanobeca5','beca_hermano5',$info);?>' name="hermanobeca5" class="input-mini" id="hermanobeca5" type="text" placeholder="0">
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
               <fieldset>
                <div class="span6">
                <legend style="font-size:12px">DESCRIPCIÓN</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">VALOR APROX.</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">PAGADO TOTALMENTE</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">ADEUDO</legend>
                </div>
               </fieldset>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion1">AUTOMÓVIL 1 </label>
                                    <input value='<?php echo repoblar_texto('descripcion1','descripcion_auto1',$info);?>' name="descripcion1" class="input-medium" id="descripcion1" type="text" placeholder="">
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor1"></label>
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor1','valoraprox_auto1',$info);?>' name="valor1" class="input-small money suma" data-sumar="valortotal" id="valor1" type="text" placeholder="0.00">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado1"></label>
                                <div class="">
                                    <?php $tmp = ($info['pagado_auto1']) ? $info['pagado_auto1'] : '';?>
                                    <select name="pagado1" class="input-mini" id="pagado1">
                                        <option value='si'<?php echo repoblar_select('pagado1', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado1', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo1','adeudo_auto1',$info);?>'name="adeudo1" class="input-small money suma" data-sumar="adeudo" id="adeudo1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion2">AUTOMÓVIL 2 </label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion2','descripcion_auto2',$info);?>'name="descripcion2" class="input-medium" id="descripcion2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor2','valoraprox_auto2',$info);?>' name="valor2" class="input-small money suma" data-sumar="valortotal" id="valor2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado2"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_auto2']) ? $info['pagado_auto2'] : ''?>
                                    <select name="pagado2" class="input-mini" id="pagado2">
                                        <option value='si'<?php echo repoblar_select('pagado2', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado2', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo2','adeudo_auto2',$info);?>'name="adeudo2" class="input-small money suma" data-sumar="adeudo" id="adeudo2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion3">AUTOMÓVIL 3 </label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion3','descripcion_auto3',$info);?>' name="descripcion3" class="input-medium" id="descripcion3" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor3"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor3','valoraprox_auto3',$info);?>' name="valor3" class="input-small money suma" data-sumar="valortotal" id="valor3" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado3"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_auto3']) ? $info['pagado_auto3'] : ''?>
                                    <select name="pagado3" class="input-mini" id="pagado3">
                                        <option value='si'<?php echo repoblar_select('pagado3', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado3', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo3"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo3','adeudo_auto3',$info);?>' name="adeudo3" class="input-small money suma" data-sumar="adeudo" id="adeudo3" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion4">COMPUTADORA </label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion4','descripcion_computadora',$info);?>' name="descripcion4" class="input-medium" id="descripcion4" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor4"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor4','valoraprox_computadora',$info);?>' name="valor4" class="input-small money suma" data-sumar="valortotal" id="valor4" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado4"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_computadora']) ? $info['pagado_computadora'] : ''?>
                                    <select name="pagado4" class="input-mini" id="pagado4">
                                        <option value='si'<?php echo repoblar_select('pagado4', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado1', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo4"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo4','adeudo_computadora',$info);?>' name="adeudo4" class="input-small money suma" data-sumar="adeudo" id="adeudo4" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion5">LIBROS DE BIBLIOTECA PERSONAL</label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion5','descripcion_libro',$info);?>'name="descripcion5" class="input-medium" id="descripcion5" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor5"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor5','valoraprox_libro',$info);?>'name="valor5" class="input-small money suma" data-sumar="valortotal" id="valor5" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado5"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_libro']) ? $info['pagado_libro'] : ''?>
                                    <select name="pagado5" class="input-mini" id="pagado5">
                                        <option value='si'<?php echo repoblar_select('pagado5', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado5', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo5"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo5','adeudo_libro',$info);?>' name="adeudo5" class="input-small money suma" data-sumar="adeudo" id="adeudo5" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion6">MENAJE DE CASA</label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion6','descripcion_mensaje',$info);?>'name="descripcion6" class="input-medium" id="descripcion6" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor6"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor6','valoraprox_mensaje',$info);?>'name="valor6" class="input-small money suma" data-sumar="valortotal" id="valor6" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado6"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_mensaje']) ? $info['pagado_mensaje'] : ''?>
                                    <select name="pagado6" class="input-mini" id="pagado6">
                                        <option value='si'<?php echo repoblar_select('pagado6', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado6', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo6"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo6','adeudo_mensaje',$info);?>' name="adeudo6" class="input-small money suma" data-sumar="adeudo" id="adeudo6" type="text" placeholder="0.00">
                                    </div>
                                </div>

                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion7">OTROS BIENES MUEBLES</label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion7','descripcion_otros',$info);?>'name="descripcion7" class="input-medium" id="descripcion7" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor7"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor7','valoraprox_otros',$info);?>' name="valor7" class="input-small money suma" data-sumar="valortotal" id="valor7" type="text" placeholder="0.00">
                                    </div>
                                </div>

                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado7"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_otros']) ? $info['pagado_otros'] : ''?>
                                    <select name="pagado7" class="input-mini" id="pagado7">
                                        <option value='si'<?php echo repoblar_select('pagado7', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado7', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo7"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo7','adeudo_otros',$info);?>' name="adeudo7" class="input-small money suma" data-sumar="adeudo" id="adeudo7" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                                <label class="control-label" for="descripcion8">BIENES INMUEBLES</label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion8','descripcion_bienesin',$info);?>' name="descripcion8" class="input-medium" id="descripcion8" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor8"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor8','valoraprox_bienesin',$info);?>'name="valor8" class="input-small money suma" data-sumar="valortotal" id="valor8" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado8"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_bienesin']) ? $info['pagado_bienesin'] : ''?>
                                    <select name="pagado8" class="input-mini" id="pagado8">
                                        <option value='si'<?php echo repoblar_select('pagado8', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado8', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo8"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo8','adeudo_bienesin',$info);?>' name="adeudo8" class="input-small money suma" data-sumar="adeudo" id="adeudo8" type="text" placeholder="0.00">
                                    </div>
                                </div>

                            </div>
                </div>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span6">
                <div class="control-group">
                <label class="control-label" for="descripcion9">OTROS BIENES INMUEBLES</label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('descripcion9','descripcion_otros2',$info);?>'name="descripcion9" class="input-medium" id="descripcion9" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="valor9"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valor9','valoraprox_otros2',$info);?>' name="valor9" class="input-small money suma" data-sumar="valortotal" id="valor9" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pagado9"></label>
                                <div class="">
                                    <?php $tmp=($info['pagado_otros2']) ? $info['pagado_otros2'] : ''?>
                                    <select name="pagado9" class="input-mini" id="pagado9">
                                        <option value='si'<?php echo repoblar_select('pagado9', 'si', $tmp); ?>>Si</option>
                                        <option value='no'<?php echo repoblar_select('pagado9', 'no', $tmp); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="adeudo9"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo9','adeudo_otros2',$info);?>' name="adeudo9" class="input-small money suma" data-sumar="adeudo" id="adeudo9" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span6">
                    <div>
                            <div class="control-group">
                                <label class="control-label" for="xxxxxxx">MONTO TOTAL DE LOS BIENES</label>
                            </div>
                    </div>
                </div>

                <div class="span2">
                            <div class="control-group">
                                <label class="" for="valortotal">Valor total</label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('valortotal','monto_bienes',$info);?>' name="valortotal" class="input-small money" id="valortotal" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>

                <div class="span2 offset2">
                            <div class="control-group">
                                <label class="" for="adeudo">Adeudo</label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('adeudo','monto_adeudo',$info);?>'name="adeudo" class="input-small money" id="adeudo" type="text" placeholder="0.00">
                                    </div>
                                </div>
                                <label class="" for="diferencia">Diferencia</label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('diferencia','monto_diferencia',$info);?>'name="diferencia" class="input-small money" id="diferencia" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

	<div class="row-fluid">
        <div class="span12">
            <legend>ACTIVOS FINANCIEROS</legend>
            <div class="row-fluid">
                <fieldset>
                <div class="span4">
                <legend style="font-size:12px">Descripción</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Institución</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Titular</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">No. cuenta</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Monto (MN)</legend>
                </div>
                </fieldset>
            </div><!-- /row-fluid -->
            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="activo_descripcion1"></label>
                                <div class="">                     
                                    <textarea name="activo_descripcion1" id="activo_descripcion1"><?php echo repoblar_texto('activo_descripcion','activo_descripcion',$info);?></textarea>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="activo_institucion1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_institucion1','activo_institucion',$info);?>' name="activo_institucion1" class="input-medium" id="activo_institucion1" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="activo_titular1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_titular1','activo_titular',$info);?>' name="activo_titular1" class="input-medium" id="activo_titular1" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="activo_ncuenta1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_ncuenta','activo_cuenta',$info);?>' name="activo_ncuenta1" class="input-medium" id="activo_ncuenta1" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="activo_monto1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('activo_monto1','activo_monto',$info);?>' name="activo_monto1" class="input-mini money" id="activo_monto1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div><!-- /row-fluid -->

            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="activo_descripcion2"></label>
                                <div class="">                     
                                    <textarea name="activo_descripcion2" id="activo_descripcion2"><?php echo repoblar_texto('activo_descripcion2','activo_descripcion2',$info);?></textarea>
                                </div>
                            </div>
                    </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="activo_institucion2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_institucion2','activo_institucion2',$info);?>' name="activo_institucion2" class="input-medium" id="activo_institucion2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="activo_titular2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_institucion2','activo_institucion2',$info);?>' name="activo_titular2" class="input-medium" id="activo_titular2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="activo_ncuenta2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('activo_ncuenta2','activo_cuenta2',$info);?>' name="activo_ncuenta2" class="input-medium" id="activo_ncuenta2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="activo_monto2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('activo_monto2','activo_monto2',$info);?>' name="activo_monto2" class="input-mini money" id="activo_monto2" type="text" placeholder="0.00">
                                    </div>
                            </div>
                    </div>
                </div>
            </div><!-- /row-fluid -->
            </div>
        </div>
    </div>



    <div class="row-fluid">
        <div class="span12">
            <legend>SEGUROS</legend>
            <div class="row-fluid">
              <fieldset>
                <div class="span4">
                 <legend style="font-size:12px">Seguro</legend>
                </div>
                <div class="span4">
                <legend style="font-size:12px">Prima</legend>
                </div>
                <div class="span4">
                <legend style="font-size:12px">Suma asegurada</legend>
                </div>
              </fieldset>
            </div>
            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="seguro1"></label>
                                <div class="">
                                    <?php $tmp=(isset($info['seg_seguro'])) ? $info['seg_seguro'] : '';?>
                                    <select name="seguro1" class="input-medium" id="seguro1">
                                        <option>.....</option>
                                        <option value='deautomovil'<?php echo repoblar_select('seguro1', 'deautomovil', $tmp); ?>>DE AUTOMÓVIL</option>
                                        <option value='derivada'<?php echo repoblar_select('seguro1', 'devida', $tmp); ?>>DE VIDA</option>
                                        <option value='gmm'<?php echo repoblar_select('seguro1', 'gmm', $tmp); ?>>GMM</option>
                                        <option value='otro'<?php echo repoblar_select('seguro1', 'otro', $tmp); ?>>OTRO</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="prima1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('prima1','seg_prima',$info);?>' name="prima1" class="input-small money" id="prima1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="suma_asegurada1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input  value='<?php echo repoblar_texto('suma_asegurada1','seg_suma',$info);?>' name="suma_asegurada1" class="input-small money" id="suma_asegurada1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="seguro2"></label>
                                <div class="">
                                    <?php $tmp=(isset($info['seg_seguro2'])) ? $info['seg_seguro2'] : '';?>
                                    <select name="seguro2" class="input-medium" id="seguro2">
                                        <option>.....</option>
                                        <option value='deautomovil'<?php echo repoblar_select('seguro2', 'deautomovil', $tmp); ?>>DE AUTOMÓVIL</option>
                                        <option value='devida'<?php echo repoblar_select('seguro2', 'devida', $tmp); ?>>DE VIDA</option>
                                        <option value='gmm'<?php echo repoblar_select('seguro2', 'gmm', $tmp); ?>>GMM</option>
                                        <option value='otro'<?php echo repoblar_select('seguro2', 'otro', $tmp); ?>>OTRO</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="prima2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('prima2','seg_prima2',$info);?>' name="prima2" class="input-small money" id="prima2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="suma_asegurada2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('suma_asegurada2','seg_suma2',$info);?>' name="suma_asegurada2" class="input-small money" id="suma_asegurada2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="seguro3"></label>
                                <div class="">
                                    <?php $tmp=(isset($info['seg_seguro3'])) ? $info['seg_seguro3'] : '';?>
                                    <select name="seguro3" class="input-medium" id="seguro3">
                                        <option>.....</option>
                                        <option value='deautomovil'<?php echo repoblar_select('seguro3', 'deautomovil', $tmp); ?>>DE AUTOMÓVIL</option>
                                        <option value='devida'<?php echo repoblar_select('seguro3', 'devida', $tmp); ?>>DE VIDA</option>
                                        <option value='gmm'<?php echo repoblar_select('seguro3', 'gmm', $tmp); ?>>GMM</option>
                                        <option value='otro'<?php echo repoblar_select('seguro3', 'otro', $tmp); ?>>OTRO</option>
                                    </select>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="prima3"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('prima3','seg_prima3',$info);?>' name="prima3" class="input-small money" id="prima3" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="suma_asegurada3"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('suma_asegurada3','seg_suma3',$info);?>'name="suma_asegurada3" class="input-small money" id="suma_asegurada3" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="seguro4"></label>
                                <div class="">
                                    <?php $tmp=(isset($info['seg_seguro4'])) ? $info['seg_seguro4'] : '';?>
                                    <select name="seguro4" class="input-medium" id="seguro4">
                                        <option>.....</option>
                                        <option value='deautomovil'<?php echo repoblar_select('seguro4', 'deautomovil', $tmp); ?>>DE AUTOMÓVIL</option>
                                        <option value='devida'<?php echo repoblar_select('seguro4', 'devida', $tmp); ?>>DE VIDA</option>
                                        <option value='gmm'<?php echo repoblar_select('seguro4', 'gmm', $tmp); ?>>GMM</option>
                                        <option value='otro'<?php echo repoblar_select('seguro4', 'otro', $tmp); ?>>OTRO</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="prima4"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('prima4','seg_prima4',$info);?>' name="prima4" class="input-small money" id="prima4" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="span4">
                <div class="control-group">
                                <label class="" for="suma_asegurada4"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('suma_asegurada4','seg_suma4',$info);?>' name="suma_asegurada4" class="input-small money" id="suma_asegurada4" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
                </div>
            </div>
        </div>

    <div class="row-fluid">
        <div class="span12">
            <legend>PASIVOS</legend>
            <div class="row-fluid">
            <fieldset>
                <div class="span4">
                 <legend style="font-size:12px">Descripción</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Institución</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Titular</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">No. cuenta</legend>
                </div>
                <div class="span2">
                <legend style="font-size:12px">Monto (MN)</legend>
                </div>
            </fieldset>
            </div>
            <div class="row-fluid">
                <div class="span4">
                <div class="control-group">
                                <label class="" for="pasivo_descripcion1"></label>
                                <div class="">                     
                                    <textarea name="pasivo_descripcion1" id="pasivo_descripcion1"><?php echo repoblar_texto('pasivo_descripcion1','pacivo_descripcion',$info);?></textarea>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_institucion1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_institucion1','pacivo_institucion',$info);?>' name="pasivo_institucion1" class="input-medium" id="pasivo_institucion1" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_titular1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_titular1','pacivo_titular',$info);?>'name="pasivo_titular1" class="input-medium" id="pasivo_titular1" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="pasivo_ncuenta1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_ncuenta1','pacivo_cuenta',$info);?>' name="pasivo_ncuenta1" class="input-medium" id="pasivo_ncuenta1" type="text" placeholder="">
                                </div>
                            </div>

                </div>
                <div class="span2">
                            <div class="control-group">
                                <label class="" for="pasivo_monto1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('pasivo_monto1','pacivo_monto',$info);?>' name="pasivo_monto1" class="input-mini money" id="pasivo_monto1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                </div>
            </div>
                
            <div class="row-fluid">
                <div class="span4">
                            <div class="control-group">
                                <label class="" for="pasivo_descripcion2"></label>
                                <div class="">                     
                                    <textarea name="pasivo_descripcion2" id="pasivo_descripcion2"><?php echo repoblar_texto('pasivo_descripcion2','pacivo_descripcion2',$info);?></textarea>
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_institucion2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_institucion1','pacivo_institucion2',$info);?>' name="pasivo_institucion2" class="input-medium" id="pasivo_institucion2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_titular2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_titular2','pacivo_titular2',$info);?>'name="pasivo_titular2" class="input-medium" id="pasivo_titular2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_ncuenta2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('pasivo_ncuenta2','pacivo_cuenta2',$info);?>' name="pasivo_ncuenta2" class="input-medium" id="pasivo_ncuenta2" type="text" placeholder="">
                                </div>
                            </div>
                </div>
                <div class="span2">
                <div class="control-group">
                                <label class="" for="pasivo_monto2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input  value='<?php echo repoblar_texto('pasivo_monto2','pacivo_monto2',$info);?>' name="pasivo_monto2" class="input-mini money" id="pasivo_monto2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
                    </div>
                </div>

    <div class="row-fluid">
        <div class="span12">
            <legend>INGRESOS FAMILIARES BRUTOS (ÚNICAMENTE PERSONAS QUE CONTRIBUYEN A LA ECONOMÍA FAMILIAR)</legend>
            <div class="row-fluid">
                <fieldset>
                <div class="span3">
                <legend style="font-size:12px">Nombre</legend>
                 </div>
                <div class="span3">
                <legend style="font-size:12px">Parentesco</legend>
                 </div>
                <div class="span3">
                <legend style="font-size:12px">Concepto</legend>
                 </div>
                <div class="span3">
                <legend style="font-size:12px">$ mensual</legend>
                 </div>
                 </fieldset>
             </div>
             
             <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom1','ingreso_nombre',$info);?>'  name="ingresos_nom1" class="input-large" id="ingresos_nom1" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_parentesco1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco1','ingreso_parentesco',$info);?>' name="ingresos_parentesco1" class="input-medium" id="ingresos_parentesco1" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_concepto1"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto1','ingreso_consepto',$info);?>' name="ingresos_concepto1" class="input-medium" id="ingresos_concepto1" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_mensual1"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual1','ingreso_mensual',$info);?>' name="ingresos_mensual1" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual1" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom2','ingreso_nombre2',$info);?>'name="ingresos_nom2" class="input-large" id="ingresos_nom2" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco2','ingreso_parentesco2',$info);?>' name="ingresos_parentesco2" class="input-medium" id="ingresos_parentesco2" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto2"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto2','ingreso_consepto2',$info);?>' name="ingresos_concepto2" class="input-medium" id="ingresos_concepto2" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual2"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual2','ingreso_mensual2',$info);?>' name="ingresos_mensual2" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual2" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom3','ingreso_nombre3',$info);?>' name="ingresos_nom3" class="input-large" id="ingresos_nom3" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco3','ingreso_parentesco3',$info);?>' name="ingresos_parentesco3" class="input-medium" id="ingresos_parentesco3" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto3"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto3','ingreso_consepto3',$info);?>' name="ingresos_concepto3" class="input-medium" id="ingresos_concepto3" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual3"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual3','ingreso_mensual3',$info);?>'name="ingresos_mensual3" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual3" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom4','ingreso_nombre4',$info);?>' name="ingresos_nom4" class="input-large" id="ingresos_nom4" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco4','ingreso_parentesco4',$info);?>'name="ingresos_parentesco4" class="input-medium" id="ingresos_parentesco4" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto4"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto4','ingreso_consepto4',$info);?>' name="ingresos_concepto4" class="input-medium" id="ingresos_concepto4" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual4"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual4','ingreso_mensual4',$info);?>' name="ingresos_mensual4" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual4" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom5"></label>
                                <div class="">
                                    <input  value='<?php echo repoblar_texto('ingresos_nom5','ingreso_nombre5',$info);?>'name="ingresos_nom5" class="input-large" id="ingresos_nom5" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco5','ingreso_parentesco5',$info);?>' name="ingresos_parentesco5" class="input-medium" id="ingresos_parentesco5" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto5"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto5','ingreso_consepto5',$info);?>' name="ingresos_concepto5" class="input-medium" id="ingresos_concepto5" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual5"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual5','ingreso_mensual5',$info);?>' name="ingresos_mensual5" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual5" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom6"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom6','ingreso_nombre6',$info);?>'name="ingresos_nom6" class="input-large" id="ingresos_nom6" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco6"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco6','ingreso_parentesco6',$info);?>'name="ingresos_parentesco6" class="input-medium" id="ingresos_parentesco6" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto6"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto6','ingreso_consepto6',$info);?>' name="ingresos_concepto6" class="input-medium" id="ingresos_concepto6" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual6"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual6','ingreso_mensual6',$info);?>'name="ingresos_mensual6" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual6" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom7"></label>
                                <div class="">
                                    <input  value='<?php echo repoblar_texto('ingresos_nom7','ingreso_nombre7',$info);?>'name="ingresos_nom7" class="input-large" id="ingresos_nom7" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco7"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco7','ingreso_parentesco7',$info);?>'name="ingresos_parentesco7" class="input-medium" id="ingresos_parentesco7" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto7"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto7','ingreso_consepto7',$info);?>' name="ingresos_concepto7" class="input-medium" id="ingresos_concepto7" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual7"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input  value='<?php echo repoblar_texto('ingresos_mensual7','ingreso_mensual7',$info);?>'name="ingresos_mensual7" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual7" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom8"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom8','ingreso_nombre8',$info);?>'name="ingresos_nom8" class="input-large" id="ingresos_nom8" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco8"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco8','ingreso_parentesco8',$info);?>'name="ingresos_parentesco8" class="input-medium" id="ingresos_parentesco8" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto8"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto8','ingreso_consepto8',$info);?>' name="ingresos_concepto8" class="input-medium" id="ingresos_concepto8" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual8"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual8','ingreso_mensual8',$info);?>' name="ingresos_mensual8" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual8" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_nom9"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_nom9','ingreso_nombre9',$info);?>' name="ingresos_nom9" class="input-large" id="ingresos_nom9" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_parentesco9"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_parentesco9','ingreso_parentesco9',$info);?>'name="ingresos_parentesco9" class="input-medium" id="ingresos_parentesco9" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_concepto9"></label>
                                <div class="">
                                    <input value='<?php echo repoblar_texto('ingresos_consepto9','ingreso_consepto9',$info);?>' name="ingresos_concepto9" class="input-medium" id="ingresos_concepto9" type="text" placeholder="">
                                </div>
                            </div>
                 </div>
                <div class="span3">
                <div class="control-group">
                                <label class="" for="ingresos_mensual9"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_mensual9','ingreso_mensual9',$info);?>' name="ingresos_mensual9" class="input-small money suma" data-sumar="ingresos_total" id="ingresos_mensual9" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                 </div>
             </div>     

            <div class="row-fluid">
                <div class="span6">
                            <p style="font-size:9px"> *Notas: Favor de anexar copia de comprobantes de todos los ingresos detallados. En caso de ser un negocio la principal fuente de ingresos familiar, requerimos fotografías del mismo.</p>
                 </div>
                 <div class="span3">
                            <p align="right"> Total de ingresos familiares:</p>
                </div>
                <div class="span3">
                            <div class="control-group">
                                <label class="" for="ingresos_total"></label>
                                <div class="">
                                    <div class="input-prepend">
                                        <span class="add-on">$</span>
                                        <input value='<?php echo repoblar_texto('ingresos_total','ingreso_totalmensual',$info);?>'name="ingresos_total" class="input-small money" id="ingresos_total" type="text" placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                </div>
             </div>   
                    </div>
                </div>

    

    <table style="text-align:center" width="80%" border="0" cellspacing="0" cellpadding="0">

        <tr>

            <th scope="col">INTEGRACIÓN DE EGRESOS</th>

            <th scope="col">CONCEPTO</th>

            <th scope="col">MENSUAL</th>

            <th scope="col">ANUAL</th>

        </tr>

        <tr>

            <td> ALIMENTACIÓN</td>

            <td>&nbsp;</td>

            <td>

                <label class="control-label" for="egresomen1"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen1" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen1", "integracion_alimentacionmens", $info); ?>" id="egresomen1" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu1"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu1" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu1", "integracion_alimentacionanual", $info); ?>" id="egresoanu1" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>SERVICIOS</td>

            <td>RENTA</td>

            <td>

                <label class="control-label" for="egresomen2"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen2" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen2", "integracion_servrentamens", $info); ?>" id="egresomen2" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu2"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu2" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu2", "integracion_servrentaanual", $info); ?>" id="egresoanu2" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>IMP. PREDIAL</td>

            <td>

                <label class="control-label" for="egresomen3"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen3" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen3", "integracion_servimppredailmens", $info); ?>" id="egresomen3" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu3"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu3" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu3", "integracion_servimppredailanual", $info); ?>" id="egresoanu3" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>AGUA</td>

            <td>

                <label class="control-label" for="egresomen4"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen4" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen4", "integracion_servaguamensual", $info); ?>" id="egresomen4" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu4"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu4" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu4", "integracion_servaguaanual", $info); ?>" id="egresoanu4" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>LUZ</td>

            <td>

                <label class="control-label" for="egresomen5"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen5" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen5", "integracion_servluzmensual", $info); ?>" id="egresomen5" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu5"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu5" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu5", "integracion_servluzanual", $info); ?>" id="egresoanu5" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>GAS</td>

            <td>

                <label class="control-label" for="egresomen6"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen6" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen6", "integracion_servgasmensual", $info); ?>" id="egresomen6" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu6"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu6" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu6", "integracion_servgasanual", $info); ?>" id="egresoanu6" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TELÉFONO/CELULAR</td>

            <td>

                <label class="control-label" for="egresomen7"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen7" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen7", "integracion_servtelmensual", $info); ?>" id="egresomen7" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu7"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu7" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu7", "integracion_servtelanual", $info); ?>" id="egresoanu7" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>EDUCACIÓN</td>

            <td>COLEGIATURAS</td>

            <td>

                <label class="control-label" for="egresomen8"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen8" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen8", "integracion_educolegmensual", $info); ?>" id="egresomen8" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu8"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu8" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu8", "integracion_educoleanual", $info); ?>" id="egresoanu8" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>INSCRIPCIONES</td>

            <td>

                <label class="control-label" for="egresomen9"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen9" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen9", "integracion_eduinscripmensual", $info); ?>" id="egresomen9" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu9"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu9" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu9", "integracion_eduinscripanual", $info); ?>" id="egresoanu9" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>CURSOS</td>

            <td>

                <label class="control-label" for="egresomen10"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen10" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen10", "integracion_educursomensual", $info); ?>" id="egresomen10" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu10"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu10" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu10", "integracion_educursoanual", $info); ?>" id="egresoanu10" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>ÚTILES ESCOLARES</td>

            <td>

                <label class="control-label" for="egresomen11"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen11" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen11", "integracion_eduutilesmensual", $info); ?>" id="egresomen11" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu11"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu11" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu11", "integracion_eduutilesanual", $info); ?>" id="egresoanu11" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>SEGUROS</td>

            <td>DE VIDA</td>

            <td>

                <label class="control-label" for="egresomen12"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen12" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen12", "integracion_segurovidamensual", $info); ?>" id="egresomen12" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu12"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu12" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu12", "integracion_segurovidaanual", $info); ?>" id="egresoanu12" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>GASTOS MÉDICOS</td>

            <td>

                <label class="control-label" for="egresomen13"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen13" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen13", "integracion_segurogastomedicomensual", $info); ?>" id="egresomen13" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu13"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu13" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu13", "integracion_segurogastomedicoanual", $info); ?>" id="egresoanu13" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>DE AUTOMÓVIL</td>

            <td>

                <label class="control-label" for="egresomen14"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen14" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen14", "integracion_seguroautomovilmensual", $info); ?>" id="egresomen14" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu14"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu14" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu14", "integracion_seguroautomovilanual", $info); ?>" id="egresoanu14" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>DE CASA</td>

            <td>

                <label class="control-label" for="egresomen15"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen15" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen15", "integracion_seguocasamensual", $info); ?>" id="egresomen15" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu15"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu15" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu15", "integracion_segurocasaanual", $info); ?>" id="egresoanu15" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>TRANSPORTE</td>

            <td>TRANSPORTE PÚBLICO</td>

            <td>

                <label class="control-label" for="egresomen16"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen16" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen16", "integracion_transportetransmen", $info); ?>" id="egresomen16" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu16"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu16" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu16", "integracion_transportetransanual", $info); ?>" id="egresoanu16" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>GASOLINA</td>

            <td>

                <label class="control-label" for="egresomen17"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen17" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen17", "integracion_transportegasolinamens", $info); ?>" id="egresomen17" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu17"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu17" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu17", "integracion_transportegasolinaanual", $info); ?>" id="egresoanu17" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>VERIFICACIÓN</td>


            <td>

                <label class="control-label" for="egresomen18"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen18" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen18", "integracion_transporteaverificacionmensual", $info); ?>" id="egresomen18" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu18"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu18" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu18", "integracion_transporteverificavionanual", $info); ?>" id="egresoanu18" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TENENCIA</td>

            <td>

                <label class="control-label" for="egresomen19"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen19" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen19", "integracion_transportetenenciamensual", $info); ?>" id="egresomen19" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu19"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu19" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu19", "integracion_transportetenenciaanual", $info); ?>" id="egresoanu19" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>MTTO. AUTOMÓVIL</td>

            <td>

                <label class="control-label" for="egresomen20"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen20" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen20", "integracion_transportemttoautomensual", $info); ?>" id="egresomen20" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu20"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu20" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu20", "integracion_transportemttoautoanual", $info); ?>" id="egresoanu20" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>DIVERSIÓN</td>

            <td>CLUB O DEPORTIVO</td>

            <td>

                <label class="control-label" for="egresomen21"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen21" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen21", "integracion_diversionclubmensual", $info); ?>" id="egresomen21" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu21"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu21" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu21", "integracion_diversionclubanual", $info); ?>" id="egresoanu21" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>DIVERSIÓN</td>

            <td>

                <label class="control-label" for="egresomen22"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen22" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen22", "integracion_diversiondivermensual", $info); ?>" id="egresomen22" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu22"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu22" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu22", "integracion_diversiondiveranual", $info); ?>" id="egresoanu22" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>VACACIONES</td>

            <td>

                <label class="control-label" for="egresomen23"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen23" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen23", "integracion_diversionvacacionmensual", $info); ?>" id="egresomen23" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu23"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu23" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu23", "integracion_diversionvacacionanual", $info); ?>" id="egresoanu23" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TELEVISIÓN DE PAGA</td>

            <td>

                <label class="control-label" for="egresomen24"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen24" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen24", "integracion_diversiontelemensual", $info); ?>" id="egresomen24" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu24"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu24" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu24", "integracion_diversionteleanual", $info); ?>" id="egresoanu24" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>VESTIDO</td>

            <td>ROPA Y UNIFORMES</td>

            <td>

                <label class="control-label" for="egresomen25"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen25" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen25", "integracion_vestidoropamensual", $info); ?>" id="egresomen25" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu25"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu25" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu25", "integracion_vestidoropaanual", $info); ?>" id="egresoanu25" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TINTORERÍA</td>

            <td>

                <label class="control-label" for="egresomen26"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen26" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen26", "integracion_vestidotintoreriamensual", $info); ?>" id="egresomen26" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu26"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu26" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu26", "integracion_vestidotitoreriaanual", $info); ?>" id="egresoanu26" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>OTROS</td>

            <td>AYUDA DOMÉSTICA</td>

            <td>

                <label class="control-label" for="egresomen27"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen27" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen27", "integracion_otrosayudamensual", $info); ?>" id="egresomen27" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu27"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu27" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu27", "integracion_otrosayudaanual", $info); ?>" id="egresoanu27" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>MANTENIM. CASA</td>

            <td>

                <label class="control-label" for="egresomen28"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen28" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen28", "integracion_otrosmentenimensual", $info); ?>" id="egresomen28" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu28"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu28" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu28", "integracion_otrosmantenimanual", $info); ?>" id="egresoanu28" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>MÉDICOS</td>

            <td>

                <label class="control-label" for="egresomen29"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen29" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen29", "integracion_otrosmedicomensual", $info); ?>" id="egresomen29" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu29"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu29" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu29", "integracion_otrosmendicoanual", $info); ?>" id="egresoanu29" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>OTROS GASTOS</td>

            <td>

                <label class="control-label" for="egresomen30"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen30" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen30", "integracion_otrosotromensual", $info); ?>" id="egresomen30" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu30"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu30" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu30", "integracion_otrosotroanual", $info); ?>" id="egresoanu30" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>ADEUDO</td>

            <td>HIPOTECARIO</td>

            <td>

                <label class="control-label" for="egresomen31"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen31" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen31", "integracion_adeudohipotemensual", $info); ?>" id="egresomen31" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu31"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu31" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu31", "integracion_adeudohipoteanual", $info); ?>" id="egresoanu31" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>AUTOMÓVIL</td>

            <td>

                <label class="control-label" for="egresomen32"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen32" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen32", "integracion_adeudoautomensual", $info); ?>" id="egresomen32" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu32"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu32" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu32", "integracion_adeudoautpanual", $info); ?>" id="egresoanu32" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TARJETAS DE CRÉDITO</td>

            <td>

                <label class="control-label" for="egresomen33"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen33" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen33", "integracion_adeudotargetamensual", $info); ?>" id="egresomen33" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu33"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu33" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu33", "integracion_adeudotargetaanual", $info); ?>" id="egresoanu33" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>PRÉSTAMOS PERS.</td>

            <td>

                <label class="control-label" for="egresomen34"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen34" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen34", "integracion_adeudoprestamomensual", $info); ?>" id="egresomen34" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu34"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu34" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu34", "integracion_adeudoprestamoanual", $info); ?>" id="egresoanu34" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>COMPUTADORA</td>

            <td>

                <label class="control-label" for="egresomen35"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen35" class="input-small money suma multiplicar" data-sumar="mensual" value="<?php echo repoblar_texto("egresomen35", "integracion_adeudocomputadoramensual", $info); ?>" id="egresomen35" type="text" placeholder="0.00" />

                </div>



            </td>

            <td><label class="control-label" for="egresoanu35"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu35" class="input-small money suma" data-sumar="anual" value="<?php echo repoblar_texto("egresoanu35", "integracion_adeudocomputadoraanual", $info); ?>" id="egresoanu35" type="text" placeholder="0.00" />

                </div>

            </td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

            <td>&nbsp;</td>

        </tr>

        <tr>

            <td>&nbsp;</td>

            <td>TOTAL DE EGRESOS</td>

            <td>

                <label class="control-label" for="egresomen36"></label>



                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresomen36" class="input-small money multiplicar" value="<?php echo repoblar_texto("egresomen36", "totalegreso_mensual", $info); ?>" id="mensual" type="text" placeholder="0.00" />

                </div>



            </td>

            <td>
                
                <label class="control-label" for="egresoanu36"></label>

                <div class="input-prepend">

                    <span class="add-on">$</span>

                    <input name="egresoanu36" class="input-small money" value="<?php echo repoblar_texto("egresoanu36", "totalegreso_adeudohipoteanual", $info); ?>" id="anual" type="text" placeholder="0.00" />

                </div>
                

            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type='button' class='btn btn-info btn-small' id='calcularAnual'>Calcular Anual</button></td>
        </tr>





    </table> 

     

    <?php if($expediente['investigado'] == 'NO'){?>

    <div class='pull-right'>

        <input type='submit' value='Guardar' class='btn btn-success' />

    </div>

    <?php

    }

    ?>

    <div class='pull-left'>

        <!--<button type='button' name="imprimible" class="btn btn-default" id="imprimible">Versión imprimible</button>-->

    </div>

    <div class='clearfix'></div>

    <?php echo ($expediente['investigado'] == 'NO') ? form_close() : ''; ?>

    </div>

</div>

<script type='text/javascript' src='<?php echo base_url('js/currencyFormat.js');?>'></script>

<script type="text/javascript" src="<?php echo base_url('js/print.js');?>"></script>

<script type="text/javascript">

    $(document).ready(function() {

        var valor,total,e,e1,diferencia;

        $(".suma").keyup(function(event){

            //alert(event.keyCode);

            total = 0;

            e = $(this).attr('data-sumar');

            

            if(event.keyCode == 13) {

                //alert('HI');

                event.preventDefault();

                return false;

            }else{

                //alert(e);

                $(".suma").each(function(){

                    valor = $(this).val().replace(/\,/g,'');

                    e1 = $(this).attr('data-sumar');

                    if(valor != '' && $.isNumeric(valor) && e == e1 ){

                        valor = parseFloat(valor);

                        total = valor + total;

                    }

                });

            }

            

            $("#"+e).val(number_format(total,2));

            //e = $.Event('keypress');

            //e.which = 9; // tabulador

            //$('item').trigger(e);

            //$("#"+e).trigger('keyup');

        });

        

        $("#valortotal").keyup(function(){

            $("#adeudo").trigger('keyup');

        });

        

        

        

        $("#adeudo").keyup(function(){

            total = $("#valortotal").val().replace(/\,/g,'');

            valor = $("#adeudo").val().replace(/\,/g,'');

            diferencia = 0;

            

            if( (valor != '' && $.isNumeric(valor)) && (total != '' && $.isNumeric(total)) ){

                valor = parseFloat(valor);

                total = parseFloat(total);

                diferencia = total - valor;

            }

            

            $("#diferencia").val(diferencia);

            //$("#diferencia").trigger('keyup');

        });

        

        $('.money').keyup();

        

        $("#imprimible").click(function(){

            PrintElem("#print-zone",'<?php echo base_url();?>');

        });
        
        /*$('.multiplicar').keyup(function(){
            //alert('clicked');
            var nombre,nombre2,numero,numero2;
            nombre = $(this).attr('name');
            numero = $(this).val().replace(/\,/g,'');
            nombre2 = nombre.replace(/\men/g,'anu');
            
            numero = parseFloat(numero);
            numero2 = numero * 12;
            $('input[name="'+nombre2+'"]').val(number_format(numero2,2));
            //numero2 = $('input[name="'+nombre2+'"]').val().replace(/\,/g,'');
            //alert(nombre2);
        });
        
        $('#sumarAnual').click(function(){
            $('.sumarAnual').keyup();
        });*/

        $('#calcularAnual').click(function(){
            //alert('clicked');
            $('.multiplicar').each(function(){
                var nombre,nombre2,numero,numero2;
                nombre = $(this).attr('name');
                numero = $(this).val().replace(/\,/g,'');
                nombre2 = nombre.replace(/\men/g,'anu');

                numero = parseFloat(numero);
                numero2 = numero * 12;
                $('input[name="'+nombre2+'"]').val(number_format(numero2,2));
            });
            $('.suma').keyup();
        });

    });

</script>



<?php $this->load->view('common/footer'); ?>