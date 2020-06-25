<?php echo anchor(base_url('Product'),'Termékek'); ?>
 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
    <?php echo anchor(base_url('Users'),'Felhasználók'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('role') == null): ?> 
<?php echo anchor(base_url('Login'),'Bejelentkezés'); ?>
<?php else: ?>
     <?php echo anchor(base_url('Login/logout'),'Kijelentkezés'); ?>
<?php endif; ?>

 <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin"): ?> 
 <?php echo anchor(base_url('Product/insert'),'Termék hozzáadása'); ?>
 <?php endif;?>
<?php if($products == NULL || empty($products)): ?>
    Nincs rögzített termék!
<?php else: ?>
    
    <table>
        <thead>
            <tr>
                <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin") echo "<th>Id</th>" ?>
                <th>Kép<th>
                <th>Termék neve</th>
                <th>Típus</th>
                <th>Leírás</th>
                <th>Ár</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $products as &$p) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>
                         <?php if ($this->session->userdata('role') != null && $this->session->userdata('role') == "admin") echo "<td>".$p->id."</td>" ?> 
                        <td><img src ="<?= $p->picture; ?> " ></td>
                        <td><?=$p->name?></td>
                        <td><?=$this->product_model->getProductTypeByProductId($p->typeId)?></td>
                        <td><?=$p->description?></td>
                        <td><?=$p->price." Ft"?></td>
                        <td>                
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


