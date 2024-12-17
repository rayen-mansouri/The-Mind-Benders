<?php
session_start();
include_once "../../controller/UserC.php";
include_once "../../model/User.php";
require_once '../../config.php';


// Redirect to signin.php if user is not logged in
if (!isset($_SESSION['act'])) {
    header('location:signin.php');
    exit(); // Add exit to stop further execution
}

$error = "";
$user = null;
$userC = new userC();
$id = $_SESSION['id'];
$liste = $userC->user($id);

// Check if $liste is not null before accessing its elements
if (!empty($liste)) {
    $_SESSION['nom'] = $liste['nom'];
    $_SESSION['prenom'] = $liste['prenom'];
    $_SESSION['email'] = $liste['email'];
    $_SESSION['password'] = $liste['password'];

    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
} else {
    // Handle the case where $liste is null or empty
    // You can redirect the user or display an error message
    echo "Error: User data not found!";
    exit(); // Add exit to stop further execution
}

// Process form submission
if (isset($_POST['supp'])) {
    $userC->SupprimerAdmin($id);
    header('location:signin.php');
    exit(); // Add exit to stop further execution
}

if (isset($_POST['edit'])) {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])) {
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
            $user = new User(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                "00000"
            );
            $userC->ModifierUser($user, $id);
        } else {
            $error = "Missing information !";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXT WEBSITE</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="assets/css/signins.css"> 

     <!-- Bootstrap core CSS -->
     <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Additional CSS Files -->
<link rel="stylesheet" href="assets/css/fontawesome.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/owl.css">
    <style>

/* General Body Style */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f7f6;
    color: #333;
    margin: 0;
    padding: 0;
}
header {
            background-color: white;
            color: black; /* Ensuring text is visible */
        }
/* Container Style */
.containerr {
    background-color: #ffffff;
    margin-top: 80px;
    margin-bottom: 80px;
    max-width: 900px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-left: auto;
    margin-right: auto;
}

/* Form and Table Styling */
table {
    width: 100%;
    margin-top: 20px;
}
table td {
    padding: 12px;
    text-align: left;
}
table td input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 2px solid #A8D5BA;
    background-color: #e4f0e6;
    font-size: 16px;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

/* Hover Effects on Input Fields */
table td input:focus {
    outline: none;
    border-color: #4CAF50;
    background-color: #fff;
}

/* Button Styling */
.edit-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.edit-button:hover {
    background-color: #388E3C;
    transform: translateY(-2px);
}


/* Input Field Styling */
.form-control {
    width: 100%;
    padding: 15px;
    background-color: #fff;
    border-radius: 15px;
    margin-top: 15px;
    border: 2px solid #A8D5BA;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

/* Responsive Design for Mobile */
@media screen and (max-width: 768px) {
    .containerr {
        margin-left: 20px;
        margin-right: 20px;
    }

    .main {
        width: 100%;
        padding: 15px;
    }

    table td {
        display: block;
        margin-bottom: 15px;
    }

    table td input {
        width: 100%;
    }

    .edit-button {
        width: 100%;
        margin-top: 15px;
    }
}

    </style>
</head>
<body>
 <header>
      <div class="container-fluid">
        <div class="row py-3 border-bottom">
          
          <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
            <div class="d-flex align-items-center my-3 my-sm-0">
              <a href="index.html">
                <img src="logoo.png" alt="logo" class="img-fluid">
              </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
              aria-controls="offcanvasNavbar">
              <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#menu"></use></svg>
            </button>
          </div>
          
          <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
            <div class="search-bar row bg-light p-2 rounded-4">
              <div class="col-md-4 d-none d-md-block">
                
              </div>
              <div class="col-11 col-md-7">
              <form id="search-form" class="text-center" action="recherche.php" method="post">
    <input type="text" class="form-control border-0 bg-transparent" placeholder="Search for more than 20,000 products" name="search_term" required>
</form>
              </div>
              <div class="col-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/></svg>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <ul class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
              <li class="nav-item active">
                <a class="nav-link" href="ProfilUser.php">Profile
                </a>
              </li>
              <li class="nav-item active">
                <a href="index.php" class="nav-link">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                  <li><a href="index.html" class="dropdown-item">About Us </a></li>
                  <li><a href="index.html" class="dropdown-item">Shop </a></li>
                  <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                  <li><a href="index.html" class="dropdown-item">Cart </a></li>
                  <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                  <li><a href="indexconseil.php" class="dropdown-item">Blog </a></li>
                  
                </ul>
              </li>
            </ul>
          </div>
          
          <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
            <ul class="d-flex justify-content-end list-unstyled m-0">
              <div class="button-containerr">
                <!--  <button class="edit-button"  type="button" id="editButton">Speech to Text</button> -->
                <a href="logout.php"  class="edit-button" type="button">Logout </a> 
             </div>  
             
              <li>
                
                <a href="signin.php" class="p-2 mx-1">
                  <svg width="24" height="24"><use xlink:href="#user"></use></svg>
                </a>
              </li>
              <li>
                <a href="#" class="p-2 mx-1">
                  <svg width="24" height="24"><use xlink:href="#wishlist"></use></svg>
                </a>
              </li>
              <li>
                <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                  <svg width="24" height="24"><use xlink:href="#shopping-bag"></use></svg>
                </a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </header>



    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->


<div class="containerr">
    <div class="main">
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <form name="f" action="" method="POST">
                    <table>
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input id="nom" name="nom" class="form-control" value="<?php echo $nom ?>"></td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td>:</td>
                            <td><input type="text" name="prenom" class="form-control" value="<?php echo $prenom ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="Email" class="form-control" value="<?php echo $email ?>"></td>
                        </tr>
                        </tbody>
                    </table>
                    

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('editButton').addEventListener('click', function() {
        var fields = ['nom', 'prenom', 'Email'];

        fields.forEach(function(field) {
            var element = document.getElementById(field);
            var value = element.value;
            element.outerHTML = '<input type="text" class="form-control" value="' + value + '" id="' + field + '">';
        });

        this.style.display = 'none'; // Hide the edit button after clicking
    });
</script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>
</body>
</html>
