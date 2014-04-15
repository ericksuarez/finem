<?php $this->load->view('common/header'); 
$errors = $this->phpsession->flashget('errors');
$coord_aval = unserialize($info['coord2']);
$coord_acre = unserialize($info['coord1']);
?>

<div id="contenido" >
    <?php $this->load->view('investigacion/general'); ?>
    <div id="print-zone">
    <?php echo ($expediente['investigado'] == 'NO') ? form_open_multipart(current_url(), array('class' => 'form-horizontal')) : ''; ?>
    <table class='table'>
        <tr>
            <td style='width:50%;'>
                <?php
                if(isset($errors['img1'])){?>
                <div class='alert alert-warning'><?php echo $errors['img1'];?></div>
                <?php
                }
                ?>
                <strong>Imágen 1</strong><br />
                <input type='file' name='img1' /><br />
                <textarea name='descrip1' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip1', 'des1', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto1'])){
                    $ruta = ($info['foto1'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto1']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img2'])){?>
                <div class='alert alert-warning'><?php echo $errors['img2'];?></div>
                <?php
                }
                ?>
                <strong>Imágen 2</strong><br />
                <input type='file' name='img2' /><br />
                <textarea name='descrip2' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip2', 'des2', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto2'])){
                    $ruta = ($info['foto2'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto2']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img3'])){?>
                <div class='alert alert-warning'><?php echo $errors['img3'];?></div>
                <?php
                }
                ?>
                <strong>Imágen 3</strong><br />
                <input type='file' name='img3' /><br />
                <textarea name='descrip3' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip3', 'des3', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto3'])){
                    $ruta = ($info['foto3'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto3']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img4'])){?>
                <div class='alert alert-warning'><?php echo $errors['img4'];?></div>
                <?php
                }
                ?>
                <strong>Imágen 4</strong><br />
                <input type='file' name='img4' /><br />
                <textarea name='descrip4' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip4', 'des4', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto4'])){
                    $ruta = ($info['foto4'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto4']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img5'])){?>
                <div class='alert alert-warning'><?php echo $errors['img5'];?></div>
                <?php
                }
                ?>
                <strong>Imágen 5</strong><br />
                <input type='file' name='img5' /><br />
                <textarea name='descrip5' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip5', 'des5', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto5'])){
                    $ruta = ($info['foto5'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto5']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img6'])){?>
                <div class='alert alert-warning'><?php echo $errors['img6'];?></div>
                <?php
                }
                ?>
                <strong>Mapa Acreditado</strong><br />
                <input type='file' name='img6' /><br />
                <textarea name='descrip6' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip6', 'des6', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto6'])){
                    $ruta = ($info['foto6'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto6']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
            <!--<td>
                <strong>Mapa Acreditado</strong><br />
                <textarea name='mapa1' placeholder ='Mapa' style='width: 95%; height: 100px;'></textarea>
            </td>
            <td><?php //html_entity_decode($info['mapa_acreditado']);?>
                <?php echo (is_array($coord_acre)) ? mapaGoogleStatic($coord_acre) : '';?></td>-->
        </tr>
        <tr>
            <td>
                <?php
                if(isset($errors['img7'])){?>
                <div class='alert alert-warning'><?php echo $errors['img7'];?></div>
                <?php
                }
                ?>
                <strong>Mapa Aval</strong><br />
                <input type='file' name='img7' /><br />
                <textarea name='descrip7' placeholder ='descripcion' style='width: 95%; height: 50px;'><?php echo repoblar_texto('descrip7', 'des7', $info);?></textarea>
            </td>
            <td>
                <?php
                if(isset($info['foto7'])){
                    $ruta = ($info['foto7'] == 'sin_imagen.jpg') ? base_url('images/sin_imagen.jpg') : base_url('uploads/investigacion/'.$expediente['idexpediente'].'/'.$info['foto7']);?>
                <img src='<?php echo $ruta;?>' class='img-polaroid inv-img' />
                <?php
                }
                ?>
            </td>
            <!--
            <td>
                <strong>Mapa Aval</strong><br />
                <textarea name='mapa2' placeholder ='Mapa' style='width: 95%; height: 100px;'></textarea>
            </td>
            <td>
                <?php //echo (isset($info['mapa_aval'])) ? html_entity_decode($info['mapa_aval']) : '';?>
                <?php echo (is_array($coord_aval)) ? mapaGoogleStatic($coord_aval) : '';?>
            </td>
            -->
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
        <button type='button' name="imprimible" class="btn btn-default" onClick="window.print();">Version Imprimible</button>
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
