<?php $this->load->view('common/header');?>

<div id="contenido" >
    <?php $this->load->view('investigacion/general'); ?>
    <table class='table table-bordered table-hover'>
        <tr>
            <td style="width:20%;"><strong>Nombre del Solicitante</strong></td>
            <td><?php echo $info['nombre_alumno'];?></td>
            <td style="width:20%;"><strong>Matrícula</strong></td>
            <td><?php echo $info['matricula'];?></td>
        </tr>
        <tr>
            <td><strong>Producto y Ciclo</strong></td>
            <td><?php echo $info['producto'].' | '.$info['ciclo'];?></td>
            <td><strong>Campus</strong></td>
            <td><?php echo $info['campus'];?></td>
        </tr>
        <tr>
            <td><strong>Nombre de Aval 1</strong></td>
            <td><?php echo $info['nombre_aval1'];?></td>
            <td><strong>Nombre de Aval Dos</strong></td>
            <td><?php echo $info['nombre_aval2'];?></td>
        </tr>
        <tr>
            <td colspan='4'>
                <strong>Carrera</strong>
                &nbsp;
                <?php echo $info['nombre_carrera'];?>
            </td>
        </tr>
        <tr>
            <td><strong>Nuevo Ingreso</strong></td>
            <td><?php echo $info['nuevo_ingreso'];?></td>
            <td><strong>Preiodo Escolar a Cursar</strong></td>
            <td><?php echo $info['ciclo'];?></td>
        </tr>
        <tr>
            <td><strong>Financiamiento Solicitado</strong></td>
            <td><?php echo $info['financiamiento'];?></td>
            <td><strong>Se identificó con</strong></td>
            <td><?php echo $info['identificacion'];?></td>
        </tr>
    </table>
    
</div>

<?php $this->load->view('common/footer'); ?>
