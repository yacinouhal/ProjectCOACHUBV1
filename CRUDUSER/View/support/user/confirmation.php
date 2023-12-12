<!-- confirmation.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Assurez-vous d'avoir un fichier de style CSS -->
    <title>Confirmation de Mise à Jour</title>
</head>
<body>
    <div class="container">
        <h1>Confirmation de Mise à Jour</h1>

        <?php
        include '../../../Model/db_connection.php';
        include 'fetch_submission_data.php';

        // Vérifier si $row existe avant de l'utiliser
        if ($row) {
        ?>
        
        <p>Votre soumission avec l'ID <?php echo $row['submission_id']; ?> a été mise à jour avec succès.</p>

        <h2>Détails Mis à Jour :</h2>
        <p><strong>Nom :</strong> <?php echo $row['name']; ?></p>
        <p><strong>Contact :</strong> <?php echo $row['contact']; ?></p>
        <p><strong>Description du Problème :</strong> <?php echo $row['problem_description']; ?></p>

        <p>Nous apprécions vos commentaires. Nos administrateurs examineront votre soumission mise à jour et vous assisteront dès que possible.</p>

        <a href="index.php">Retour à l'Accueil</a> <!-- Remplacez 'index.php' par l'URL réel de votre page d'accueil -->

        <?php
        } else {
            echo "La soumission avec l'ID $submissionId n'a pas été trouvée.";
        }
        ?>
    </div>
</body>
</html>
