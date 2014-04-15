<?php
$user = $this->phpsession->get('user','finem');
$usuarios = $this->config->item('super_admin');?>
<div class="navbar navbar-static-top">
                    <div class="navbar-inner">
                        <a class="brand" href="#">Bienvenido <?php echo $user['nombre'] . ' ' . $user['apellidop']; ?></a>
                        <ul class="nav" role="navigation">
                            <?php
                            if(in_array($user['idusuario'], $usuarios)){?>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="drop1">Administracion <b class="caret"></b></a>
                                <ul aria-labelledby="drop1" role="menu" class="dropdown-menu">
                                        <!--<li><a href="<?php echo site_url('usuario/nuevo'); ?>" tabindex="-1">Alta de Usuarios</a></li>
                                        <li><a href="<?php echo site_url('usuario/lista'); ?>" tabindex="-1">Lista de Usuarios</a></li>-->
                                    <li class="divider"></li>
                                    <li><a href="<?php echo site_url('universidad/nuevo/'); ?>" tabindex="-1">Alta de Universidades</a></li>
                                    <li><a href="<?php echo site_url('universidad/lista'); ?>" tabindex="-1">Lista de Universidades</a></li>
                                    <li><a href="<?php echo site_url('campus/nuevo'); ?>" tabindex="-1">Alta de Campus</a></li>
                                    <li><a href="<?php echo site_url('campus/lista'); ?>" tabindex="-1">Lista de Campus</a></li>
                                    <li><a href="<?php echo site_url('carrera/alta'); ?>" tabindex="-1">Alta de Carreras</a></li>
                                    <li><a href="<?php echo site_url('carrera/lista'); ?>" tabindex="-1">Lista de Carreras</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo site_url('ciclo/nuevo'); ?>" tabindex="-1">Alta de Ciclos</a></li>
                                    <li><a href="<?php echo site_url('ciclo/lista'); ?>" tabindex="-1">Lista de Ciclos</a></li>
                                    <li class="divider"></li>
                                    <!--<li><a href="<?php echo site_url('producto/nuevo'); ?>" tabindex="-1">Alta de Productos</a></li>-->
                                    <li><a href="<?php echo site_url('producto/lista'); ?>" tabindex="-1">Lista de Productos</a></li>
                                    <li class="divider"></li>
                                    <li><a href='<?php echo site_url('layout/cobranza');?>' tabindex='-1'>Actualizar Cobranza</a></li>
                                </ul>
                            </li>
                            <?php
                            }?>
                            <?php
                            if($user['permiso_idpermiso'] != 5 && $user['permiso_idpermiso'] != 6 && $user['permiso_idpermiso'] != 10){?>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="drop2">Expedientes <b class="caret"></b></a>
                                <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo site_url('expediente/lista'); ?>" tabindex="-1">Lista de Expedientes</a></li>
                                    <li><a href="<?php echo site_url('expediente/nuevo'); ?>" tabindex="-1">Nuevo Expediente</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="drop2">Reportes <b class="caret"></b></a>
                                <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo site_url('reporte/contrato'); ?>" tabindex="-1">Contrato</a></li>
                                    <li><a href="<?php echo site_url('reporte/mesa'); ?>" tabindex="-1">Mesa</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="drop2">Layouts <b class="caret"></b></a>
                                <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo site_url('layout/cobranza'); ?>" tabindex="-1">Cobranza</a></li>
                                </ul>
                            </li>
                            <?php
                            }
                            ?>
                            <li><a href="http://finemsist.com/finem/reentrar.php?l=<?php echo $user['login'];?>&p=<?php echo $user['clave'];?>">Producto Anterior</a></li>
                        </ul>
                        <ul class='nav pull-right'>
                            <li><a href="<?php echo site_url('login/salir'); ?>">Salir</a></li>
                        </ul>
                    </div>
                </div>