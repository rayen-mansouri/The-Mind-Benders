<?php 
session_start();
//include_once "../../controlleur/UserC.php";
//include_once "../../model/User.php";
//include_once "C:/xampp/htdocs/userf2/config.php";

$error = "";
//$userC = new userC();

// Registration Form Processing (isset($_POST['olla']))
if (isset($_POST['olla'])) {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['Email'], $_POST['password'])) {
      $nom = trim($_POST['nom']);  // Trim whitespaces
      $prenom = trim($_POST['prenom']);
      $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);  // Sanitize email
      $password = $_POST['password'];
  
      // Enhanced Validation
      $isValid = true;
      if (empty($nom)) {
        $error .= "Name is required. <br>";
        $isValid = false;
      } else if (!preg_match("/^[a-zA-Z ]+$/", $nom)) {
        $error .= "Name must only contain letters and spaces. <br>";
        $isValid = false;
      }
  
      if (empty($prenom)) {
        $error .= "Last Name is required. <br>";
        $isValid = false;
      } else if (!preg_match("/^[a-zA-Z ]+$/", $prenom)) {
        $error .= "Last Name must only contain letters and spaces. <br>";
        $isValid = false;
      }
  
      if (empty($email)) {
        $error .= "Email is required. <br>";
        $isValid = false;
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Invalid email format. <br>";
        $isValid = false;
      }
  
      if (empty($password)) {
        $error .= "Password is required. <br>";
        $isValid = false;
      } else if (strlen($password) < 6) {
        $error .= "Password must be at least 6 characters long. <br>";
        $isValid = false;
      }
  
      // Process valid data if no errors
      if ($isValid) {
        $user = new User($nom, $prenom, $email, $password);
        $userC->ajouterUser($user, "noimage.png");
      } else {
        $error = "Please fix the following errors: <br>" . $error;
      }
    }
  }

