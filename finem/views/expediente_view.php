<?php $this->load->view('common/header'); 
$imp = $this->config->item('super_admin');
$user = $this->phpsession->get('user','finem');
?>

<div id="contenido" >





    

        <h2>Matrícula <?php echo $expediente['matricula']; ?> <em><?php echo obtener_campo('nombre,nombre_dos,apater,amater.alumno', 'idalumno.'.$expediente['alumno_idalumno'],TRUE);?></em></h2>
        <?php
        if (!empty($informacion['creacion'])) {
            $l = $informacion['creacion'][0];
            ?>
            <h4>Creado por <?php echo $l['nombre'] . ' ' . $l['apellidop'] . ' ' . $l['apellidom']; ?> el día <?php echo date('d-m-Y', strtotime($l['fecha'])); ?> a las <?php echo date('H:i:s', strtotime($l['fecha'])); ?></h4>
            <?php
        }
        ?>
        <div>

            <div class="btn-group pull-left">

                <a href="<?php echo site_url('expediente/ver/solicitud/' . $expediente['idexpediente']); ?>" class="btn <?php echo ($accion == 'solicitud') ? 'active' : ''; ?> btn-warning">Solicitud</a>

               
                <a href="<?php echo site_url('expediente/ver/buro/' . $expediente['idexpediente']); ?>" class="btn <?php echo ($accion == 'buro') ? 'active' : ''; ?> <?php echo $menu['buro'];?>">Buró</a>
                
                <a href="<?php echo site_url('expediente/ver/analisis/'.$expediente['idexpediente']);?>" class="btn <?php echo ($accion == 'analisis') ? 'active' : ''; ?> <?php echo $menu['analisis'];?>">Análisis</a>

                <a href="<?php echo site_url('expediente/ver/contrato/'.$expediente['idexpediente']);?>" class="btn <?php echo ($accion == 'contrato') ? 'active' : ''; ?> <?php echo $menu['contrato'];?>">Formalización</a>
                
                <a href="<?php echo site_url('expediente/ver/disposicion/'.$expediente['idexpediente']);?>" class="btn <?php echo ($accion == 'disposicion') ? 'active' : ''; ?> <?php echo $menu['disposicion'];?>">Disposiciones</a>
                <!--
                <a href="#N" class="btn <?php echo ($accion == 'mesa') ? 'active' : ''; ?>">Mesa de Control</a>

                <a href="#N" class="btn <?php echo ($accion == 'renovacion') ? 'active' : ''; ?>">Renovación</a>
                -->
            </div>
            
            <?php
            if(in_array($user['idusuario'], $imp)){?>
            <button class='redirigir btn pull-right' data-url="<?php echo site_url('investigacion/personal/'.$expediente['idexpediente']);?>" >Cambiar a Investigación</button>
            
            <?php
            }
            ?>
            
            
            <div class='clearfix'></div>

    

            <div id="contenido_exp">
                <br />
                <a class='btn btn-small' href='<?php echo site_url('expediente/lista');?>?<?php echo $_SERVER['QUERY_STRING']; ?>'><i class='icon icon-list-alt'></i>&nbsp; Regresar a Lista</a>
                <?php $this->load->view('expediente/' . $accion . '_view'); ?>

            </div>

            

            <?php if (!empty($informacion['log'])) { ?>
                <div clasS='log'>
                    <?php foreach ($informacion['log'] as $l) { ?>
                        <div class='span12'>Última Actualización hecha por <?php echo $l['nombre'] . ' ' . $l['apellidop'] . ' ' . $l['apellidom']; ?> el día <?php echo date('d-m-Y', strtotime($l['fecha'])); ?> a las <?php echo date('H:i:s', strtotime($l['fecha'])); ?></div>
                        <div class='clearfix'></div>
                        <?php
                    }
                    ?>
                </div>

                <?php
            }
            ?>



        </div>

        <div class="clearfix"></div>

    



</div>

<?php $this->load->view('common/footer'); ?>