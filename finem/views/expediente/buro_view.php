<br />

<br />



<div class='tabbable tabs-left pull-left' style='width:18%'>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#general">Subir Documentación</a></li>
        <li class=""><a href="#cartas">Cartas</a></li>
    </ul>
</div>

<?php echo form_open_multipart(current_url()); ?>
<input type='hidden' name='idalumno' value="<?php echo $expediente['alumno_idalumno'];?>" />
<div class="tab-content pull-right" style='width:80%;'>

    <div id="general" class="tab-pane active">
        
        <input type='hidden' value='<?php echo $expediente['matricula'];?>' name='mat' />
        <input type='hidden' value='' name='idburo' />
        <input type='file' name='buro' /><input type='submit' value='subir' clasS='btn btn-success' />
        <br />
        <br />
        <br />
        <?php
        if(!empty($informacion['buro'])){?>
        <table>
            <?php
            foreach($informacion['buro'] as $b){?>
            <tr>
                <td>
                    <a target='_blank' class='btn btn-link' href="<?php echo base_url('uploads/buro/'.$expediente['idexpediente'].'/'.$b['pdf']);?>"><i class='icon icon-file-alt icon-2x'></i>&nbsp;<?php echo ucfirst($b['pdf']);?></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        
        <?php
        }
        ?>
        
    </div>
    
    <div id="cartas" class="tab-pane">
        
        <div class='pull-left span12'>
            <a target='_blank' href='<?php echo site_url('carta/compromiso/'.$expediente['idexpediente']);?>' class='btn btn-link'><i class='icon icon-file-text icon-2x'></i>&nbsp;Carta Compromiso</a>
        </div>
        
    </div>
    

</div>
<div class='clearfix'></div>
<?php echo form_close(); ?>



<script type="text/javascript">

    



    $(document).ready(function(){

        $('#myTab a').click(function (e) {
            e.preventDefault();
            
            $(this).tab('show');

        });


    });

</script>



