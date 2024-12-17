<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AGRILINK</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="indexconseil.css">
  
  <style>
    

    .search-bar input {
        width: 100%;
        padding: 10px;
        border-radius: 20px;
        font-size: 16px;
    }

    .search-result {
        margin: 20px 0;
        padding: 15px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .search-result h3 {
        color: #007bff;
    }

    .search-result p {
        color: #555;
        font-size: 1em;
    }

    .footer {
        background-color: #343a40;
        color: #fff;
        padding: 30px 0;
    }

    .footer img {
        width: 160px;
        margin-bottom: 15px;
    }

    .footer .social-links a {
        color: #fff;
        margin-right: 15px;
    }

    .footer .footer-links a {
        color: #ccc;
        margin-right: 15px;
    }

    .footer .footer-links a:hover {
        color: #007bff;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <header>
    <div class="container-fluid">
      <div class="row py-3 border-bottom">
        
        <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
          <div class="d-flex align-items-center my-3 my-sm-0">
            <a href="index.html">
              <img src="images\orologo.png" alt="logo" class="img-fluid">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#menu"></use></svg>
          </button>
        </div>
        
        <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
          <div class="search-bar row bg-light p-2 rounded-4">
            
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
              <a href="index.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle pe-3" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
              <ul class="dropdown-menu border-0 p-3 rounded-0 shadow" aria-labelledby="pages">
                <li><a href="index.html" class="dropdown-item">About Us </a></li>
                <li><a href="index.html" class="dropdown-item">Shop </a></li>
                <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                <li><a href="index.html" class="dropdown-item">Cart </a></li>
                <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                <li><a href="blog.html" class="dropdown-item">Blog </a></li>
                <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                <li><a href="index.html" class="dropdown-item">Styles </a></li>
                <li><a href="index.html" class="dropdown-item">Contact </a></li>
                <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                <li><a href="index.html" class="dropdown-item">My Account </a></li>
                <li><a href="index.html" class="dropdown-item">404 Error </a></li>
              </ul>
            </li>
          </ul>
        </div>
        
        <div class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
          <ul class="d-flex justify-content-end list-unstyled m-0">
            <li>
              <a href="#" class="p-2 mx-1">
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
      

  <!-- Recherche et Résultats -->
  <div class="container mt-5">
    <h2 class="text-center mb-4">Résultats de la recherche</h2>

    <?php
    include_once '../../config.php';  // Inclure votre fichier de connexion à la base de données

    // Vérifier si le terme de recherche est soumis via POST
    if (isset($_POST['search_term']) && !empty($_POST['search_term'])) {
        $searchTerm = $_POST['search_term'];

        // Connexion à la base de données
        $pdo = Database::getConnexion();

        // Requête SQL pour rechercher le mot-clé dans la colonne 'contenu' de la table 'conseil'
        $query = $pdo->prepare("SELECT * FROM conseil WHERE contenu LIKE :searchTerm");
        $query->execute(['searchTerm' => '%' . $searchTerm . '%']);

        // Récupérer les résultats
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Vérifier si des résultats sont trouvés
        if ($results) {
            foreach ($results as $result) {
                echo "<div class='search-result'>";
                echo "<h3>" . htmlspecialchars($result['contenu']) . "</h3>"; //convertir les carctere en html
                echo "<p>Publié le: " . $result['date_pub'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<div class='search-result'>";
            echo "<p>Aucun conseil trouvé pour le mot-clé : '$searchTerm'.</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Veuillez entrer un mot-clé de recherche.</p>";
    }
    ?>
  </div>

  <!-- FOOTER -->
  <footer class="footer text-center">
    <div class="container-lg">
      <img src="images\orologo.png" width="160" alt="logo" class="mb-3">
      <div class="social-links mb-3">
        <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
        <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
        <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
        <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
        <a href="#" class="btn btn-outline-light btn-sm"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
      </div>
      <div class="footer-links">
        <a href="#" class="text-light me-3">Facebook</a>
        <a href="#" class="text-light me-3">Produit</a>
        <a href="#" class="text-light me-3">Instagram</a>
        <a href="#" class="text-light">Réclamation</a>
      </div>
      <p class="small mt-3 mb-0">© 2024 AgriLink. All rights reserved.</p>
    </div>
  </footer>

</body>
</html> 