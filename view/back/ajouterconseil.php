<?php
include_once '../../Controller/conseilC.php';
include_once '../../Model/conseil.php';

include_once '../../config.php';

    $error = "";
    // create user
    $conseil = null;
    
    $conseilC = new conseilC();
    if (
      //Vérification de la soumission du formulaire
        isset($_POST['id_con']) &&
        isset($_POST['contenu']) &&
        isset($_POST['date_pub'])
    ){
        if (
            !empty($_POST["id_con"]) &&
            !empty($_POST["contenu"]) &&
            !empty($_POST["date_pub"])
        ) {
            $conseil = new conseil(
                $_POST['id_con'],

                $_POST['contenu'] ,
                $_POST['date_pub'],
              
            );
			$conseilC->ajouter($conseil);
        }
        else
            $error = "Missing information";
   }

    if(isset($_POST['ajout']))
 	{
     	header ('Location:afficherconseil.php');
 	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agrilink</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="../text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>
  <body>
    
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo me-5" href="index.html"><img src="\integration\Agrilink-Copie\back\view\front\images\orologo.png" class="me-2" alt="logo" /></a>
    
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="assets/images/faces/face28.jpg" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="ajouterconseil.php">
      
        <span class="menu-title">Ajouter Conseil</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="afficherconseil.php">
      
        <span class="menu-title">Affichage des Conseils </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="affichecommentaire.php">
      
        <span class="menu-title">Affichage de commentaires</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="affichageUser.php">
      
        <span class="menu-title">user</span>
      </a>
    </li>
    
    <div class="buy-now">
      <a
      href="\integration\Agrilink-Copie\back\view\front\index.php"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Go to front  </a
      >
    </div>
   
    
    
                
    
  </ul>
</nav>
        <!-- ajout -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome Chahd</h3>
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly ! You have <span class="text-primary">3 unread alerts!</span></h6>
                  </div>
                  
                  <div class="col-12 col-xxl-8 order-2 order-md-3 order-xxl-2 mb-6">
  <div class="container mt-3" style="max-width: 800px; margin: 0 auto;">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <h5 class="card-title text-center">Conseil | ajouter </h5>
        <form method="POST" onsubmit="return verif();">
          <div class="row mb-3">
            <input type="text" class="form-control p-2" name="id_con" id="id_con" placeholder="Id conseil">
          </div>
          
          <div class="row mb-3">
            <textarea class="form-control p-2" placeholder="Contenu Blog" name="contenu" id="contenu"></textarea>
          </div>
          
          <div class="row mb-3">
    <input 
        type="date" 
        class="form-control p-2" 
        placeholder="Date de Publication" 
        name="date_pub" 
        id="date_pub"
        required
    >
</div>

        
          <div class="text-center">
            <input class="btn btn-primary" type="submit" name="ajout" value="Ajouter">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
              
            
         
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
  
</footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>








    <script>
  function verif() {
    const idCon = document.getElementById("id_con").value.trim();
    const contenu = document.getElementById("contenu").value.trim();
   

    // Validation flags
    let valid = true;
    let errorMessage = "";

    //  id  ET  numeric
    if (!/^\d+$/.test(idCon)) {
      errorMessage += "Id consiel must be numeric.\n";
      valid = false;
    }

    

    //  length of 10 characters
    if (contenu.length < 10) {
      errorMessage += "Contenu consiel must have at least 10 characters.\n";
      valid = false;
    }

    if (!valid) {
      alert(errorMessage);
    }

    return valid; // Form will not submit if this is false
  }
</script>




    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>