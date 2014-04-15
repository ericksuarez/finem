<?php $this->load->view('common/header'); ?>
<br />
<div class="container" style="margin:auto;">

    <div id="login" class="hero-unit" style='text-align:center;'>
        <h2>Finem 2.0</h2>
        <?php echo form_open(current_url(), array('class' => 'form_horizontal')); ?>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Usuario</label>
            <div class="controls">
                <input value="<?php echo set_value('user');?>" type="text" name="user" id="inputEmail" placeholder="Usuario">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Contraseña</label>
            <div class="controls">
                <input value="<?php echo set_value('pass');?>" type="password" name="pass" id="inputPassword" placeholder="Contraseña">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Entrar</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>