<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/header.css">
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/display.css">
<div id="header">
    <div id="links">
<?php $this->load->library("session");?>
<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>
    </div>
</div>



<?php
echo "Hozzáférés megtagadva";
?>
