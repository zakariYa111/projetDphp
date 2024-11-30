<?php
$emailValue = "";
$lnameValue = "";
$fnameValue = "";
$passwordValue = "";
$errorMessage = "";
$successMessage = "";

if (isset($_POST["submit"])) {
    $emailValue = $_POST["email"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
    $passwordValue = $_POST["password"];

    // Validation des champs
    if (empty($emailValue) || empty($fnameValue) || empty($lnameValue) || empty($passwordValue)) {
        $errorMessage = "All fields must be filled out!";
    } else if (strlen($passwordValue) < 8) {
        $errorMessage = "Password must contain at least 8 characters!";
    } else if (!preg_match("/[A-Z]/", $passwordValue)) {
        $errorMessage = "Password must contain at least one capital letter!";
    } else {
        // Inclure le fichier de connexion
        include ("connection.php");

        
        $connection = new connection();

        $connection->selectDatabase('logininfo');

        include ("client.php");
        $client = new client($fnameValue,$lnameValue,$emailValue, $passwordValue);
        $client->insertClient('clients',$connection->conn);

        $successMessage = Client::$successMsg;
        $errorMessage = Client::$errorMsg;

        if (!empty($successMessage)) {
            $emailValue = "";
            $lnameValue = "";
            $fnameValue = "";
            $passwordValue = "";
        }
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
        <h2>SIGN UP</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $errorMessage ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="fname">First Name:</label>
                <div class="col-sm-6">
                    <input value="<?= htmlspecialchars($fnameValue) ?>" class="form-control" type="text" id="fname" name="firstName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="lname">Last Name:</label>
                <div class="col-sm-6">
                    <input value="<?= htmlspecialchars($lnameValue) ?>" class="form-control" type="text" id="lname" name="lastName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?= htmlspecialchars($emailValue) ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="password">Password:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password">
                </div>
            </div>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= $successMessage ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="col-sm-1 col-sm-3 d-grid">
                    <a href="login.php" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
