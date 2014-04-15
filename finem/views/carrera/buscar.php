<?php if (!empty($carreras)) { ?>
<div class='pull-left'><?php echo  $this->pagination->create_links();?></div>
<div class='pull-right pagination'>Se han encontrado <?php echo $total;?> resultados.</div>
<div class='clearfix'></div>
<table class='table table-bordered table-hover table-condensed'>
    <theader>
        <tr>
            <th>Universidad</th>
            <th>Campus</th>
            <th>Carrera</th>
            <th>Periodo</th>
            <th>Duración</th>
            <th>Costo Periodo</th>
            <th>Total Periodo</th>
            <th>Ingreso Periodo</th>
            <th>Editar|Eliminar</th>
        </tr>
    </theader>
    <tbody>
        <?php foreach($carreras as $c){?>
        <tr>
            <td><?php echo $c['uni'];?></td>
            <td><?php echo $c['campus'];?></td>
            <td><?php echo $c['titulo'];?></td>
            <td><?php echo ucfirst($c['marca_plan']);?></td>
            <?php $duration = ($c['marca_plan'] == 'semestral') ? $c['semestres'] : (($c['marca_plan'] == 'cuatrimestral') ? $c['cuatrimestres'] : $c['trimestres']); ?>
            <td><?php echo $duration;?></td>
            <td><?php echo '$'.number_format($c['costo_semestral'],2);?></td>
            <td><?php echo '$'.number_format($c['costo_total'],2);?></td>
            <td><?php echo '$'.number_format($c['ingresoFE'],2);?></td>
            <td>
                <div class='btn-group'>
                    <a href="<?php echo site_url('carrera/editar/'.$c['idcarrera']);?>" clasS='btn btn-small btn-info'><i class='icon icon-edit'></i></a>
                    <a href="#myModal" role="button" data-toggle="modal" clasS='btn btn-small btn-danger borrar' data-id='<?php echo $c['idcarrera'];?>' data-info='<?php echo $c['titulo'].' de '.$c['uni'];?>'><i class='icon icon-trash'></i></a>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php } else { 
        $data['mensaje'] = ($error_total == TRUE) ? 'Por favor de clic en el botón de corregir búsqueda.' : 'No se ha encontrado ningún resultado para tu búsqueda.';
        //$data['mensaje'] = 'No se ha encontrado ningún resultado para tu búsqueda.';
        $this->load->view('errors/error_custom',$data);
    }
?>

