<?php $this->load->view('common/header'); ?>

<div id="contenido" >
    <h2>Generación reporte Mesa Control</h2>
    <div class="alert alert-info">
        Únicamente podrá generar el reporte de un mes.
    </div>
    <?php echo form_open(current_url(), array('class' => 'form-horizontal')); ?>
    <fieldset>
        <legend>Fecha suscripción contrato.</legend>
        <div class="control-group">
            <label class="control-label" for="fechaini">Fecha inicio</label>
            <div class="controls">
                <input type="text" id="fechaini" name="fechaini" placeholder="00-00-0000">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fechafin">Fecha fin</label>
            <div class="controls">
                <input type="text" id="fechafin" name="fechafin" placeholder="00-00-0000">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Generar</button>
            <button type="button" class="btn" id="cerrar">Cerrar</button>
        </div>
    </fieldset>
    <?php echo form_close(); ?>

</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#fechaini, #fechafin').datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            showAnim: 'drop',
            onClose: function(selectedDate) {

                if (this.id == 'fechaini') {

                    var dateMin = $("#fechaini").datepicker('getDate');
                    var dMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + 31);
                    $("#fechafin").datepicker("option", "minDate", selectedDate);
                    $("#fechafin").datepicker("option", "maxDate", dMax);

                } else {

                    var dateMax = $("#fechafin").datepicker('getDate');
                    var dMin = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate() - 31);
                    $("#fechaini").datepicker("option", "maxDate", selectedDate);
                    $("#fechaini").datepicker("option", "minDate", dMin);
                }
            }
        });

        $('#cerrar').click(function() {
            window.close();
        });
    });
</script>

<?php $this->load->view('common/footer'); ?>