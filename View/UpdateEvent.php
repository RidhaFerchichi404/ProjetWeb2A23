<?php
    include "../Controller/EventC.php";
    include "../Model/Event.php";
    $error = null;
    $ev = null;
    if (isset($_POST['idEvent'])) {
        $idEvent = $_POST['idEvent'];
        $evC = new EventC();
        $event = $evC->getEventById($idEvent);

        if(isset($_POST["nomEvent"])
        && isset($_POST["orgEvent"])
        && isset($_POST["themeEvent"])
        && isset($_POST["dateEvent"])
        && isset($_POST["lieuEvent"])){
            if(!empty($_POST["nomEvent"])
            && !empty($_POST["orgEvent"])
            && !empty($_POST["themeEvent"])
            && !empty($_POST["dateEvent"])
            && !empty($_POST["lieuEvent"])){
                $formattedDate = date('Y-m-d', strtotime($_POST["dateEvent"]));
                $ev = new Event(null,
                $_POST["nomEvent"],
                $_POST["orgEvent"],
                $_POST["themeEvent"],
                $formattedDate,
                $_POST["lieuEvent"]);
                $evC = new EventC();
                var_dump($ev);
                $evC->updateEvent($ev);
                header('Location:ListEvents.php');
            } else {
                $error = "Missing info";
            }
        }
    }
?>
<html>
<head>
    <title>Update Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post" id="UpdateForm">
    <table>
        <tr>
            <td><label for="nomEvent">Event Name</label></td>
            <td>
                <input type="text" name="nomEvent" id="nomEvent" value="<?= $event['nomEvent'] ?? ''; ?>">
                <span id="nameError" class="error"></span> 
            </td>
        </tr>
        <tr>
            <td><label for="orgEvent">organisateur</label></td>
            <td>
                <input type="text" name="orgEvent" id="orgEvent" value="<?= $event['orgEvent'] ?? ''; ?>">
                <span id="orgError" class="error"></span> 
            </td>
        </tr>
        <tr>
            <td><label for="themeEvent">Theme</label></td>
            <td>
                <input type="text" name="themeEvent" id="themeEvent" value="<?= $event['themeEvent'] ?? ''; ?>">
                <span id="themeError" class="error"></span> 
            </td>
        </tr>
        <tr>
            <td><label for="dateEvent">Date of event</label></td>
            <td>
                <input type="date" name="dateEvent" id="dateEvent" value="<?= $event['dateEvent'] ?? ''; ?>">
                <span id="dateError" class="error"></span> 
            </td>
        </tr>
        <tr>
            <td><label for="lieuEvent">lieu event</label></td>
            <td>
                <input type="text" name="lieuEvent" id="lieuEvent" value="<?= $event['lieuEvent'] ?? ''; ?>">
                <span id="lieuError" class="error"></span> 
            </td>
        </tr>
    </table>
    <input type="submit" value="Update">
    <?php echo $error; ?>
</form>

    <script src="UpdateFormValidator.js"></script>
</body>
</html>
