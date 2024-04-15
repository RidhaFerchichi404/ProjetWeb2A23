<?php
    include "../Controller/EventC.php";
    $evC = new EventC();
    $list = $evC->ListEvents();
    //print_r($list);
?>
<html>
    <head><title>Lista</title></head>
    <body>
        <center>
            <h1>List of Events</h1>
        </center>
        <table border="1" align="center" width="70%">
        <tr>
            <th>idEvent</th>
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
                <td><?= $Event['orgEvent']; ?></td>
                <td><?= $Event['themeEvent']; ?></td>
                <td><?= $Event['dateEvent']; ?></td>
                <td><?= $Event['lieuEvent']; ?></td>
                <td>
                    <form action="UpdateEvent.php" method="post">
                        <input type="hidden" name="idEvent" value="<?= $Event['idEvent']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form action="DeleteEvent.php" method="post">
                        <input type="hidden" name="idEvent" value="<?= $Event['idEvent']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div style="text-align: center;">
        <form action="AddEvent.php" method="get">
            <button type="submit">Add an Event</button>
        </form>
    </div>
    </body>
</html>