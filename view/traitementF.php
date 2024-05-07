<?php
include "../cnx.php"; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis


    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $cv = $_POST['cv'];
    $upload = $_POST['upload'];
    $lettre = $_POST['lettre'];
    $training_id = $_POST['id_tra'];

    $errors = array();

   



    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $errors[] = 'Le nom ne doit contenir que des lettres alphabétiques.';
    }

    if (!empty($errors)) {
        $error_string = implode('&', array_map(function ($error) {
            return 'error[]=' . urlencode($error);
        }, $errors));
        header("Location: TrainingPart.php?$error_string");
        exit;
    }

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête d'insertion avec des paramètres
        $sql = "INSERT INTO training_part (name, phone, cv, upload, lettre, training_id) VALUES (:name, :phone, :cv, :upload, :lettre, :training_id)";
        $statement = $connexion->prepare($sql);

        // Attribuer les valeurs aux paramètres
        $statement->bindParam(':name', $name);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':cv', $cv);
        $statement->bindParam(':upload', $upload);
        $statement->bindParam(':lettre', $lettre);
        $statement->bindParam(':training_id', $training_id);

        // Exécuter la requête d'insertion
        $statement->execute();

        echo "Participant ajouté avec succès.";
        // Redirection vers la page de confirmation ou de liste de formations
        header("refresh:2; url=trainingPart.php");
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $connexion = null;

?>
