<?php $this->load->view('common/header'); 
$imp = $this->config->item('super_admin');
$user = $this->phpsession->get('user','finem');
?>
<br />
<br />
<div id="contenido" >
    <h2>Actualización de Cobranza.</h2>
    <div class='pull-left' style='width:45%;'>
        <p>El formato aceptado es CSV (COMMA SEPARATED VALUES).</p>
        <?php echo form_open_multipart(current_url());?>
        <input type='file' name='cobranza' />
        <input type='submit' value='Subir' class='btn btn-success'/>
        <br />
        <br />
        <?php
        if($user['permiso_idpermiso'] == 10 || in_array($user['idusuario'],$imp)){?>
        <p class='text-warning'>En caso de Saldos Insolutos especificar también: </p>
        Fecha de Actualización: <input type='text' value='<?php echo set_value('fecha_dos');?>' name='fecha_dos' />
        <?php
        }else{
            echo '<input type="hidden" value="" name="fecha_dos"/>';
        }
        ?>
        <?php echo form_close();?>
        
    </div>
    <div class='pull-right' style='width:45%;'>
        Tipo:
        <select id='encabezados'>
        <?php
        if($user['permiso_idpermiso'] == 6){?>
            <option value='adeudo'>Adeudos y Calificación</option>
        <?php
        }elseif($user['permiso_idpermiso'] == 10){?>
            <option value='insoluto'>Saldo Insoluto</option>
        <?php
        }else{?>
            <option value='all'>Completo</option>
            <option value='restante'>Líneas Restantes</option>
            <option value='insoluto'>Saldo Insoluto</option>
            <option value='adeudo'>Adeudos y Calificación</option>
        <?php
        }
        ?>
        </select>
            
        
        <button id='template-cobranza' class='btn btn-info'>Descargar Template &nbsp;<i class='icon icon-download'></i></button>
    </div>
    <div class='clearfix'></div>
    <?php
    if(/*in_array($user['idusuario'], $imp)*/TRUE){?>
    <div>
        <a href='<?php echo site_url('expediente/actualizar_linea');?>' class='btn btn-block btn-info'><i class='icon icon-wrench'></i> Actualizar Líneas Restantes</a>
    </div>
    <?php
    }
    ?>


    



</div>
<script type='text/javascript'>
    $(document).ready(function(){
        $("#template-cobranza").click(function(event){
           
            var valor = $("#encabezados").val();
            var href = '<?php echo site_url('layout/template/cobranza/');?>/' + valor;
            
            //$(this).attr('href',href);
            window.location = href;
        });
    });
</script>
<?php $this->load->view('common/footer'); ?>