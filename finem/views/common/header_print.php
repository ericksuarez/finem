<!DOCTYPE html>
<html lang="es">
<head>
	<title>FINEM Sistema</title>
	<meta charset="utf-8">

	<!-- Hojas de Estilo -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/cupertino/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('style/master.css');?>" />
        
	<!-- Javascript Librerias -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/autoNumeric-1.7.4.js" ></script>
        
        <script type="text/javascript">
    $(document).ready(function(){
      //alert('documento ready 1');
      $(".numerico").autoNumeric({aSep: '', aDec: '.'});
      $(".moneda").autoNumeric({aSep: '', aDec: '.'});
      $(".money").autoNumeric({aSep: ',', aDec: '.'});
      $(".sinpunto").autoNumeric({aSep: ''});
    });
    </script>
</head>

<body style='min-width:900px;'>
	<div id="contenedor" style='width:90%; margin:0 auto;'>
		<div id="imagen" >
			<img alt="finem" src="<?php echo base_url();?>images/logo.gif">
		</div>            