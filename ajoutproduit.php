<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement les Coordonnées de votre Produit</title>
    <link rel="stylesheet" href="styles.css">

    <?php
   try {
    $dsn = "mysql:host=localhost;dbname=ges-produit"; // Replace 'localhost' with your database hostname if different
    $user = "root";
    $password = "";

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute an SQL statement
    if (isset($_POST['submit'])) {
        // Server-side validation
        $name = trim($_POST['name']);
        $stocku = trim($_POST['stocku']);
        $producteur = trim($_POST['prod']);
        $date_exp = $_POST['dex'];

        // Ensure VARCHAR fields are < 20 characters
        if (strlen($name) > 20 || strlen($stocku) > 20 || strlen($producteur) > 20) {
            echo "Error: Each text field must be fewer than 20 characters.";
            exit; // Stop script execution if validation fails
        }

        // Ensure the expiration date is in the future
        if (strtotime($date_exp) <= strtotime(date("Y-m-d"))) {
            echo "Error: The expiration date must be in the future.";
            exit; // Stop script execution if validation fails
        }

        $sql = "INSERT INTO produit (namep, stocku, stock, producteur, date_exp) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['name'],
            $_POST['stocku'],
            $_POST['stock'],
            $_POST['prod'],
            $_POST['dex']
        ]);

        if ($stmt->rowCount() > 0) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

    ?>

<style>
        /* General styles for the body */
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
    </style>
    
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
    <a href="C:\xampp\htdocs\p\affichageproduit.php">Manage My Products</a>
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

    function validateForm() {
        let isValid = true;

        // Get form fields
        const name = document.getElementById('name').value.trim();
        const stocku = document.getElementById('stocku').value.trim();
        const prod = document.getElementById('prod').value.trim();
        const dex = new Date(document.getElementById('dex').value);
        const today = new Date();

        // Clear existing error messages
        document.getElementById('name').style.border = '';
        document.getElementById('stocku').style.border = '';
        document.getElementById('prod').style.border = '';
        document.getElementById('dex').style.border = '';

        // Validate VARCHAR fields
        if (name.length > 20) {
            alert("Name must be fewer than 20 characters.");
            document.getElementById('name').style.border = '2px solid red';
            isValid = false;
        }

        if (stocku.length > 20) {
            alert("Stock Unit must be fewer than 20 characters.");
            document.getElementById('stocku').style.border = '2px solid red';
            isValid = false;
        }

        if (prod.length > 20) {
            alert("Producteur must be fewer than 20 characters.");
            document.getElementById('prod').style.border = '2px solid red';
            isValid = false;
        }

        // Validate the expiration date
        if (dex <= today) {
            alert("The expiration date must be in the future.");
            document.getElementById('dex').style.border = '2px solid red';
            isValid = false;
        }

        return isValid;
    }
</script>

<img src="logooo.png" alt="Logo" class="top-left-image">
<div class="form-container">
    <h2>Enregistrer les Coordonnées de votre Produit</h2>
    <form method="post" onsubmit="return validateForm()">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required>

        <label for="stocku">Stock Unit:</label>
        <input type="text" id="stocku" name="stocku" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="prod">Producteur :</label>
        <input type="text" id="prod" name="prod" required>

        <label for="dex">Expiration Date :</label>
        <input type="date" id="dex" name="dex" required>

        <button type="submit" name="submit">Enregistrer</button>
    </form>
</div>

</body>
</html>
