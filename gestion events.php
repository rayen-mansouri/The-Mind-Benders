<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Organic</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../images/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <?php

    include_once __DIR__ . '/../../../Controller/event_con.php';


    $eventC = new eventCon("event");


    $liste_event = $eventC->listEvents();// stokcer les donnees de bd


    ?>

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user me-2"></i>Organic</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="images/Amira.jpg" alt="" style="width: 96px; height: 100px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Amen Sessi</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="./gestion events.php" class="nav-link "></i>Events</a>
                    </div>
                    
                </div>


            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">

                </div>
            </nav>
            <!-- Navbar End -->
            <!-- Sales Chart Start -->
            <div>


                <form action="./add_event.php" method="post" onsubmit="return verif_inp()">
                    <!-- Date Field -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter the date"
                            >
                        <div id="date_error" style="color: red;"></div>
                    </div>

                    <!-- Title Field -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title"
                            >
                        <div id="title_error" style="color: red;"></div>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"
                            placeholder="Enter the description" ></textarea>
                        <div id="description_error" style="color: red;"></div>
                    </div>

                    <!-- Price Field -->
                    <div class="mb-3">
                        <label for="prix" class="form-label">Price</label>
                        <input type="number" class="form-control" id="prix" name="prix" placeholder="Enter the price"
                            >
                        <div id="prix_error" style="color: red;"></div>
                    </div>

                    

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Ajouter Event</button>

                    <!-- Global Error and Success Messages -->
                    <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                    <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>
                </form>


            </div>
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Affichage</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">

                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($liste_event as $event) {
                                    ?>

                                    <tr>
                                        <td><?= $event['id']; ?></td>
                                        <td><?= $event['titre']; ?></td>
                                        <td><?= $event['description']; ?></td>
                                        <td><?= $event['date']; ?></td>
                                        <td><?= $event['prix']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm me-2"
                                                onclick="window.location.href = './update_event.php?id=<?= $event['id']; ?>';">Update</button>
                                            <button type="button" class="btn btn-danger btn-sm me-2"
                                                onclick="window.location.href = './delete_event.php?id=<?= $event['id']; ?>';">Delete</button>
                                        </td>
                                    </tr>


                                    <?php
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->




            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a
                                href="http://localhost:90/2A31/Projet%202/view/back/gestion%20offre/gestion%20offre.php">Organic</a>,
                            All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <p>Designed By Organic</p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

    <script src="./../../../scripts/verif_event.js"></script>
</body>

</html>