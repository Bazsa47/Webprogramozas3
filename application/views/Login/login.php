<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/header.css">
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/display.css">

<div id="header">
    <div id="links">
<?php $this->load->library("session");?>
<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
    <?php echo anchor(base_url('Order'),'Rendelések');?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>
    </div>
</div>


<div id="container">
<?= form_open(); ?>
<?= form_label('Felhasználónév:', 'username');  ?> 
<?= form_input('username', set_value('username','') /*[ 'id' => 'username']*/); ?>
<?= form_error('name'); ?>
<br/>    
<?= form_label('Jelszó:', 'pw');  ?> 
<?= form_password('pw',set_value('pw','') /*['placeholder' => 'Password', 'type' => 'password' ]*/); ?>
<?= form_error('pw'); ?>
<br/>
<?= form_submit('submit','Bejelentkezés'); ?>
<br/>
<?php echo anchor(base_url('Register'),'Regisztráció'); ?> 
<?= form_close(); ?>
</div>
