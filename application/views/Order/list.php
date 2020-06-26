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
<?php //echo anchor(base_url('employees/insert'),'Új hozzáadása'); ?> <!-- html <a> tag = php anchor() --->
<?php if($orders == NULL || empty($orders)): ?>
    <p>Nincs rögzítve egyetlen rendelés sem!</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Felhasználó</th>
                <th>Termék</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $orders as &$o) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>                    
                        <td><?=$o->orderId?></td>
                        <td><?php $this->load->model("users_model");?><?=$this->users_model->getUsernameByUserId($o->userId)?></td>   
                         <td><?php $this->load->model("product_model");?><?=$this->product_model->getProductNameById($o->productId)?></td>   
                       
                    
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>