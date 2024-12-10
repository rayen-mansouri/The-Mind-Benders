<?php
require 'C:\xampp\htdocs\reclamation\config.php';

// Vérifier si les données du formulaire ont été envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $reclamation = $_POST['reclamation'];

    // Valider les données du formulaire (optionnel, mais recommandé)
    if (empty($nom) || empty($email) || empty($telephone) || empty($adresse) || empty($reclamation)) {
        die("Tous les champs sont obligatoires.");
    }

    // Insérer les données dans la table `reclamation`
    try {
        $pdo = config::getConnexion(); // Connexion à la base de données
        $sql = "INSERT INTO reclamation (nom, email, telephone, adresse, reclamation)
                VALUES (:nom, :email, :telephone, :adresse, :reclamation)";
        $stmt = $pdo->prepare($sql);
        
        // Associer les paramètres pour éviter les injections SQL
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':reclamation', $reclamation);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Échec de l'ajout de la réclamation.";
        }
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
