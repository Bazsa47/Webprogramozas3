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


<?= form_open_multipart(); ?>
<?= form_label('Termék neve:', 'name');  ?> 
<?= form_input('name', set_value('name',$product->name)); ?>
<?= form_error('name'); ?>
<br/>    
<?= form_label('Ár:', 'price');  ?> 
<?= form_input('price',set_value('price',$product->price)); ?>
<?= form_error('price'); ?>
<br/>
<?= form_label('Termék leírása:', 'desc');  ?> 
<?= form_input('desc',set_value('desc',$product->description)); ?>
<?= form_error('desc'); ?>
</br>
<?= form_label('Típus:', 'type');  ?> 
<?= form_input('type',set_value('type',$product->typeId)); ?>
<?= form_error('type'); ?>
<br/>
<?= form_submit('submit','Szerkesztés'); ?>
<?= form_close(); ?>


