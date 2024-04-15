<?php
    include "../Controller/EventC.php";
    include "../Model/Event.php";
    $error = null;
    $ev = null;
    if(isset($_POST["NameEv"])
    && isset($_POST["OrgEv"])
    && isset($_POST["ThemeEv"])
    && isset($_POST["DateEv"])
    && isset($_POST["LieuEv"])){
        if(!empty($_POST["NameEv"])
        && !empty($_POST["OrgEv"])
        && !empty($_POST["ThemeEv"])
        && !empty($_POST["DateEv"])
        && !empty($_POST["LieuEv"])){
            $ev = new Event(null,
            $_POST["NameEv"],
            $_POST["OrgEv"],
            $_POST["ThemeEv"],
            new DateTime($_POST["DateEv"]),
            $_POST["LieuEv"]);
            //var_dump($_POST["DateEv"]); // testing
            $evC = new EventC();
            $evC->addEvent($ev);
            echo "added succesfully !!";
            header('Location:ListEvents.php');
        }else{
            $error = "Missing info";
        }
    }
?>
<html>
<head>
    <title>WaaaAAiAaaaW</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="POST" id="AddForm">
        <table>
            <tr>
                <td><label for="NameEv">Event Name</label></td>
                <td><input type="text" name="NameEv" id="NameEv"></td>
                <td><span id="nameError" class="error"></span></td>
            </tr>
            <tr>
                <td><label for="OrgEv">Organisateur</label></td>
                <td><input type="text" name="OrgEv" id="OrgEv"></td>
                <td><span id="orgError" class="error"></span></td>
            </tr>
            <tr>
                <td><label for="ThemeEv">Theme</label></td>
                <td><input type="text" name="ThemeEv" id="ThemeEv"></td>
                <td><span id="themeError" class="error"></span></td>
            </tr>
            <tr>
                <td><label for="DateEv">Date of Event</label></td>
                <td><input type="date" name="DateEv" id="DateEv"></td>
                <td><span id="dateError" class="error"></span></td>
            </tr>
            <tr>
                <td><label for="LieuEv">Lieu Event</label></td>
                <td><input type="text" name="LieuEv" id="LieuEv"></td>
                <td><span id="lieuError" class="error"></span></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
                <?php
                    echo $error;
                ?>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
    <script src="AddFormValidator.js"></script>
</body>
</html> 