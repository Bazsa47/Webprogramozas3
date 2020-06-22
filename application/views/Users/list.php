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
            </tr>
        </thead>
        <tbody>
                <?php foreach ( $users as &$user) :?> <!--//&: csak az adott rekord referenciáját másolom le -->
                    <tr>
                        <td><?=$user->id?></td>
                        <!--<td><?php //echo anchor($emp->photo_path,$emp->name);?></td> -->
                        <td><?=$user->username?></td>
                        <td><?=$user->address?></td>
                        <td> 
                    <?php /* <?= anchor(base_url('employees/edit/'.$user->id),'Módosítás') ?>    
                    <?= anchor(base_url('employees/delete/'.$user->id),'Törlés') ?>
                    <?= anchor(base_url('employees/profile/'.$user->ssn),'Profil') ?></td> */ ?>
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
