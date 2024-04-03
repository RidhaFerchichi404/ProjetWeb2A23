<?php
    include "../Controller/EventC.php";
    $evC = new EventC();
    $list = $evC->ListEvents();
    print_r($list);
?>
<html>
    <head><title>Lista</title></head>
    <body>
        <a href="AddEvent.php">AddEvent</a>
        <center>
            <h1>List of Events</h1>
        </center>
        <table border="1" align="center" width="70%">
        <tr>
            <th>Id Event</th>
            <th>Name of Event</th>
            <th>Organizer of Event</th>
            <th>Theme of Event</th>
            <th>Date of Event</th>
            <th>Place of Event</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($list as $Event) {
        ?>
            <tr>
                <td><?php echo $Event['idEvent']; ?></td>
                <td><?= $Event['nomEvent']; ?></td>
                <td><?php echo $Event['orgEvent']; ?></td>
                <td><?=  $Event['themeEvent']; ?></td>
                <td><?php echo $Event['dateEvent']; ?></td>
                <td><?=  $Event['lieuEvent']; ?></td>
                <td><input type="submit" value="update"></td>
                <td><a href="DeleteEvent.php?id=<?php echo $Event['idEvent'];?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </body>
</html>