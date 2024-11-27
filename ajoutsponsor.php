
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistre les Coordonnées de votre Societe</title>
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
        $sql = "INSERT INTO sp (namesp, field, funding, type, datec) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['name'],
            $_POST['field'],
            $_POST['funding'],
            $_POST['type'],
            $_POST['Date']
        ]);

        if ($stmt->rowCount() > 0) {
            echo "Company information added successfully!";
        } else {
            echo "Error: Unable to add company information.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

    

<style>
        /* General styles for the body */
        body {
            background-image: url('banner-ad-3.jpg');
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
    </script>
   



<img src="logooo.png" alt="Logo" class="top-left-image">
    <div class="form-container">
        <h2>Enregistrer les Coordonnées de votre societe</h2>
        <form method="post">
    <label for="name">Name :</label>
    <input type="text" id="name" name="name" required>

    <label for="stocku">field</label>
    <input type="text" id="field" name="field" required>

    <label for="stock">Funding:</label>
    <input type="number" id="funding" name="funding" required>

    <label for="prod">Type Collaboration:</label>
    <input type="text" id="type" name="type" required>

    <label for="dex">Date of Collaboration :</label>
    <input type="date" id="date" name="Date" required>

    
    <button type="submit" name="submit">Enregistrer</button>
</form>

   
</body>
</html>
