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
<?php echo anchor(base_url('Login/login'),'Bejelentkezés'); ?> 
<?= form_close(); ?>
