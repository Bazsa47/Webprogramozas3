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
<?php if($users == NULL || empty($users)): ?>
    <p>Nincs rögzítve egyetlen alkalmazott sem!</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Address</th>
                <th>Jogkör</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $users as &$user) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>
                        <td><?=$user->id?></td>
                        <!--<td><?php //echo anchor($emp->photo_path,$emp->name);?></td> -->
                        <td><?=$user->username?></td>
                        <td><?=$user->address?></td>
                         <td><?=$this->users_model->getUserRoleNameByUserRoleId($user->roleId)?></td>
                        <td><?= anchor(base_url('Users/edit/'.$user->id),"Módosítás") ?>
                        <?=anchor(base_url('Users/delete/'.$user->id),"Törlés")?></td>
                    
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
