<?php //echo anchor(base_url('employees/insert'),'Új hozzáadása'); ?> <!-- html <a> tag = php anchor() --->
<?php if($products == NULL || empty($products)): ?>
    <p>Nincs rögzítve egyetlen alkalmazott sem!</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>typeId</th>
                <th>description</th>
                <th>price</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $products as &$p) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>
                        <td><?=$p->id?></td>
                        <td><?=$p->name?></td>
                        <td><?=$p->typeId?></td>
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


