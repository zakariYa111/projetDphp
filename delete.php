<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];

    // Inclure le fichier de connexion
    include("connection.php"); 

    // Créer une instance de la classe Connection
    $connection = new Connection();

    // Appeler la méthode selectDatabase pour se connecter à la base de données
    $connection->selectDatabase('logininfo'); 

    // Inclure le fichier client
    include('client.php'); 

    // Appeler la méthode statique deleteClient pour supprimer un client
    Client::deleteClient('clients', $connection->conn, $id);

    if ($result) {
        echo "Client deleted successfully.";
        // Rediriger vers la page de liste des clients après la suppression
        header("Location: read.php");
    } else {
        echo "Error deleting client.";
    }
}
?>
