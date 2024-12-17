<link rel="stylesheet" href="style.css" type="text/css" media="all" />
<?php
include_once '../../Controller/UserC.php';

$co = new userC();
if (isset($_GET['id'])) {
    $userC = new userC();
    $listeC = $userC->afficherAdminDetail($_GET['id']);

    foreach ($listeC as $user) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                            </div>
                            <form action="#" method="post">
                                <!-- Box -->
                                <div class="box">
                                    <!-- Box Head -->
                                    <div class="container">
                                        <h2>Modifier client</h2>
                                    </div>
                                    <!-- End Box Head -->
                                    <!-- Form -->
                                    <div class="container">
                                        <p>
                                            <label>Nom </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="nom" value="<?php echo $user['nom']; ?>" />
                                        </p>
                                        <p>
                                            <label>Prenom </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="prenom" value="<?php echo $user['prenom']; ?>" />
                                        </p>
                                        <p>
                                            <label>Email </label>
                                            <input type="email" class="form-control form-control-user"
                                                name="email" value="<?php echo $user['email']; ?>" />
                                        </p>
                                        <p>
                                            <label>Mot de passe </label>
                                            <input type="text" class="form-control form-control-user"
                                                name="password" value="<?php echo $user['password']; ?>" />
                                        </p>
                                    </div>
                                    <!-- End Form -->
                                    <!-- Form Buttons -->
                                    <div class="buttons">
                                        <input type="Reset" class="button" value="Reset" />
                                        <input type="submit" class="button" value="submit" />
                                    </div>
                                    <!-- End Form Buttons -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} // End of foreach loop
}

// create event
$user = null;

$userC = new userC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"])
) {
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"])
    ) {
        $user = new  \App\Models\User(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['password']
        );
        $userC->modifierAdmin($_GET['id'], $user);

        header('Location:affichageUser.php');
    } else
        $error = "Missing information";
}
?>
