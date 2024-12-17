
<?php
include_once '../../controller/conseilC.php';
include_once '../../controller/commentaireC.php';
include_once '../../controller/likesC.php';


$s = new conseilC();
$commentaireC = new commentaireC();
$voteController = new VoteController(); 
//affichage
  $tab = $s->afficher();

?>


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


<link rel="stylesheet" href="indexconseil.css">
  <style>
        header {
            background-color: white;
            color: black; /* Ensuring text is visible */
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


  
  
  <section id="latest-blog" class="pb-4">
    <div class="container-lg">
      <div class="row">
        <div class="section-header d-flex align-items-center justify-content-between my-4">
          <h2 class="section-title">Our Recent Blog</h2>
          <a href="#" class="btn btn-primary">View All</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          
        <h1>FarmerBook</h1>
        
        
        <div class="pdf-container">
            <!-- Intégration du fichier PDF comme cours -->
            <iframe src="farmerbook.pdf"></iframe>
        </div>
        <p>
            <a href="farmerbook.pdf" download>Télécharger ce cours</a>
        </p>
    </div>
    


    
      </div>

        
         
              
              

      <h3 class="text-uppercase font-weight-bold wow-outer" style="margin-bottom: 30px;">
        <span class="wow slideInDown">Nos Conseils :</span>
    </h3>
    <div class="row row-lg-55 row-40 offset-top-3">
        <?php foreach ($tab as $conseil) { ?>
            <div class="col-md-6 wow-outer" style="margin-bottom: 20px;">
                <!-- Post Modern-->
                <article class="post-modern wow slideInLeft">
                    
                
                        
                           
                            <p style="font-size:15px;"> <?= $conseil['contenu'] ?></p>
                            <p style="font-size:15px;">Date Pub  : <?= $conseil['date_pub'] ?></p>
                  <!-- Comment Form -->
<form method="POST" action="ajoutCommentaire.php" onsubmit="return validateCommentForm();">
    <input type="hidden" name="id_con" value="<?= $conseil['id_con'] ?>">
    <textarea id="contenu" name="contenu" placeholder="Ajouter un commentaire" class="form-control mb-2" rows="3" required></textarea>
    
    <!-- Error message for validation -->
    <div id="error-message" style="color: red; display: none;">Le commentaire doit contenir au moins 10 caractères.</div>
    
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>





<h5 class="mt-4">Commentaires :</h5>
<div class="comment-section border rounded p-3">
    <?php 
    // Charger les commentaires pour le conseil actuel
    $commentaires = $commentaireC->afficherCommentaires($conseil['id_con']);
    if (!empty($commentaires)) {
        foreach ($commentaires as $commentaire) {
          $votes = $voteController->getVotesByComment($commentaire['id_cmnt']);
        $totalLikes = $votes['total_likes'] ?? 0;
        $totalDislikes = $votes['total_dislikes'] ?? 0; ?>
            <div class="comment mb-3">
            <p><strong>Date :</strong> <?= $commentaire['date_pub'] ?></p>
            <p id="contenu-comment-<?= $commentaire['id_cmnt'] ?>">
                <?= htmlspecialchars($commentaire['contenu']) ?>
            </p>
              
                
            <button class="btn btn-success" onclick="likeComment(<?= $commentaire['id_cmnt'] ?>, 'like')">👍 Like</button>
            <button class="btn btn-danger" onclick="likeComment(<?= $commentaire['id_cmnt'] ?>, 'dislike')">👎 Dislike</button>
            <span id="like-count-<?= $commentaire['id_cmnt'] ?>"><?= $totalLikes ?></span> Likes
            <span id="dislike-count-<?= $commentaire['id_cmnt'] ?>"><?= $totalDislikes ?></span> Dislikes
        
                <!-- Formulaire d'édition (initialement caché) -->
                <form action="uppdatecommentaire.php" method="post" style="display:none;" id="form-update-<?= $commentaire['id_cmnt'] ?>">
                    <input type="hidden" name="id_cmnt" value="<?= $commentaire['id_cmnt'] ?>">
                    <textarea name="contenu" rows="3"><?= htmlspecialchars($commentaire['contenu']) ?></textarea>
                    <button type="submit" class="btn btn-warning btn-sm">Enregistrer</button>
                </form>

                <!-- Bouton pour activer le formulaire d'édition -->
                <button class="btn btn-warning btn-sm" onclick="toggleEditForm(<?= $commentaire['id_cmnt'] ?>)">Update</button>
                <hr>
            </div>
        <?php } 
    } else { ?>
        <p class="text-muted">Aucun commentaire pour le moment.</p>
    <?php } ?>
</div>

                
                    
                </article>
            </div>
        <?php } ?>
    </div>

          
          <footer class="py-4 bg-dark text-light">
            <div class="container-lg text-center">
              <img src="images\orologo.png" width="160" alt="logo" class="mb-3">
              <div class="social-links mb-3">
                <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
                <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
                <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
                <a href="#" class="btn btn-outline-light btn-sm me-2"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
                <a href="#" class="btn btn-outline-light btn-sm"><svg width="16" height="16"><use xlink:href="#"></use></svg></a>
              </div>
              <div class="footer-links">
                <a href="#" class="text-light me-3">facebook</a>
                <a href="#" class="text-light me-3">produit</a>
                <a href="#" class="text-light me-3">instagram</a>
                <a href="#" class="text-light">reclamation</a>
              </div>
              <p class="small mt-3 mb-0">© 2024 AgriLink. All rights reserved.</p>
            </div>
          </footer>
          <script> window.chtlConfig = { chatbotId: "2735997893" } </script>
<script async data-id="2735997893" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
  

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sélectionnez tous les formulaires de commentaire
        const commentForms = document.querySelectorAll("form[action='ajoutCommentaire.php']");

        commentForms.forEach((form) => {
            form.addEventListener("submit", function (event) {
                // Sélectionner la zone de texte pour le commentaire
                const textarea = form.querySelector("textarea[name='contenu']");
                const errorMessage = form.querySelector("#error-message");

                // Réinitialiser le message d'erreur (au cas où il existe déjà)
                if (errorMessage) {
                    errorMessage.style.display = "none";
                }

                // Vérifier si le contenu du commentaire respecte les critères
                if (!textarea || textarea.value.trim().length < 10) {
                    // Empêcher l'envoi du formulaire
                    event.preventDefault();

                    // Afficher le message d'erreur
                    if (errorMessage) {
                        errorMessage.style.display = "block";
                        errorMessage.textContent = "Le commentaire doit contenir au moins 10 caractères.";
                    }
                }
            });
        });
    });
</script>



<script>
    function toggleEditForm(id) {
        // Masquer tous les formulaires d'édition
        const forms = document.querySelectorAll('form[id^="form-update-"]');
        forms.forEach(form => {
            form.style.display = 'none';
        });

        // Masquer le texte du commentaire
        const content = document.querySelectorAll('p[id^="contenu-comment-"]');
        content.forEach(p => {
            p.style.display = 'block';
        });

        // Afficher le formulaire d'édition
        const form = document.getElementById('form-update-' + id);
        const commentContent = document.getElementById('contenu-comment-' + id);

        // Cacher le texte du commentaire pendant l'édition
        commentContent.style.display = 'none';
        form.style.display = 'block';
    }
</script>
<script>
 function likeComment(idCmnt, voteType) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Ajoutlikes.php', true); // Remplacez par le chemin correct
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Mettre à jour les compteurs de likes et dislikes
            var response = JSON.parse(xhr.responseText);
            document.getElementById("like-count-" + idCmnt).innerHTML = response.total_likes;
            document.getElementById("dislike-count-" + idCmnt).innerHTML = response.total_dislikes;
        }
    };
    xhr.send('id_cmnt=' + idCmnt + '&voteType=' + voteType);
}


</script>


          
          
        
</body>
</html>