<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement les Coordonnées de votre Produit</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #555;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .delete-btn {
            color: #fff;
            background-color: #ff4d4d;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #ff1a1a;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Toggle button styling */
        .menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
        }

        .menu-toggle:hover {
            background-color: #555;
        }

        /* Sidebar menu styling */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #222;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
            z-index: 999;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #fff;
        }

        .image-slider {
            position: relative;
            width: 100%;
            max-width: 600px;
            height: 400px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-slider img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .image-slider img.active {
            opacity: 1;
        }

        .row {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .chart-placeholder {
            width: 100%;
            height: 200px;
            background: #e0e0e0;
            border-radius: 5px;
            text-align: center;
            line-height: 200px;
            color: #aaa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>

    <?php
    try {
        $dsn = "mysql:host=localhost;dbname=ges-produit"; // Adjust 'localhost' and 'ges-produit' as needed
        $user = "root";
        $password = "";

        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['delete_id'])) {
            $delete_sql = "DELETE FROM produit WHERE `id-produit` = ?";
            $delete_stmt = $pdo->prepare($delete_sql);
            $delete_stmt->execute([$_GET['delete_id']]);

            // Redirect to avoid resubmission on refresh
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Fetch all products from the database
        $sql = "SELECT * FROM produit";
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

</head>

<body>

<button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>

<!-- Sidebar Menu -->
<div id="sidebar" class="sidebar">
    <a href="#" class="close-btn" onclick="toggleMenu()">×</a>
    <a href="#home">Home</a>
    <a href="#sponsors">Sponsors</a>
    <a href="#about">About Us</a>
    <a href="#contact">Contact</a>
    <a href="#shop">Shop</a>
</div>

<script>
    // Function to toggle the sidebar menu
    function toggleMenu() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.style.width === '250px') {
            sidebar.style.width = '0';
        } else {
            sidebar.style.width = '250px';
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const images = document.querySelectorAll(".image-slider img");
        let currentIndex = 0;

        setInterval(() => {
            // Remove 'active' class from the current image
            images[currentIndex].classList.remove("active");

            // Calculate the next image index
            currentIndex = (currentIndex + 1) % images.length;

            // Add 'active' class to the next image
            images[currentIndex].classList.add("active");
        }, 3000); // Change image every 3 seconds
    });
</script>

<div class="image-slider">
    <img src="product-thumb-28.png" alt="Image 1" class="active">
    <img src="product-thumb-25.png" alt="Image 2">
    <img src="product-thumb-27.png" alt="Image 3">
</div>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Stock Unit</th>
            <th>Stock</th>
            <th>Producteur</th>
            <th>Date d'expiration</th>
            <th>Image Path</th> <!-- New column for Image Path -->
            <th>Delete Product</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id-produit']) ?></td>
                    <td><?= htmlspecialchars($product['namep']) ?></td>
                    <td><?= htmlspecialchars($product['stocku']) ?></td>
                    <td><?= htmlspecialchars($product['stock']) ?></td>
                    <td><?= htmlspecialchars($product['producteur']) ?></td>
                    <td><?= htmlspecialchars($product['date_exp']) ?></td>
                    <td><?= htmlspecialchars($product['image_path']) ?></td> <!-- Display Image Path -->
                    <td>
                        <form method="get" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            <input type="hidden" name="delete_id" value="<?= $product['id-produit'] ?>">
                            <button type="submit" class="delete-btn">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Aucun produit trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script> window.chtlConfig = { chatbotId: "2735997893" } </script>
<script async data-id
