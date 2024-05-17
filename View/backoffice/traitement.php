<?php

// Inclure le fichier de connexion à la base de données
include "../../config.php";

// Définir les variables de message d'erreur
$errors = [];

$nom = $_POST['name'];
$date = $_POST['date_line'];
$adresse = $_POST['adress'];
$prix = $_POST['prix'];
$time = $_POST['time'];
$description = $_POST['description'];
$photo = $_POST['photo'];

// Validate the inputs
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
    $error_string = implode('&', array_map(function ($error) {
        return 'error[]=' . urlencode($error);
    }, $errors));
    header("Location: training.php?$error_string");
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=careerhub', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête d'insertion
    $sql = "INSERT INTO training (nom, date, adress, price, time, description, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête d'insertion
    if ($stmt->execute([$nom, $date, $adresse, $prix, $time, $description, $photo])) {
        echo "Formation ajoutée avec succès.";
        header("refresh:2; url=training.php");
    } else {
        echo "Erreur : " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$pdo = null;
?>