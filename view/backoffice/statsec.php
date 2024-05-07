<?php
// Récupérer les données sur le nombre d'entreprises pour chaque secteur
$secteurs = []; // Remplacez cela par votre liste de secteurs avec leurs nombres d'entreprises
foreach ($secteurs as $secteur) {
    $labels[] = $secteur['nom']; // Utilisez le nom du secteur comme étiquette sur l'axe des x
    $data[] = $secteur['nb_entreprises']; // Utilisez le nombre d'entreprises comme données sur l'axe des y
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graphique Comparatif du Nombre d'Entreprises par Secteur</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        // Créer un graphique avec Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>, // Étiquettes sur l'axe des x (noms des secteurs)
                datasets: [{
                    label: 'Nombre d\'entreprises par secteur',
                    data: <?php echo json_encode($data); ?>, // Données sur l'axe des y (nombre d'entreprises)
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur de fond des barres
                    borderColor: 'rgba(54, 162, 235, 1)', // Couleur de bordure des barres
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Commencer l'axe des y à zéro
                    }
                }
            }
        });
    </script>
</body>
</html>