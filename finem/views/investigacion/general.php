<?php 
$idexpediente = $expediente['idexpediente'];
$tmp = $this->uri->segment(2);
$imp = $this->config->item('super_admin');
$user = $this->phpsession->get('user','finem');
?>
<h2>Matrícula <?php echo $expediente['matricula']; ?> <em><?php echo obtener_campo('nombre,nombre_dos,apater,amater.alumno', 'idalumno.'.$expediente['alumno_idalumno'],TRUE);?></em></h2>
<h4>Agencia <em><?php echo obtener_campo('nombre.agencia', 'idagencia.'.$expediente['agencia_idagencia']);?></em></h4>


<div class="btn-group pull-left">
    <a class="btn <?php echo ($tmp == 'general') ? 'active' : '';?> btn-success" href="<?php echo site_url('investigacion/general/'.$idexpediente);?>">General</a>
    <a class="btn <?php echo ($tmp == 'personal') ? 'active' : '';?> <?php echo $menu['personal'];?>" href="<?php echo site_url('investigacion/personal/'.$idexpediente);?>">Personal</a>
    <a class="btn <?php echo ($tmp == 'familiar') ? 'active' : '';?> <?php echo $menu['familiar'];?>" href="<?php echo site_url('investigacion/familiar/'.$idexpediente);?>">Familiar</a>
    <a class="btn <?php echo ($tmp == 'padres') ? 'active' : '';?> <?php echo $menu['padre'];?>" href="<?php echo site_url('investigacion/padres/'.$idexpediente);?>">Padres</a>
    <a class="btn <?php echo ($tmp == 'avales') ? 'active' : '';?> <?php echo $menu['aval'];?>" href="<?php echo site_url('investigacion/avales/'.$idexpediente);?>">Avales</a>
    <a class="btn <?php echo ($tmp == 'fotos') ? 'active' : '';?> <?php echo $menu['foto'];?>" href="<?php echo site_url('investigacion/fotos/'.$idexpediente);?>">Fotos</a>
</div>


<?php
if(in_array($user['idusuario'], $imp)){?>

<div class="pull-right">
    <?php
    if($expediente['investigado'] == 'SI'){?>
    <a href='<?php echo site_url('investigacion/reabrir/'.$expediente['idexpediente']);?>' class='btn btn-link' style='float:left;'>Reabrir Investigación</a>
    <?php
    }
    ?>
    <a class="btn" href="<?php echo site_url('investigacion/imprimir/' . $idexpediente); ?>" target='_blank'><i class="icon-print"></i></a>
    &nbsp;
    <button class='redirigir btn' data-url="<?php echo site_url('expediente/ver/solicitud/'.$idexpediente);?>" >Cambiar a Expediente</button>
</div>


<?php
}
?>
<div class='clearfix'></div>
<br />    
    
