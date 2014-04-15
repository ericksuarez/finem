<?php
$user = $this->phpsession->get('user','finem');
$usuarios = $this->config->item('super_admin');?>
<br />

<br />

<?php
$contador = 0;
if(isset($informacion['analisis']['firma_1']) && isset($informacion['analisis']['firma_2']) && isset($informacion['analisis']['firma_3']) && isset($informacion['analisis']['firma_4'])){
    $contador = ($informacion['analisis']['firma_1'] == 1) ? $contador+ 1 : $contador - 1;
    $contador = ($informacion['analisis']['firma_2'] == 1) ? $contador+ 1 : $contador - 1;
    $contador = ($informacion['analisis']['firma_3'] == 1) ? $contador+ 1 : $contador - 1;
    $contador = ($informacion['analisis']['firma_4'] == 1) ? $contador+ 1 : $contador - 1;
}else{
    $contador--;
}
//$contador = 1;
if($contador < 0){
    $data['mensaje'] = 'El análisis no ha sido autorizado.';
    $this->load->view('errors/error_custom',$data);
}elseif($contador >= 0){

    $producto = obtener_campo('nombre.producto', 'idproducto.'.$expediente['producto_idproducto']);
    $universidad = obtener_campo('razon_social.universidad', 'iduniversidad.'.$expediente['universidad_iduniversidad']);
    ?>
<div class='tabbable tabs-left pull-left' style='width:18%;'>
    <ul id="myTab" class="nav nav-tabs affix">
        <?php $pestania = (!empty($_POST['pestania'])) ? $_POST['pestania'] : ''; ?>
        <li class="<?php echo (empty($pestania)) ? 'active' : (($pestania == 'cedula-li') ? 'active' : '' ); ?>"><a data-id='cedula-li' href="#cedula">Datos de Contrato</a></li>
        <!--<li class='<?php echo ($pestania == 'ficha-li') ? 'active' : ''; ?>'><a data-id='ficha-li' href="#ficha">Datos para inscripciones</a></li>
        <li class='<?php echo ($pestania == 'pagare-li') ? 'active' : ''; ?>'><a data-id='pagare-li' href="#pagare">Disposiciones y Pagaré</a></li>-->
        <li class='<?php echo ($pestania == 'cartas-li') ? 'active' : ''; ?>'><a data-id='cartas-li' href="#cartas">Cartas</a></li>
    </ul>
</div>
<?php $info=$informacion['contrato'];?>

<input type='hidden' name='pestania' id='pestania' value="<?php echo $pestania;?>" />
<div class="tab-content pull-right" style='width:80%;'>
    
    <div id="cedula" class="tab-pane <?php echo (empty($pestania)) ? 'active' : (($pestania == 'cedula-li') ? 'active' : '' );?>">
        
        <?php
        $mesa = $info['enviar_mesa'];
        $test = FALSE;
        if((in_array($user['idusuario'], $usuarios) && ($mesa == 1) ) || ($mesa == 0) || (empty($mesa)) ){ 
            $test = TRUE;
        }
        ?>
        
        <?php echo ($test == TRUE) ? form_open(current_url()) : '';?>
        <table class='table table-bordered table-hover'>
            <tr>
                <td>Producto</td>
                <td><?php echo $producto;?></td>
            </tr>
            <tr>
                <td>CAT</td>
                <td>
                    <div class="input-append">
                        <input class='numerico input-mini' type='text' name='cat' value='<?php echo repoblar_texto('cat','cat',$info);?>' />
                        <span class="add-on">%</span>


                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>Lugar de La Firma</td>
                <td><input type='text' name='lugar_firma' value='<?php echo repoblar_texto('lugar_firma','lugar_firma',$info);?>' /></td>
            </tr>
            <tr>
                <td>Plazo del Credito (Meses)</td>
                <td>
                    <?php echo $informacion['analisis']['plazo'];?>
                    <input type='hidden' name='plazo_credito' value='<?php echo $informacion['analisis']['plazo'];?>' />
                </td>
            </tr>
            <tr>
                <td>Duración de la Carrera</td>
                <td>
                    Del <input type='text' name='del' class='input-small' value='<?php echo repoblar_texto('del','del',$info);?>' />
                    Al <input type='text' name='al' class='input-small' value='<?php echo repoblar_texto('al','al',$info);?>' />
                </td>
            </tr>
            <tr>
                <td>Línea Global</td>
                <td>$<?php echo number_format($informacion['analisis']['linea_global'],2);?></td>
            </tr>
            <tr>
                <td>Línea Parcial</td>
                <td>
                    $<?php echo number_format($informacion['analisis']['importe'],2);?>
                    <input type='hidden' name='monto_total' value='<?php echo $informacion['analisis']['importe'];?>' />
                </td>
            </tr>
            <tr>
                <td>Primer Disposición</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type='text' name='primer_disposicion' class='money' value='<?php echo repoblar_texto('primer_disposicion','primer_disposicion',$info);?>' />
                        <input type='hidden' name='id' value='<?php echo $expediente['idexpediente'];?>' />
                        <input type='hidden' name='numero' value='1' />
                        <input type='hidden' name='contract' value='0' />
                        
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>Pago Mensual</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type='text' name='pago_mensual' class='money' value='<?php echo repoblar_texto('pago_mensual','pago_mensual',$info);?>' />
                        
                    </div>
                </td>
            </tr>
            <tr>
                <td>Cuota por Inscripción</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type='text' name='pago_extraordinario' class='money' value='<?php echo repoblar_texto('pago_extraordinario','pago_extraordinario',$info);?>' />
                        
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>Cuota por Reinscripción</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input type='text' name='cuota_reinscripcion' class='money' value='<?php echo repoblar_texto('cuota_reinscripcion','cuota_reinscripcion',$info);?>' />
                        
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>Adeudo con la Universidad</td>
                <td>
                    <div class="input-prepend">
                        <span class="add-on">$</span>
                        <input class='money' type='text' name='adeudo_universidad' value='<?php echo repoblar_texto('adeudo_universidad','adeudo_universidad',$info);?>' />
                        
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>Periodo de Disposición (Meses)</td>
                <td><input class='numerico' type='text' name='periodo_disposicion' value='<?php echo repoblar_texto('periodo_disposicion','periodo_disposicion',$info);?>' /></td>
            </tr>
            <tr>
                <td>Fecha de Suscripción</td>
                <td><input id='fecha1' type='text' name='fecha_suscripcion' value='<?php echo (repoblar_texto('fecha_suscripcion','fecha_suscripcion',$info));?>' /></td>
            </tr>
            <tr>
                <td>Fecha de Primer Pago</td>
                <td><?php echo (repoblar_texto('nono','fecha_primer_pago',$info));?></td>
            </tr>
            <tr>
                <td>Fecha de Vencimiento</td>
                <td><?php echo (repoblar_texto('nono','fecha_vencimiento',$info));?></td>
            </tr>
            <tr>
                <td>Tasa Fija</td>
                <td>
                    <div class="input-append">
                        <input class='numerico input-mini' type='text' name='tasa_fija' value='<?php echo repoblar_texto('tasa_fija','tasa_fija',$info);?>' />
                        <span class="add-on">%</span>


                    </div>
                </td>
            </tr>
            <tr>
                <td>Tasa Moratoria</td>
                <td>
                    <div class="input-append">
                        <input class='numerico input-mini' type='text' name='tasa_moratoria' value='<?php echo repoblar_texto('tasa_moratoria','tasa_moratoria',$info);?>' />
                        <span class="add-on">%</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Nombre Razón Social Universidad</td>
                <td><?php echo $universidad;?></td>
            </tr>
            <tr>
                <td>Convenio CIE</td>
                <td><?php echo obtener_campo('convenio_cie.universidad', 'iduniversidad.'.$expediente['universidad_iduniversidad']);?></td>
            </tr>
            <tr>
                <td>Número de Referencia</td>
                <td>
                    <?php echo $expediente['matricula'];?>
                    
                    <input id='referencia' type='hidden' name='numero_referencia' value='<?php echo $expediente['matricula'];?>' />
                </td>
            </tr>
            <tr>
                <td>Dígito Verificador</td>
                <td>
                    <span id='digito_span'></span>
                    <input id='digito' class='input-small' type='hidden' name='digito_verificador' value='' />
                </td>
            </tr>
            <tr>
                <td>Socio-Económico</td>
                <td><?php echo obtener_campo('ciclo.ciclo', 'idciclo.'.$expediente['ciclo_idciclo']);?></td>
            </tr>
            <!--
            <tr>
                <td>Comisión por Disposición</td>
                <td><input class='numerico' type='text' name='comision_disposicion' value='<?php echo repoblar_texto('comision_disposicion','comision_disposicion',$info);?>' /></td>
            </tr>
            -->
            <tr>
                <td>Comentarios</td>
                <td><textarea style='height:200px; width:95%;' name='comentario'><?php echo repoblar_texto('comentario','comentario',$info);?></textarea></td>
            </tr>
            
        </table>
        <div class='pull-right'>
            
            <?php
            if($test == TRUE ){?>
            Terminado
            
            <input type='checkbox' name='enviar_mesa' value='1' <?php echo repoblar_radio('enviar_mesa','1',$mesa);?> />
            <input type='submit' value='Guardar' class='btn btn-success' />
            <?php
            }
            ?>
            
        </div>
        <?php
        if(isset($informacion['contrato']['idcontrato'])){?>
        <div class='btn-group pull-left'>
            <!--<a href="#myModal" role="button" class="btn" data-toggle="modal">Subir Tabla de Pagos</a>-->
            <!--<a href="<?php //echo site_url('contrato/tabla_pagos/'.$expediente['idexpediente']);?>" class="btn" target='_blank' >Ver Tabla de Pagos</a>-->
            <a href="<?php echo site_url('contrato/caratula/'.$expediente['idexpediente']);?>" class="btn" target='_blank'>Ver Carátula</a>
            <a href="<?php echo site_url('contrato/pdf/');?>" class="btn" target='_blank'>Ver Contrato</a>
        </div>
        <?php
        }
        ?>
        <div class='clearfix'></div>
        <?php echo ($test == TRUE) ? form_close() : '';?>
    </div>
    
    
    <div id="pagare" class="tab-pane <?php echo ($pestania == 'pagare-li') ? 'active' : ''; ?>">
        
        <?php
        if(isset($informacion['pagare']['numero'])){?>
            <a id="pagare-prev" data-id="<?php echo $informacion['pagare']['numero'] - 1;?>" href="#N" data-id="<?php echo $informacion['pagare']['numero'];?>" class="pull-left btn-link <?php echo ($informacion['pagare']['numero'] > 1) ? '' : 'hide';?>"><i class='icon icon-angle-left'></i> Anterior</a>
            <a id="pagare-next" data-id="<?php echo $informacion['pagare']['numero'];?>" href="#N" class="pull-right btn-link">
                <?php echo ($informacion['pagare']['numero'] == $informacion['max_pagare']) ? 'Agregar Pagaré <i class="icon icon-plus"></i>' : 'Siguiente <i class="icon icon-angel-right"></i>';?>
            </a>
        <?php
        }
        ?>
        <div class='clearfix'></div>
        <br />
        <div id="pagare-div" class="centrado8">
            <div style='height:100px;'></div>
            
        </div>
    </div>
    
    <div id="cartas" class="tab-pane">
        
        <div class='pull-left span12'>
            <a target='_blank' href='<?php echo site_url('carta/bienvenida/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text icon-2x'></i>&nbsp;Carta de Bienvenida</a>
        </div>
        <div class='pull-left span12'>
            <a target='_blank' href='<?php echo base_url('uploads/contrato/consentimiento.pdf');?>' class='btn btn-link'><i class='icon icon-file-text icon-2x'></i>&nbsp;Seguro de Vida</a>
        </div>
        <div class='pull-left span12'>
            <a target='_blank' href='<?php echo site_url('carta/cobranza/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text icon-2x'></i>&nbsp;Carta de Cobranza</a>
        </div>
        <div class='pull-left span12'>
            <a target='_blank' href='<?php echo site_url('carta/liberacion/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text icon-2x'></i>&nbsp;Carta de Liberación</a>
        </div>
        
        
    </div>
    
    
</div>

<div class='clearfix'></div>




<script type="text/javascript">
    
    function cief(mat){
        var cadenas;
        var mod;
        var longitud;
        var con;
        var suma;
        var suba;
        var lon2;
        //cadenas = document.forma.referencia.value;
        cadenas = mat;
        //alert(cadenas);
        longitud = cadenas.length;
        mod = longitud % 2;
        //alert(mod);
        if(mod==0){
            cadenas = '0'+cadenas;
            longitud = cadenas.length;
        }
        con = 0;
        suma = 0;
        for(i=0;i<longitud;i++)
        {
            suba=cadenas.substr(i,1);
            if(con==0){
                mul=2;
                con++;
            }else{
                mul=1;
                con=0;
            }
            valor = suba * mul;
            qwe = valor;
            lon = String(qwe).length;
            if(lon>1){
                mast = 0;
            for(j=0;j<lon;j++){
                valor = String(valor);
                mas=valor.substr(j,1);
                mast = parseInt(mast) + parseInt(mas);
            }
                valor = mast ;
            }
            valor = parseInt(valor);
            suma = suma + valor;
        }
        //alert(suma);
        asd = String(suma);
        lon2 = asd.length;
        lon2 = lon2 - 1;
        unidad = asd.substr(lon2,1);
        if(unidad>0){
            decena = 10 - unidad;
        }else{
            decena = 0;
        }
        decena_superior = suma + decena ;
        digito = decena_superior - suma;
        //alert(suma);
        //document.forma.digito.value = digito;
        //alert(digito);

        return digito;
    }
    
    function convertir(letra){
    switch (letra)
    {
    case "A":
    {
    cantidad = 1;
    break;
    }
    case "B":
    {
    cantidad = 2;
    break;
    }
    case "C":
    {
    cantidad = 3;
    break;
    }
    case "D":
    {
    cantidad = 4;
    break;
    }
    case "E":
    {
    cantidad = 5;
    break;
    }
    case "F":
    {
    cantidad = 6;
    break;
    }
    case "G":
    {
    cantidad = 7;
    break;
    }
    case "H":
    {
    cantidad = 8;
    break;
    }
    case "I":
    {
    cantidad = 9;
    break;
    }
    case "J":
    {
    cantidad = 1;
    break;
    }
    case "K":
    {
    cantidad = 2;
    break;
    }
    case "L":
    {
    cantidad = 3;
    break;
    }
    case "M":
    {
    cantidad = 4;
    break;
    }
    case "N":
    {
    cantidad = 5;
    break;
    }
    case "O":
    {
    cantidad = 6;
    break;
    }
    case "P":
    {
    cantidad = 7;
    break;
    }
    case "Q":
    {
    cantidad = 8;
    break;
    }
    case "R":
    {
    cantidad = 9;
    break;
    }
    case "S":
    {
    cantidad = 1;
    break;
    }
    case "T":
    {
    cantidad = 2;
    break;
    }
    case "U":
    {
    cantidad = 3;
    break;
    }
    case "V":
    {
    cantidad = 4;
    break;
    }
    case "W":
    {
    cantidad = 5;
    break;
    }
    case "X":
    {
    cantidad = 6;
    break;
    }
    case "Y":
    {
    cantidad = 7;
    break;
    }
    case "Z":
    {
    cantidad = 8;
    break;
    }
    default:
    {
    cantidad = letra;
    break;
    }
    }
    return cantidad;
    } 
    function cief2(mat){
    var cadenas,mod,longitud,con,suma,suba,suba2,lon2;
    var i,mul,valor,qwe,lon,mast,j,mas,asd,unidad,decena;
    var decena_superior,digito;
    //cadenas = document.forma.referencia.value;
    //cadenas = '04429510A';
    /*alert(cadenas);*/
    cadenas = mat;
    longitud = cadenas.length;
    mod = longitud % 2;
    //alert(mod);
    if(mod==0){
        cadenas = '0'+cadenas;
        longitud = cadenas.length;
    }
    con = 0;
    suma = 0;
    for(i=0;i<longitud;i++)
    {
        if(con==0){
            mul=2;
            con++;
        }else{
            mul=1;
            con=0;
        }
        
        suba=cadenas.substr(i,1);
        suba2=convertir(suba);
        valor = suba2 * mul;
        qwe = valor;
        lon = String(qwe).length;
        if(lon>1){
            mast = 0;
            for(j=0;j<lon;j++){
                valor = String(valor);
                mas=valor.substr(j,1);
                mast = parseInt(mast) + parseInt(mas);
            }
            valor = mast ;
        }
        valor = parseInt(valor);
        suma = suma + valor;
    }
    //alert(suma);
    asd = String(suma);
    lon2 = asd.length;
    lon2 = lon2 - 1;
    unidad = asd.substr(lon2,1);
    if(unidad>0){
        decena = 10 - unidad;
    }else{
        decena = 0;
    }
    decena_superior = suma + decena ;
    digito = decena_superior - suma;
    //alert(suma);
    //document.forma.digito.value = digito;
    //alert(digito);
    
    return digito;
    } 

    $(document).ready(function(){
        var max_pagare = <?php echo $informacion['max_pagare'];?>;
        
        <?php if (isset($informacion['contrato']['idcontrato'])) { ?>    
        $("#pagare-div").load("<?php echo site_url('expediente/pagare/'.$expediente['idexpediente'].'/'.$informacion['max_pagare']);?>");                
        <?php }  ?>  
        $("#referencia").keyup(function(){
            
            var valor = $(this).val();
            //alert('HI');
            var cie;
            if(valor == ''){
                cie = 0;
            }else if(!$.isNumeric(valor)){
                //alert('hi');
                cie = cief2(valor);
            }else{
                cie = cief(valor);
            }
            
            //alert(cie);
            $("#digito").val(cie);
            $("#digito_span").html(cie);
        });
         
        $('#myTab a').click(function (e) {
            
            e.preventDefault();
                      
            $(this).tab('show');         
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        
        
        $("#referencia").keyup();
        
        $("#pagare-next").click(function(){
            var pagare = parseInt($(this).attr('data-id'));
            
            if(pagare == max_pagare){
                $("#pagare-prev").attr('data-id',pagare).removeClass('hide');
                $(this).addClass('hide');
                
                $("#pagare-div").html('<div style="height:100px;">Cargando...</div>').load("<?php echo site_url('expediente/pagare/'.$expediente['idexpediente'].'/0');?>");
            }else{
                alert('desiguales');
            }
        });
        
        $("#pagare-prev").click(function(){
            var pagare = parseInt($(this).attr('data-id'));
            
            if(max_pagare > 1){
                $("#pagare-next").html('Siguiente <i class="icon icon-angle-right"></i>').removeClass('hide');
                $(this).attr('data-id',pagare-1);
                alert(pagare);
                $("#pagare-div").html('<div style="height:100px;">Cargando...</div>').load("<?php echo site_url('expediente/pagare/'.$expediente['idexpediente'].'/');?>/"+pagare);
            }else{
                $("#pagare-next").html('Agregar Pagaré <i class="icon icon-plus"></i>').removeClass('hide');
                $(this).attr('data-id','0').addClass('hide');
            }
        });
        
    });

</script>


 
<?php
}
?>



