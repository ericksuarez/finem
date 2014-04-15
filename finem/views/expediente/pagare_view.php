<?php
$terminado = $pagare['terminado'];
$user = $this->phpsession->get('user', 'finem');
$usuarios = $this->config->item('super_admin');
$test = FALSE;
$producto = obtener_campo('nombre.producto', 'idproducto.' . $expediente['producto_idproducto']);
$universidad = obtener_campo('razon_social.universidad', 'iduniversidad.' . $expediente['universidad_iduniversidad']);
if ((in_array($user['idusuario'], $usuarios) && ($terminado == 'si') ) || ($terminado == 'no') || (empty($terminado))) {
    $test = TRUE;
    //echo 'SOME----';
}
$post = $this->phpsession->flashget('post');
//print_r($post);
if($post['numero'] == $pagare['numero']){?>
<div class='alert alert-warning'>
    <p>Si usted no completa la información de este pagaré se perderá por completo.</p>
</div>
    
<?php
}
?>
<?php echo ($test == FALSE) ? '' : form_open(site_url('expediente/ver/disposicion/' . $expediente['idexpediente']), array('id' => 'editar-form')); ?>

<input type='hidden' name='pestania' value="pagare-li" />
<input type='hidden' name='numero' value="<?php echo $pagare['numero']; ?>" />
<input type='hidden' name='id' value="<?php echo $expediente['idexpediente']; ?>" />

