<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>


<?= form_open(); ?>
<?= form_label('Felhasználónév:', 'username');  ?> 
<?= form_input('username', set_value('username','') /*[ 'id' => 'username']*/); ?>
<?= form_error('name'); ?>
<br/>    
<?= form_label('Jelszó:', 'pw');  ?> 
<?= form_password('pw',set_value('pw','') /*['placeholder' => 'Password', 'type' => 'password' ]*/); ?>
<?= form_error('pw'); ?>
<br/>
<?= form_label('Cím:', 'address');  ?> 
<?= form_input('address',set_value('address','')    /*['placeholder' => 'Address']*/); ?>
<?= form_error('address'); ?>
<br/>
<?= form_submit('submit','Register'); ?>
<?= form_close(); ?>
