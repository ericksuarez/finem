<?php $this->load->view('common/header'); ?>

<div id="contenido" >
    <?php echo form_open(current_url());?>
        <table align="center">
            <tbody><tr>
                    <th colspan="4">
            <h3>Generación de reporte.</h3>
            <div id="alert" class="alert alert-error" style="display: none;">
                <span id="mensajeError"></span>
            </div>
            <div style="text-align: left;" class="alert alert-info">					
                Solo podrán generar un máximo de 300 matrículas por reporte.
            </div>
            </th>
            </tr>
            <tr>
                <td>Matrícula</td>
                <td><input type="text" placeholder="Escribe una matrícula..." id="matricula" value=""></td>
                <td>
                    Mes
                    <select id="mes"><option value="0">  -- MESES --  </option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </td>
                <td><input type="button" class="btn" id="agregar" onclick="add_mat('matricula', 'mes');" value="Agregar" name="agregar"></td>                    
                <td>
                    <input type="hidden" id="agregar_mat" value="generaLayout" name="formhid">
                    <input type="submit" class="btn btn-inverse" value="Generar" name="enviar">
                </td>
            </tr>
            </tbody>
        </table>
        <br />
        <table align="center" id="tabla_matriculas">
            <tbody><tr>
                    <th colspan="2"><h4>Matrículas agregadas al reporte.</h4><h4></h4></th>
            </tr>
            <tr>
                <td><b>Matrícula</b></td>
                <td><b>Mes</b></td>
                <td><b>Eliminar</b></td>
            </tr>
            </tbody>
        </table>
    <?php echo form_close();?>
</div>
    

<script type="text/javascript">
    $(document).ready(function(){
        var startDate = new Date(<?php echo date('Y'); ?>, <?php echo date('m') - 1; ?>, <?php echo date('d'); ?>);
	var endDate = new Date(<?php echo date('Y'); ?>, <?php echo date('m') - 1; ?>, <?php echo date('d'); ?>);

        $('#fechainicio').datepicker({
            format: 'yyyy-mm-dd'
        })
                .on('changeDate', function(ev) {

            startDate = new Date(ev.date);
            if (ev.date.valueOf() > endDate.valueOf()) {

                $('#alert').show();
                $('#mensajeError').html('La fecha que haz elegido no puede ser mayor a la fecha fin.');

            } else {

                $('#alert').hide();
                $('#fechainicio').datepicker('hide');
            }
        });

        $('#fechafin').datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function(ev) {

            endDate = new Date(ev.date);

            if (ev.date.valueOf() < startDate.valueOf()) {

                $('#alert').show();
                $('#mensajeError').html('La fecha fin no puede ser menor a la fecha de inicio.');

            } else {

                $('#alert').hide();
                $('#fechafin').datepicker('hide');
            }
        });

        $('.close').click(function() {
            $('#alert').slideToggle(400);
        });

        $('#generar').click(function(event) {

            if (startDate.valueOf() > endDate.valueOf()) {

                event.preventDefault();
                $('#alert').show();
                $('#mensajeError').html('La fecha que haz elegido no puede ser mayor a la fecha fin.');

            }
        });

        $('#alert').hide();
    });
</script>

<script type="text/javascript">
    var contador = 1;
            
    function meses_elige(mes) {
            
        var result, newmes;
        newmes = parseInt(mes);
        switch (newmes) {
            case 1:
                result = 'Enero';
                break;
            case 2:
                result = 'Febrero';
                break;
            case 3:
                result = 'Marzo';
                break;
            case 4:
                result = 'Abril';
                break;
            case 5:
                result = 'Mayo';
                break;
            case 6:
                result = 'Junio';
                break;
            case 7:
                result = 'Julio';
                break;
            case 8:
                result = 'Agosto';
                break;
            case 9:
                result = 'Septiembre';
            case 10:
                result = 'Octubre';
                break;
            case 11:
                result = 'Noviembre';
                break;
            case 12:
                result = 'Diciembre';
            default:
                result = '&Uacute;ltimo';
        }
        return result;
    }

    function add_mat(idinput, idfecha) {

        var matricula, campo, mes, mes_letra, maxMats = 300;

        matricula = document.getElementById(idinput).value;
        regexpEspacios = /^\s*|\s*$/g;
        matricula = matricula.replace(regexpEspacios, '');
        mes = document.getElementById(idfecha).value;
        mes_letra = meses_elige(mes);

        if (matricula == '') {

            $('#alert').slideDown(400);
            $('#mensajeError').html('Debes de escribir una matricula para que se agregue.');
            $('#matricula').focus();

        } else {

            if (contador <= maxMats) {
                $('#alert').slideUp(400);
                campo = '<tr id="fila' + contador + '"><td>' + matricula + '<input type="hidden" id="mat[' + contador +
                        ']"  name="mat[' + contador + ']" value="' + matricula + '"/></td>' +
                        '<td>' + mes_letra + '<input type="hidden" name="mes[' + contador + ']" value="' + mes + '"></td>' +
                        '<td><a href="javascript:del_mat(\'#fila' + contador +
                        '\')" onClick="this.href" class="btn btn-danger" style="color:white; text-decoration:none;">Eliminar<td></tr>';
                contador++;
                $("#tabla_matriculas").append(campo);
                /*
                 $("<table>").append(campo).hide().appendTo("#tabla_matriculas").slideDown(1000, function() {
                 $(this).contents().unwrap();
                 });
                 */
                if (contador == (maxMats + 1)) {
                    $('#matricula').attr('disabled', 'disabled');
                    $('#agregar').attr('disabled', 'disabled');
                }

            } else {

                $('#mensajeError').html('No puede agregar más de ' + (contador - 1) + ' matrículas.');
                $('#alert').slideDown(400);
                $('#matricula').focus();
            }
            document.getElementById(idinput).value = '';
            document.getElementById(idinput).focus();
        }
    }

    function del_mat(ideliminar) {
        $(ideliminar).remove();
    }
</script>

<?php $this->load->view('common/footer'); ?>
