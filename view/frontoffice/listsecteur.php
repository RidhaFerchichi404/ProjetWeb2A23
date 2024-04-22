<?php
    include "../controller/SecteurC.php";
    $secC=new SecteurC();
    $list=$secC->listsecteur();
    var_dump($list);
?>
<html>
<head></head>
<body>
    <center>
        <h1>List of secteurs</h1>
        
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id secteur</th>
            <th>Nom</th>
            <th>Email</th>
            <th>type</th>
            <th>nombre d'entreprises</th>
            <th>region</th>
            <th>exigence</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($list as $secteur) {
        ?> 
        <tr>
            <td><?php echo $secteur['id']; ?></td>  
            <td><?= $secteur ['nom'];?></td>  
            <td><?= $secteur ['email'];?></td>
            <td><?= $secteur ['type'];?></td> 
            <td><?= $secteur ['nb_entreprises'];?></td> 
            <td><?= $secteur ['region'];?></td>
            <td><?= $secteur ['exigence_formation'];?></td>
            <td><input value="update" type="submit"></td> 
            <td><a href="Delete.php?id=<?php echo $employe['id'];?>">Delete</a></td>   

        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>