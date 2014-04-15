<?php $user = $this->phpsession->get('user','finem');?>
<div class="navbar navbar-static-top">
                    <div class="navbar-inner">
                        <a class="brand" href="#">Bienvenido <?php echo $user['nombre'] . ' ' . $user['apellidop']; ?></a>
                        <ul class="nav" role="navigation">
                            
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="drop2">Expedientes <b class="caret"></b></a>
                                <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo site_url('investigacion/lista'); ?>" tabindex="-1">Lista de Expedientes</a></li>
                                </ul>
                            </li>
                            <li><a href="http://finemsist.com/finem/reentrar.php?l=<?php echo $user['login'];?>&p=<?php echo $user['clave'];?>">Producto Anterior</a></li>
                        </ul>
                        <ul class='nav pull-right'>
                            <li><a href="<?php echo site_url('login/salir'); ?>">Salir</a></li>
                        </ul>
                    </div>
                </div>