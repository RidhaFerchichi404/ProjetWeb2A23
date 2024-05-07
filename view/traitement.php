<?php

// Inclure le fichier de connexion à la base de données
include "../cnnx.php";

// Définir les variables de message d'erreur
$errors = [];


$nom = $_POST['name'];
$date = $_POST['date_line'];
$adresse = $_POST['adress'];
$prix = $_POST['prix'];
$time=$_POST['time'];
$description = $_POST['description'];
$photo=$_POST['photo'];

if (strtotime($date) <= time()) {
    $errors[] = 'La date doit être ultérieure à la date actuelle.';
}


if (!filter_var($prix, FILTER_VALIDATE_FLOAT)) {
    $errors[] = 'Le prix doit être un nombre.';
}


if (!preg_match("/^[a-zA-Z]+$/", $nom)) {
    $errors[] = 'Le nom ne doit contenir que des lettres alphabétiques.';
}

// Si des erreurs sont présentes, rediriger vers training.php avec les erreurs dans l'URL
if (!empty($errors)) {
    $error_string = implode('&', array_map(function($error) {
        return 'error[]=' . urlencode($error);
    }, $errors));
    header("Location: trainingF.php?$error_string");
    exit;
}
$pdo = cnnx::getConnexion();
/*$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$destination = 'C:\xampp\htdocs\Projet\FrontBack12\view\img\\' . $photo;
if (move_uploaded_file($photo_tmp, $destination)) {
    // Le fichier a été téléchargé avec succès*/
    // Effectuez la requête d'insertion dans la base de données ici
    $sql = "INSERT INTO training (nom, date, adress, price, time, description, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécutez la requête avec les valeurs des paramètres
    if ($stmt->execute([$nom, $date, $adresse, $prix, $time, $description, $photo])) {
        echo "Formation ajoutée avec succès.";
        header("refresh:2; url=training.php");
    } else {
        echo "Erreur lors de l'insertion dans la base de données : " . $stmt->errorInfo()[2];
    }
} else {
    // Une erreur s'est produite lors du téléchargement du fichier
    // Gérez l'erreur en conséquence
    echo "Erreur lors du téléchargement du fichier.";
}
$photo = 'img/' . $_FILES['photo']['name'];

// Préparer la requête d'insertion
$sql = "INSERT INTO training (nom, date, adress, price, time, description, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

// Exécuter la requête avec les valeurs des paramètres
if ($stmt->execute([$nom, $date, $adresse, $prix, $time, $description, $photo])) {
    echo "Formation ajoutée avec succès.";
    header("refresh:2; url=training.php");
} else {
    echo "Erreur : " . $stmt->errorInfo()[2];
}

// Fermer la connexion à la base de données (facultatif avec PDO)
$pdo = null;