<?php
if(empty($pagare) || $pagare['numero'] == 1){?>
<input type='hidden' name='fecha_suscripcion' value='<?php echo $contrato['fecha_suscripcion'];?>' />
<input type='hidden' name='formhid' value='pagare_rules' />

<table class="table table-bordered table-hover">
    <tr>
        <th colspan="2">Pagaré <?php echo $pagare['numero']; ?></th>
    </tr>
    <tr>
        <td style="width:20%;">Importe</td>
        <td>$<?php echo number_format($contrato['primer_disposicion'], 2); ?></td>
    </tr>
    <tr>
        <td>Adeudo con Universidad</td>
        <td>$<?php echo number_format($contrato['adeudo_universidad'], 2); ?></td>
    </tr>
    <tr>
        <td>Esquema del Crédito</td>
        <td><?php echo $producto; ?></td>
    </tr>
    <tr>
        <td>Plazo</td>
        <td>
            <?php
            $tmp = $pagare['plazo'];
            $tmp_a['plazo'] = (empty($tmp)) ? $post['plazo'] : $tmp;
            ?>
            <input type='text' name='plazo' value='<?php echo (repoblar_texto('plazo', 'plazo', $tmp_a)); ?>' class='input-mini' /> 
        </td>
    </tr>
    <tr>
        <td>Tasa</td>
        <td><?php echo $contrato['tasa_fija']; ?>%</td>
    </tr>
    <tr>
        <td>Universidad</td>
        <td><?php echo $universidad; ?></td>
    </tr>
    <tr>
        <td>Lugar de Suscripción</td>
        <td><?php echo $contrato['lugar_firma']; ?></td>
    </tr>
    <tr>
        <td>Fecha de Suscripción</td>
        <td><?php echo fecha_contrato($contrato['fecha_suscripcion']); ?></td>
    </tr>
    <tr>
        <td>Fecha de Primer Pago</td>
        <td><?php echo fecha_contrato($contrato['fecha_primer_pago']); ?></td>
    </tr>
    <tr>
        <td>Fecha de Vencimiento</td>
        <td><?php echo fecha_contrato($pagare['fecha_vencimiento']); ?></td>
    </tr>
</table>

<div class='pull-right'>
    <?php if ($test == TRUE) { 
        $terminado = isset($post['terminado']) ? $post['terminado'] : $terminado;?>
        Terminado <input type='checkbox' name='terminado' value='si' <?php echo repoblar_radio('terminado', 'si', $terminado); ?> />
        <!--<input type='submit' class='btn btn-success' value='Guardar' />-->
        <?php
    }
    ?>

</div>
<div class='clearfix'></div>
<input type='hidden' value='<?php echo $max_pagare; ?>' name='max' />


<?php
}else{?>
<input type='hidden' name='formhid' value='pagare2_rules' />
<table class="table table-bordered table-hover">
    <tr>
        <th colspan="2">Pagaré <?php echo $pagare['numero']; ?></th>
    </tr>
    <tr>
        <td style="width:20%;">Importe</td>
        <td>
            <?php
            $tmp = (isset($post['importe'])) ? $post['importe'] : $pagare['importe'];
            $tmp_a['importe'] = (empty($tmp)) ? '' : $tmp;
            ?>
            <input id='importe' type='text' name='importe' value='<?php echo (repoblar_texto('importe', 'importe', $tmp_a)); ?>' class='moneyx'/>
        </td>
    </tr>
    <tr>
        <td>Saldo Insoluto</td>
        <td>
            <?php
            $tmp = (isset($pagare['adeudo']) && !empty($pagare['adeudo'])) ? $pagare['adeudo'] :  $disposicion['saldo_insoluto'];
            $tmp_a['adeudo'] = (empty($tmp)) ? 0.00 : $tmp;
            echo '$'.number_format($tmp_a['adeudo'],2);
            ?>
            <input id='saldo_insoluto' type='hidden' name='adeudo' value='<?php echo (repoblar_texto('adeudo', 'adeudo', $tmp_a)); ?>' class='moneyx'/>
        </td>
    </tr>
    <tr>
        <td>Importe del Pagaré</td>
        <td>
            <?php
            $tmp = (isset($pagare['importe_pagare']) && !empty($pagare['importe_pagare'])) ? $pagare['importe_pagare'] :  0.00;
            $tmp_a['importe_pagare'] = $tmp;
            ?>
            $<span id='importe_pagare'><?php echo (isset($post['importe_pagare'])) ? $post['importe_pagare'] : number_format($tmp_a['importe_pagare'],2);?></span>
            <input id='importe_pagare-hidden' type='hidden' name='importe_pagare' value='<?php echo (isset($post['importe_pagare'])) ? $post['importe_pagare'] : number_format($tmp_a['importe_pagare'],2);?>' class='moneyx'/>
        </td>
    </tr>
    <tr>
        <td>Esquema del Crédito</td>
        <td><?php echo $producto; ?></td>
    </tr>
    <tr>
        <td>Plazo</td>
        <td>
            <?php
            $tmp = (isset($post['plazo'])) ? $post['plazo'] : $pagare['plazo'];
            $tmp_a['plazo'] = (empty($tmp)) ? 0 : $tmp;
            echo $tmp_a['plazo'];
            ?>
            <input type='hidden' name='plazo' value='<?php echo (repoblar_texto('plazo', 'plazo', $tmp_a)); ?>' class='input-mini' /> 
        </td>
    </tr>
    <tr>
        <td>Tasa</td>
        <td><?php echo $contrato['tasa_fija']; ?>%</td>
    </tr>
    <tr>
        <td>Universidad</td>
        <td><?php echo $universidad; ?></td>
    </tr>
    <tr>
        <td>Lugar de Suscripción</td>
        <td><?php echo $contrato['lugar_firma']; ?></td>
    </tr>
    <tr>
        <td>Fecha de Suscripción</td>
        <td>
            <?php
            $tmp = (isset($post['fecha_suscripcion'])) ? $post['fecha_suscripcion'] : $pagare['fecha_suscripcion'];
            $tmp_a['fecha_suscripcion'] = (empty($tmp)) ? '' : $tmp;
            ?>
            <input type='text' name='fecha_suscripcion' value='<?php echo (repoblar_texto('fecha_suscripcion', 'fecha_suscripcion', $tmp_a)); ?>' />
        </td>
    </tr>
    <tr>
        <td>Fecha de Primer Pago</td>
        <td><?php echo fecha_contrato($pagare['fecha_primer_pago']); ?></td>
    </tr>
    <tr>
        <td>Fecha de Vencimiento</td>
        <td><?php echo fecha_contrato($pagare['fecha_vencimiento']); ?></td>
    </tr>
</table>



<!--<div class='pull-left'>
    <a href="<?php echo site_url('contrato/pagare/' . $expediente['idexpediente']); ?>" class="btn" target='_blank'>Ver Pagaré</a>
</div>-->
<div class='pull-right'>
    <?php if ($test == TRUE) { 
        $terminado = isset($post['terminado']) ? $post['terminado'] : $terminado;?>
        Terminado <input type='checkbox' name='terminado' value='si' <?php echo repoblar_radio('terminado', 'si', $terminado); ?> />
        <!--<input type='submit' class='btn btn-success' value='Guardar' />-->
        <?php
    }
    ?>

</div>
<div class='clearfix'></div>
<input type='hidden' value='<?php echo $max_pagare; ?>' name='max' />

<?php } ?>

<?php echo ($test == FALSE ) ? '' : form_close(); ?>
<script type='text/javascript' src='<?php echo base_url('js/currencyFormat.js');?>'></script>
<script type="text/javascript">
            $(document).ready(function() {
                //alert('documento ready 1');
                $(".moneyx").autoNumeric({aSep: ',', aDec: '.'});
                $('#importe').keypress(function(){
                    var importe = parseFloat($(this).val().replace(/,/g,""));
                    var saldo = parseFloat($("#saldo_insoluto").val().replace(/,/g,""));
                    var resultado = number_format(importe + saldo,2,'.',',');
                    
                    $("#importe_pagare").html(resultado);
                    $("#importe_pagare-hidden").val(resultado);
                });


            });
</script>