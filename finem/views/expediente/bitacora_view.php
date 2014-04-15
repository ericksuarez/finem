<?php $this->load->view('common/header'); ?>
<?php
$foo = $this->config->item('asignar_agencias');
$user = $this->phpsession->get('user','finem');        
?>
<style type='text/css'>
    /* LIST #4 */
#list4 { padding: 10px 0 0 0; font-family:Georgia, Times, serif; font-size:15px; }
#list4 ul { list-style: none; }
#list4 ul li { }
#list4 ul li a { display:block; text-decoration:none; color:#000000; background-color:#FFFFFF; line-height:30px;
  border-bottom-style:solid; border-bottom-width:1px; border-bottom-color:#CCCCCC; padding-left:10px; cursor:pointer; }
#list4 ul li a:hover { color:#FFFFFF; background-color: #008ABA; }
#list4 ul li a strong { margin-right:10px; }
</style>
<div id="contenido" >
    <h2>Bitácora de Expediente con Matrícula <?php echo $expediente['matricula'];?></h2>
    <a class='btn btn-small' href='<?php echo site_url('expediente/lista');?>?<?php echo $_SERVER['QUERY_STRING']; ?>'><i class='icon icon-list-alt'></i>&nbsp; Regresar a Lista</a>
    <div id='list4'>
        <ul>
        <?php
        if(!empty($historia)){
            foreach($historia as $h){
                $nombre = $h['nombre'].' '.$h['apellidop'].' '.$h['apellidom'];
                $strtime = strtotime($h['fecha']);?>
            <li><a href="#N" ><?php echo $nombre?> ha <?php echo $h['accion'];?> en la sección <?php echo $h['seccion'];?> el día <?php echo fecha_contrato(date('Y-m-d',$strtime));?> a las <?php echo date('H:m:s',$strtime);?></a></li>
        <?php
            }?>
        </ul>
    </div>
    <?php
    }else{
        $data['mensaje'] = 'No se han encontrado resultados.';
        $this->load->view('errors/error_custom',$data);
                
    }
    ?>


</div>



<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>

<?php $this->load->view('common/footer'); ?>