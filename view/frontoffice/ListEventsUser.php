<?php
    include_once "../../controller/EventC.php";
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
            <th>Max Participants</th>
        </tr>
        <?php
        foreach ($list as $Event) {
        ?>
            <tr>
                <td><?= $Event['idEvent']; ?></td>
                <td><?= $Event['nomEvent']; ?></td>
                <td><?= $Event['orgEvent']; ?></td>
                <td><?= $Event['themeEvent']; ?></td>
                <td><?= $Event['dateEvent']; ?></td>
                <td><?= $Event['lieuEvent']; ?></td>
                <td><?= $Event['NbP']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div style="text-align: center;">
        <form action="AddEventUser.php" method="get">
            <button type="submit">Add an Event</button>
        </form>
    </div>
    </body>
</html>