if(isset($_POST['hey'])) {
    if(!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $message = $userC->connexionUser($email, $pass);

        if($message != 'pseudo ou le mot de passe est incorrect') {
            $liste = $userC->Rechercherid($email, $pass);
            $_SESSION['act'] = "1";
            $_SESSION['id'] = $liste['id'];
            $_SESSION['nom'] = $liste['nom'];
            $_SESSION['prenom'] = $liste['prenom'];
            $_SESSION['email'] = $liste['email'];
            $_SESSION['password'] = $liste['password'];
            $_SESSION['role'] = $liste['role'];

            if(strpos($email, '@admin') !== false) {
                header('location:../../view/backend/index.php');
            } else {
                header('location:index.php');
            }
        } else {
            echo "<script>alert('Incorrect email or password!');</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireMe - Welcome</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" type="text/css" href="signins.css">
    <!-- Add more custom styles if needed -->
</head>
<style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .cont{
            height: 550px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            
        }
        .navbar {
            padding: 20px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: 600;
            color: #333; /* Adjusted color */
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navbar-brand:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .navbar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-item {
            margin-right: 20px;
        }
        .navbar-nav .nav-item:last-child {
            margin-right: 0;
        }
        .navbar-nav .nav-link {
            color: #fff; /* Adjusted color */
            text-decoration: none;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-shadow: -10px -10px 15px rgba(255, 255, 255, 0.3), 10px 10px 15px rgba(70, 70, 70, 0.15), inset -10px -10px 15px rgba(255, 255, 255, 0.3), inset 10px 10px 15px rgba(70, 70, 70, 0.15);
height: 450px;
width: 1000px ;
        }
        .main h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .card-body {
            padding: 0;
        }
        .card-body table {
            width: 100%;
        }
        .card-body table tr {
            border-bottom: 1px solid #eee;
        }
        .card-body table td {
            padding: 10px 0;
        }
        .card-body table td:first-child {
            width: 120px;
            color: #888;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #5bc0de;
        }
        .edit-button {
            background-color: #25299c;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 8px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .edit-button:hover {
            background-color: #0056b3;
        }
        .button-container {
    display: flex;
    justify-content: space-between;
    margin-top: 10px; /* Adjust as needed */
}

.btn {
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    cursor: pointer;
}
    </style>
<body>

    <!-- Header Section -->
    <!-- Header Section -->
    

    <!-- Sign In and Sign Up Section -->
    <div class="cont">
        <div class="form sign-in">
            <h2>Welcome</h2>
            <form name="f1" action="" method="POST" enctype="multipart/form-data">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="pass" id="pass" required>
                </label>
               
                <p class="forgot-pass"><a href="reCAPTCHA.html">Forgot password?</a></p>
                <button type="submit" class="submit" name="hey">Sign In</button>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Hello, are you new here? Enter your personal details and start your journey with us.</h3>
                </div>
                <div class="img__text m--in">
                    <h3>Welcome Back! Please login to stay connected with us.</h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">
                <form name="f" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                    <h2>Create your Account</h2>
                    <label>
                        <span>Name</span>
                        <input type="text" name="nom" id="nom" required>
                        <div id="error-nom" class="error-message"></div>
                    </label>
                    <label>
                        <span>Last Name</span>
                        <input type="text" name="prenom" id="prenom" required>
                        <div id="error-prenom" class="error-message"></div>
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="text" name="Email" id="Email" required>
                        <div id="error-email" class="error-message"></div>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" id="password" required>
                        <div id="error-password" class="error-message"></div>
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" id="inputConfirmPassword" required>
                        <div id="error-confirm-password" class="error-message"></div>
                    </label>
                    <button type="submit" class="submit" name="olla">Create Account</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <!-- Add your footer content here -->
    </footer>

    <style>
        .cont{
            margin-top:100px;
        }


    </style>
    <!-- JavaScript Section -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // JavaScript code goes here
    </script>
    
    <script>
    $(document).on('submit', '#login', function() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            alert("Please verify that you are not a robot.");
            return false; // Prevent form submission
        }
    });
</script>


<script>
        function validateForm() {
          var nom = document.getElementById("nom").value.trim();
    var errorNom = document.getElementById("error-nom");
    var prenom = document.getElementById("prenom").value.trim();
    var errorPrenom = document.getElementById("error-prenom");
    var email = document.getElementById("Email").value.trim();
    var errorEmail = document.getElementById("error-email");
    var password = document.getElementById("password").value.trim();
    var errorPassword = document.getElementById("error-password");
    var confirmPassword = document.getElementById("inputConfirmPassword").value.trim();
    var errorConfirmPassword = document.getElementById("error-confirm-password");
    var isValid = true;

    // Clear previous errors
    errorNom.textContent = errorPrenom.textContent = errorEmail.textContent = errorPassword.textContent = errorConfirmPassword.textContent = "";

    // Validation for Name
    if (nom === "") {
        errorNom.textContent = "Please enter your first name";
        isValid = false;
    } else if (!validateAlphabetic(nom)) {
        errorNom.textContent = "Only alphabetic characters are allowed";
        isValid = false;
    }



    // Validation for Email
    if (email === "") {
        errorEmail.textContent = "Please enter your email address";
        isValid = false;
    } else if (!validateEmail(email)) {
        errorEmail.textContent = "Please enter a valid email address";
        isValid = false;
    }

    // Validation for Password
    if (password === "") {
        errorPassword.textContent = "Please enter a password";
        isValid = false;
    } else if (password.length < 8) {
        errorPassword.textContent = "Password must be at least 8 characters long";
        isValid = false;
    } else if (!hasSymbolOrNumber(password)) {
        errorPassword.textContent = "Password must contain at least one symbol or number";
        isValid = false;
    }

    // Validation for Confirm Password
    if (confirmPassword ===  "") {
        errorConfirmPassword.textContent = "Please confirm your password";
        isValid = false;
    } else if (password !== confirmPassword) {
        errorConfirmPassword.textContent = "Passwords do not match";
        isValid = false;
    }

    return isValid;
}

function hasSymbolOrNumber(input) {
    var regex = /[\W_]/; // Matches any non-word character or underscore
    var regexNumber = /[0-9]/; // Matches any digit
    return regex.test(input) || regexNumber.test(input);
}

function validateAlphabetic(input) {
    var regex = /^[a-zA-Z\s]+$/; // Matches letters and spaces
    return regex.test(input);
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function test()
{
    var nom=f.nom.value
    var prenom=f.prenom.value
    var email=f.email.value
    var pass=f.pass.value
    
    if(pass.length==0 || email.length==0 || nom.length==0 || prenom.length==0)
    {
        alert("les champs sont vide")
        
    }
    else if(pass.length<8)
        alert("tapez un mot de passe avec 8 caracetere au minimum")
    else if(email.substring(email.indexOf('@'))!='@esprit.tn')
    {
        console.log(email.substring(email.indexOf('@')))
        alert("tapez un email de esprit")
    }
    else
    {
        alert("succes !!")
    }


}
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
  
</body>
</html>
