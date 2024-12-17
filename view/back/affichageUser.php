
<?php
include_once '../../Controller/UserC.php';
include_once "../../config.php";
include_once '../../connexion.php';

$UserC= new userC();
$listeC = $UserC->afficherUserC();
session_start();
    
    

try {
  $count = $pdo->prepare("SELECT COUNT(id) AS cpt FROM utilisateur");
  $count->execute();
  $tcount = $count->fetch(PDO::FETCH_ASSOC);
  
  

  // Check if $tcount contains the key "cpt"
  if(isset($tcount["cpt"])) {
      // Pagination
      $page = isset($_GET["page"]) ? $_GET["page"] : 1;
      $nbr_elements_par_page = 5;
      $nbr_de_pages = ceil($tcount["cpt"] / $nbr_elements_par_page);
      $debut = ($page - 1) * $nbr_elements_par_page;

      // Retrieve the records
      $sel = $pdo->prepare("SELECT id, nom, email, password FROM utilisateur ORDER BY id LIMIT $debut, $nbr_elements_par_page");
      $sel->execute();
      $listeC = $sel->fetchAll(PDO::FETCH_ASSOC);

      // Check if $listeC is null or empty
      if (!$listeC) {
          $listeC = []; // Initialize $listeC as an empty array
      }
  } else {
      // Handle the case where "cpt" key is not present in $tcount
      echo "Error: 'cpt' key not found in the result set.";
  }
} catch (PDOException $e) {
  // Handle any PDO exceptions (database errors)
  echo "PDO Exception: " . $e->getMessage();
  // You may want to log the error or handle it differently based on your application's requirements
  exit();
}

if (
    isset($_POST['nom']) &&
   isset($_POST['prenom']) &&
    isset($_POST['Email']) &&                  
    isset($_POST['password'])  
) {
    if (
        !empty($_POST['nom']) &&
           !empty($_POST['prenom']) &&
            !empty($_POST['Email']) &&
            !empty($_POST['password'])
        
    ) {
        $user =new User (
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['Email'],
            $_POST['password']
        );
        $userC->ajouterUser($user,"noimage.png");
        
        header('Location:affichageAdmin.php');
    }
    else
        $error = "Missing information";
}
if (isset($_POST["rech"])&&isset($_POST["search"])) {
    if(!empty($_POST["rech"]))
    $listeC = $UserC->afficherAdminRech( $_POST['rech'],$_POST['selon']);}

$userC = new userC();

// Gérer la réinitialisation
if (isset($_POST['reset'])) {
    $listeC = $userC->afficherAdminDetail();
}

// Gérer la recherche
/*if (isset($_POST['search'])) {
    $rech = $_POST['rech'];
    $selon = $_POST['selon'];
    $listeC = $adminC->afficherAdminRech($rech, $selon); // Supposons que vous avez une méthode searchAdmin dans votre classe adminC
} 
*/

/*if (isset($_POST["rech"])&&isset($_POST["search"])) {
    if(!empty($_POST["rech"]))
    $listeC = $adminC->searchAdmin( $_POST['rech'],$_POST['selon']);
 }*/    

// Gérer le tri
if (isset($_POST['tri'])) {
    $tri = $_POST['tri'];
    // Supposons que vous avez une méthode de tri dans votre classe adminC
    $listeC = $userC->afficherAdminTrie($tri);
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Organic Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="\integration\Agrilink-Copie\back\view\front\images\orologo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="\integration\Agrilink-Copie\back\view\front\images\orologo.png" alt="logo"/></a>
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
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
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
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
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
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
            <div class="button-containerr">
                <!--  <button class="edit-button"  type="button" id="editButton">Speech to Text</button> -->
                <a href="logout.php"  class="edit-button" type="button">Logout </a> 
             </div> 
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          
          
          
          
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="ajouterUser.php"> Ajouter des utilisateurs </a></li>
                <li class="nav-item"> <a class="nav-link" href="affichageUser.php"> Afficher les utilisateurs </a></li>
                <li class="nav-item"> <a class="nav-link" href="supprimerUser.php"> Supprimer les utilisateurs </a></li>
                <li class="nav-item"> <a class="nav-link" href="modifierUser.php"> Modifier les utilisateurs </a></li>



              </ul>
            </div>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="ajouterconseil.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">getion de bolg</span>
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
      
      <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <thead>
             <form method="POST" action="affichageUser.php">
             <input type="submit" value="reset" >
           
              <input type="text" class="field small-field" name="rech"/>
              <select name="selon" class="field small-field" >
              
              <option value="nom">nom</option>
              <option value="email">email</option>
              
            </select>
              <input type="submit" class="button" value="search" name="search" /></form>
            </div>
          
          <div id="sidebar">
        <!-- Box -->  <div class="sort">
              <form method="POST"><label>Sort by</label>
              <select name="tri" class="field" >
              
                <option value="nom">nom</option>
                <option value="email">email</option>
                
                
              </select><input type="submit"  value="trier"></form>
              
            </div>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
        <tr>
             
             <th>ID</th>
             <th>Nom</th>    
             <th>Email</th>
             <th>Mot de passe</th>
             
             
           
            
           </tr>

           

           <?php
 foreach($listeC as $user){
     ?>


           <tr>
             <td><?php echo $user['id']; ?></td>
             <td><?php echo $user['nom']; ?></td>
             
             <td><?php echo $user['email']; ?></td> 
             
           
             <td><?php echo $user['password']; ?></td>
            
             <td><a href="supprimerUser.php?id=<?php echo $user['id']; ?>" class="ico del">Delete</a> </td>
             <td> <a href="modifierUser.php?id=<?php echo $user['id']; ?>" class="ico edit">Edit</a>

             
           
           
           
           </td>
           </tr>
           <?php } ?>
           
           
           
           
           
           
         
            
          
         
                              </table>
                              <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $nbr_de_pages; $i++) : ?>
                            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

