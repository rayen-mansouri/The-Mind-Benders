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

    <!-- External JavaScript (Validation) -->
    <script src="./../../../scripts/verif_event.js"></script>
</head>

<body>

    <?php
    include_once __DIR__ . '/../../../Controller/event_con.php';
    include_once __DIR__ . '/../../../Model/event.php';

    $eventC = new eventCon("event");

    $event = null;

    if (isset($_GET['id'])) {
        $current_id = $_GET['id'];
        $event = $eventC->getEvent($current_id);
    }

    if (isset($_POST["date"]) && isset($_POST["titre"]) && isset($_POST["description"]) && isset($_POST["prix"])) {
        if (!empty($_POST["date"]) && !empty($_POST["titre"]) && !empty($_POST["description"]) && !empty($_POST["prix"])) {
            $updatedEvent = new Event($current_id, $_POST['titre'], $_POST['description'], $_POST['date'], $_POST['prix']);
            $eventC->updateEvent($updatedEvent, $current_id);
            header('Location: ../../../view/back/gestion events/gestion events.php');
        } else {
            $error = "Missing information";
        }
    }
    ?>

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar & Content setup remains unchanged -->

        <div class="content">
            <div class="container mt-4">
                <!-- Form Start -->
                <form action="" method="post">
                    <!-- Date Field -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($event['date']); ?>" >
                        <div id="date_error" style="color: red;"></div>
                    </div>

                    <!-- Title Field -->
                    <div class="mb-3">
                        <label for="titre" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Enter the title" value="<?= htmlspecialchars($event['titre']); ?>" >
                        <div id="title_error" style="color: red;"></div>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" ><?= htmlspecialchars($event['description']); ?></textarea>
                        <div id="description_error" style="color: red;"></div>
                    </div>

                    <!-- Price Field -->
                    <div class="mb-3">
                        <label for="prix" class="form-label">Price</label>
                        <input type="number" class="form-control" id="prix" name="prix" placeholder="Enter the price" value="<?= htmlspecialchars($event['prix']); ?>" >
                        <div id="prix_error" style="color: red;"></div>
                    </div>

                    

                    <!-- Submit Button -->
                    <button type="submit" onclick="return verif_inp_update()" class="btn btn-primary">Update Event</button>

                    <!-- Error Message -->
                    <?php if (isset($error)) { ?>
                        <div class="mt-3 alert alert-danger"><?= $error; ?></div>
                    <?php } ?>
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src = "./../../../scripts/verif_event.js"></script>
</body>

</html>
