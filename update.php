<?php
$emailValue = "";
$lnameValue = "";
$fnameValue = "";

$errorMessage = "";
$successMessage = "";

// Inclure le fichier de connexion
include ("connection.php");

        
                $connection = new connection();
        
                $connection->selectDatabase('logininfo');





// Inclure le fichier client
include("client.php");


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];
    $row = Client::selectClientById('clients', $connection->conn, $id);
    // Appeler la méthode statique selectClientById et stocker le résultat dans $row
    // code

    $emailValue = $row["email"];
    $lnameValue = $row["lastname"];
    $fnameValue = $row["firstname"];
}
else if(isset($_POST["submit"])){

    $emailValue = $_POST["email"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];

    if(empty($emailValue) || empty($fnameValue) || empty($lnameValue)){
        $errorMessage = "All fields must be filled out!";
    } else {
        // Créer une nouvelle instance de client ($client) avec les valeurs d'entrée
        $client = new client($fnameValue,$lnameValue,$emailValue,'');

        // Appeler la méthode statique updateClient et passer $client en paramètre
        Client::updateClient($client,'clients',$connection->conn,$_GET['id']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update</h2>

        <?php
        if(!empty($errorMessage)){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        ?>
        <br>
        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="fname">First Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $fnameValue ?>" class="form-control" type="text" id="fname" name="firstName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="lname">Last Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $lnameValue ?>" class="form-control" type="text" id="lname" name="lastName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $emailValue ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
            ?>
        
            <div class="row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-1 col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="read.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
