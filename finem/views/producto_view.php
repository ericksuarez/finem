<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/btn-group.css" />
<div id="contenido">
    

    <?php if ($seccion == 'lista') { ?>
        <h2>Consulta</h2>
        <?php
        //echo $this->pagination->create_links();
        ?>


        <div class="busqueda">
        </div>
        <table class="table table-bordered table-hover" style="width:700px;" align="center">
            <tr>
                <th>Nombre Producto</th>
                <th>Número Condusef</th>		       
                <th>Descripción</th>
                <th>Editar</th>
                <!--<th>Eliminar</th>-->
            </tr>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['condusef']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td><a class="btn btn-mini" href="<?php echo site_url('producto/ver/' . $producto['idproducto']); ?>"><i class="icon-pencil"></i></a></td>
                    <!--<td><a class="btn btn-mini trash" data-val="<?php echo $producto['idproducto']; ?>" href="#borrar" data-toggle="modal" ><i class="icon-trash"></i></a></td>-->
                </tr>
                <?php
            }
            ?>
        </table>

        <?php echo form_open('producto/borrar'); ?>
        <div id="borrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Borrar Producto</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" value="0" name="id" id="borrar_id"/>
                <p>¿De verdad desea borrar esta producto para siempre?</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <input type="submit" class="btn btn-warning" value="Borrar">
            </div>
        </div>
        <?php echo form_close(); ?>

        <script type="text/javascript">
            $(document).ready(function(){

                $(".trash").click(function() {
                    var idpregunta = $(this).attr("data-val");
                    //alert(idpregunta);
                    $("#borrar_id").val(idpregunta);
                });
                //alert('documento ready');
            });
        </script>

        <?php } elseif ($seccion == 'ver') {
        ?>
        <h2>Editar Producto</h2>
        <?php echo form_open(current_url()); ?>
        <input type="hidden" value="<?php echo $producto['idproducto']; ?>" name="id" />
        <table class="table table-bordered table-hover" style="width:500px;" align="center">
            <tr>
                <td width="30%" align="right">Nombre :</td>
                <td><input type="text" value="<?php echo $producto['nombre']; ?>" name="nom" maxlength="15" size="30"></td>
            </tr>
            <tr>
                <td width="30%" align="right">Condusef :</td>
                <td><input type="text" value="<?php echo $producto['condusef']; ?>" name="condu" maxlength="50" size="30"></td>
            </tr>	
            <tr>
                <td width="30%" align="right">Descripción :</td>
                <td><textarea name="descripcion" cols="5"><?php echo $producto['descripcion']; ?></textarea></td>
            </tr>	
            <tr>
                <td colspan="2"><input class="btn btn-success" type="submit" value="Guardar" /></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
        <?php } elseif ($seccion == 'nuevo') {
        ?>
        <h2>Nuevo Producto</h2>
        <?php echo form_open(current_url()); ?>
        <table class="table table-bordered table-hover" style="width:500px;" align="center">
            <tr>
                <td width="30%" align="right">Nombre :</td>
                <td><input type="text" value="<?php echo set_value("nom"); ?>" name="nom" maxlength="15" size="30"></td>
            </tr>
            <tr>
                <td width="30%" align="right">Condusef :</td>
                <td><input type="text" value="<?php echo set_value("condu"); ?>" name="condu" maxlength="50" size="30"></td>
            </tr>	
            <tr>
                <td width="30%" align="right">Descripción :</td>
                <td><textarea name="descripcion" cols="5"><?php echo set_value("descripcion"); ?></textarea></td>
            </tr>	
            <tr>
                <td colspan="2"><input class="btn btn-success" type="submit" value="Guardar" /></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
        <?php } else {
        ?>

        <?php
    }
    ?>

</div>
<?php $this->load->view('common/footer'); ?>