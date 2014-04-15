<!DOCTYPE html>
<html lang="es">
    <head>
        <title>FINEM Sistema</title>
        <meta charset="utf-8">

        <!-- Hojas de Estilo -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/cupertino/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('style/master.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('js/clippy.js/build/clippy.css'); ?>" />

        <!-- Javascript Librerias -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/autoNumeric-1.7.4.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/konami-js/konami.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/clippy.js/build/clippy.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/easter.js" ></script>

        <script type="text/javascript">
            $(document).ready(function() {
                //alert('documento ready 1');
                $(".numerico").autoNumeric({aSep: '', aDec: '.'});
                $(".moneda").autoNumeric({aSep: '', aDec: '.'});
                $(".money").autoNumeric({aSep: ',', aDec: '.'});
                $(".sinpunto").autoNumeric({aSep: ''});
                
                <?php
                if($this->agent->is_browser('Internet Explorer')){?>
                  $(".modal").removeClass('fade');      
                <?php
                }
                ?>

            });
        </script>
    </head>

    <body style='min-width:900px;'>
        <div id="contenedor" style='width:90%; margin:0 auto;'>
            <div id="imagen" >
                <img alt="finem" src="<?php echo base_url(); ?>images/logo.gif">
            </div>

            <?php
            $user = $this->phpsession->get('user', 'finem');
            if (!empty($user)) {
                if($user['agencia_idagencia'] != 0){
                    $this->load->view('common/menu/agencia');
                }else{
                    $this->load->view('common/menu/normal');
                }
                
            }
            ?>

            <?php
            $tmp = $this->phpsession->flashget('acierto');
            if (!empty($tmp)) {
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">×</a>
                <?php echo ($tmp); ?>
                </div>
                <?php
            }
            ?>

            <?php
            $tmp = $this->phpsession->flashget('error');
            if (!empty($tmp)) {
                ?>
                <div class="alert alert-error">
                    <a href="#" class="close" data-dismiss="alert">×</a>
                <?php echo ($tmp); ?>
                </div>
                <?php
            }
            ?>

            <?php
            $tmp = validation_errors();
            if (!empty($tmp)) {?>
                    <div class="alert alert-error">
                        <a href="#" class="close" data-dismiss="alert">×</a>
                    <?php echo (validation_errors()); ?>
                    </div>
            <?php
            }
            ?>

            <div id='error_ajax' class='alert alert-error' style='display: none;'>
                <p>ERROR.</p>
            </div>
            
            <div id='acierto_ajax' class='alert alert-success' style='display: none;'>
                <p>ERROR.</p>
            </div>
            
            <div id='neutral_ajax' style='display: none;'>
                <p>ERROR.</p>
            </div>
