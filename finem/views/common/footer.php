<div class='clearfix'></div>
<hr />
                <div id="pie">
			Estrategias Digitales
		</div>

<script type='text/javascript'>
    var idleTime = 0;
    $(document).ready(function(){
        $(".con-query li a").each(function(){
            var li,link,newlink;
            li = $(this);
            link = li.attr('href');
            //alert(link);
            newlink = '<?php echo $_SERVER['QUERY_STRING']; ?>';
            if(newlink != ''){
                li.attr('href',link+"?"+newlink);
            }


        });
        
        $(".con-get").each(function(){
            var li,link,newlink;
            li = $(this);
            link = li.attr('href');
            //alert(link);
            newlink = '<?php echo $_SERVER['QUERY_STRING']; ?>';
            if(newlink != ''){
                li.attr('href',link+"?"+newlink);
            }


        });
        
        $(".redirigir").click(function(){
            var url= $(this).attr('data-url');
            //alert(url);
            window.location.replace(url);
        });
        
        <?php
        $user = $this->phpsession->get('user','finem');
        if(!empty($user)){?>
        //Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

        //Zero the idle timer on mouse movement.
        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
        <?php
        }
        ?>
    });
</script>
<script type="text/javascript">


function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime >= 10) { // 12 minutes
        //window.location.reload();
        //alert('Demsiado tiempo idle');
        $("#neutral_ajax").html('<i class="icon icon-spin icon-spinner"></i> Renovando Sesión');
        $("#neutral_ajax").css('display', 'block');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('login/renovar'); ?>",
            cache: false,
            data: {sessid: 1}
        }).done(function(html) {
            $("#error_ajax").css('display', 'none');
            $("#neutral_ajax").css('display', 'none');
            //alert('SESSION RENOVADA');
        }).fail(function(jqXHR, textStatus, errorThrown) {
            //alert(errorThrown);
            $("#neutral_ajax").css('display', 'none');
            $("#error_ajax").html('<p>Error al renovar la sesión.</p>');
            $("#error_ajax").css('display', 'block');
            
            //$("#results").html("<center><i class='icon icon-frown' style='font-size: 20em;'><br /><span style='font-size: 16px;'>No hemos encontrado resultados.</span></i></center>");
            //alert( "Falla en el sistema. Contacte a su administrador.");
        });
    }
}
</script>
</body>
</html>