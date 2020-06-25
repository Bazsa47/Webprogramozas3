<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>


<?= form_open_multipart(); ?>
<?= form_label('Termék neve:', 'name');  ?> 
<?= form_input('name', set_value('name','')); ?>
<?= form_error('name'); ?>
<br/>    
<?= form_label('Ár:', 'price');  ?> 
<?= form_input('price',set_value('price','')); ?>
<?= form_error('price'); ?>
<br/>
<?= form_label('Termék leírása:', 'desc');  ?> 
<?= form_input('desc',set_value('desc','')); ?>
<?= form_error('desc'); ?>
</br>
<?= form_label('Típus:', 'type');  ?> 
<?= form_input('type',set_value('type','')); ?>
<?= form_error('type'); ?>
</br>
<?= form_upload('file'); ?> 
<?= form_error('profile_pic'); ?>
<br/>
<?= form_submit('submit','Hozzáadás'); ?>
<?= form_close(); ?>

