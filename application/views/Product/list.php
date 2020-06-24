<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>


<?php if($products == NULL || empty($products)): ?>
    <p>Nincs rögzítve egyetlen alkalmazott sem!</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin") echo "<th>Id</th>" ?>
                <th>name</th>
                <th>type</th>
                <th>description</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $products as &$p) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>
                         <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin") echo "<td>".$p->id."</td>" ?> 
                        <td><?=$p->name?></td>
                        <td><?=$this->product_model->getProductTypeByProductId($p->typeId)?></td>
                        <td><?=$p->description?></td>
                        <td><?=$p->price?></td>
                        <td> 
                   <?php /* <?= anchor(base_url('employees/edit/'.$emp->id),'Módosítás') ?>    
                    <?= anchor(base_url('employees/delete/'.$emp->id),'Törlés') ?>
                    <?= anchor(base_url('employees/profile/'.$emp->ssn),'Profil') ?></td> */ ?>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


