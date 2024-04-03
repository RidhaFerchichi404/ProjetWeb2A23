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
<head><title>WaaaAAiAaaaW</title></head>
<body>
<form action="" method="POST">
        <table>
            <tr>
                <td><label for="">Event Name</label></td>
                <td><input type="text" name="NameEv" id="NameEv"></td>
            </tr>
            <tr>
                <td><label for="">organisateur</label></td>
                <td><input type="text" name="OrgEv" id="OrgEv"></td>
            </tr>
            <tr>
                <td><label for="">Theme</label></td>
                <td><input type="text" name="ThemeEv" id="ThemeEv"></td>
            </tr>
            <tr>
                <td><label for="">Date of event</label></td>
                <td><input type="date" name="DateEv" id="DateEv"></td>
            </tr>
            <tr>
                <td><label for="">lieu event</label></td>
                <td><input type="text" name="LieuEv" id="LieuEv"></td>
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
</body>
</html> 