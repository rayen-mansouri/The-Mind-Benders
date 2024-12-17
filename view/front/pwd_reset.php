<?php
session_start();

require_once '../../config.php';
require_once '../../Controller/UserC.php';


// Define variables to store form input and error messages
$password = $confirm_password = $password_error = $confirm_password_error = "";
$success_message = $error_message = "";
// Instantiate UserController
$userController = new UserC();
// Check if the token is provided in the URL
if (!empty($_GET['token'])) {
    $token = $_GET['token'];
    

    // Validate the token
    $user = $userController->getUserByToken($token);
    if ($user) {
        // Token is valid, allow the user to reset the password
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate password
            if (empty($_POST["password"])) {
                $password_error = "Le mot de passe est requis";
            } else {
                $password = test_input($_POST["password"]);
            }

            // Validate confirm password
            if (empty($_POST["confirm_password"])) {
                $confirm_password_error = "Veuillez confirmer le mot de passe";
            } else {
                $confirm_password = test_input($_POST["confirm_password"]);
                // Check if confirm password matches password
                if ($password != $confirm_password) {
                    $confirm_password_error = "Les mots de passe ne correspondent pas";
                }
            }

            // If there are no errors, proceed to update password
            if (empty($password_error) && empty($confirm_password_error)) {
                // Update user's password in the database
                $userController->updatePassword($user['id'], $password);

                // Show success message or redirect to login page
                // Depending on your application flow
                $success_message = "Le mot de passe a été réinitialisé avec succès.";
            }
        }
    } else {
        // Token is invalid or expired
        // You can redirect the user to an error page or display an error message
        $error_message = "Le lien de réinitialisation du mot de passe est invalide ou a expiré.";
    }
} else {
    // If the token is not provided in the URL, show an error message or redirect to an error page
    $error_message = "Le lien de réinitialisation du mot de passe est manquant.";
}

// Function to sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->

    <link rel="stylesheet" href="assets/css/custom-style.css">



    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Add your CSS styles here -->
    <style>
        /* Add custom styles */
        .login-form label {
            color: white; /* Set label text color to white */
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            color: black; /* Set input text color to white */
        }
        .login-form input[type="submit"] {
            background-color: #32CD32; /* Change button background color */
            color: white; /* Set button text color to white */
            border: none; /* Remove button border */
            padding: 10px 20px; /* Add padding to the button */
            border-radius: 5px; /* Add border radius to the button */
            cursor: pointer; /* Change cursor to pointer on hover */
            transition: background-color 0.3s; /* Add smooth transition */
        }
        .login-form input[type="submit"]:hover {
            background-color: #228B22; /* Change button background color on hover */
        }
    </style>
</head>

<body>
    <main class="login-body" data-vide-bg="assets/img/login-bg.mp4">
        <div class="form-default">
            <div class="login-form">
                <div class="logo-login">
                    <a href="index.html"><img src="assets/img/logo/loader.png" alt=""></a>


                    
                </div>
                <h2>Réinitialiser le mot de passe</h2>
                <?php if ($error_message) : ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if ($success_message) : ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php endif; ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?token=' . urlencode($token); ?>">
                    <!-- Add a hidden input field to include the token -->
                    <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
                    <div>
                        <label for="password">Nouveau mot de passe:</label><br>
                        <input type="password" id="password" name="password" placeholder="new password" value="<?php echo $password; ?>"><br>
                        <span style="color: red;"><?php echo $password_error; ?></span><br>
                    </div>
                    <div>
                        <label for="confirm_password">Confirmer le mot de passe:</label><br>
                        <input type="password" id="confirm_password" name="confirm_password"  placeholder="confirm password"value="<?php echo $confirm_password; ?>"><br>
                        <span style="color: red;"><?php echo $confirm_password_error; ?></span><br>
                    </div>
                    <input type="submit" value="Réinitialiser le mot de passe">
                </form>
            </div>
        </div>
    </main>




    <!-- JS here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <script src="./assets/js/jquery.vide.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->    
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>



<style>
    body{
        background: -webkit-linear-gradient(left,#0a4828 ,#b1e280);
    }
    /* Styles for the reset password form */
.login-body{

    background: -webkit-linear-gradient(left,#0a4828 ,#b1e280);

}

.form-default {
    width: 800px;
    length: 900px;
    color: #25299c;
    margin: 0 auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.form-default h2 {
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}

.form-default label {
    font-weight: bold;
}

.form-default input[type="text"],
.form-default input[type="email"],
.form-default input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-default input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #0a4828;
    color: #fff;
    border: none;
    border-radius: 20px;
    cursor: pointer;
}

.form-default input[type="submit"]:hover {
    background-color:#b1e280;
}

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}

.success-message {
    color: green;
    font-size: 14px;
    margin-top: 5px;
}


</style>