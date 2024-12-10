<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement les Coordonnées de votre Produit</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 80%;
            margin: auto;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Enregistrer les Coordonnées de votre Produit</h2>
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required>

        <label for="stocku">Stock Unit:</label>
        <input type="text" id="stocku" name="stocku" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="prod">Producteur :</label>
        <input type="text" id="prod" name="prod" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="">Select a category</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Dairy">Dairy</option>
            <option value="Grains">Grains</option>
            <option value="Others">Others</option>
        </select>

        <label for="dex">Expiration Date :</label>
        <input type="date" id="dex" name="dex" required>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit" name="submit">Enregistrer</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    try {
        // Database connection
        $dsn = "mysql:host=localhost;dbname=ges-produit";
        $user = "root";
        $password = "";
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect form data
        $name = trim($_POST['name']);
        $stocku = trim($_POST['stocku']);
        $stock = intval($_POST['stock']);
        $producteur = trim($_POST['prod']);
        $category = trim($_POST['category']);
        $date_exp = $_POST['dex'];

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $imageFileName = uniqid('product_', true) . '.' . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $uploadPath = $uploadDir . $imageFileName;

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                // Insert into database
                $sql = "INSERT INTO produit (namep, stocku, stock, producteur, category, date_exp, image_path) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $stocku, $stock, $producteur, $category, $date_exp, $uploadPath]);

                if ($stmt->rowCount() > 0) {
                    echo "<p style='color: green; text-align: center;'>Product added successfully!</p>";
                } else {
                    echo "<p style='color: red; text-align: center;'>Error saving product data to the database.</p>";
                }
            } else {
                echo "<p style='color: red; text-align: center;'>Error uploading the image.</p>";
            }
        } else {
            echo "<p style='color: red; text-align: center;'>No image uploaded or upload error.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red; text-align: center;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<script>
    function validateForm() {
        let isValid = true;

        const name = document.getElementById('name').value.trim();
        const stocku = document.getElementById('stocku').value.trim();
        const prod = document.getElementById('prod').value.trim();
        const dex = new Date(document.getElementById('dex').value);
        const today = new Date();

        document.getElementById('name').style.border = '';
        document.getElementById('stocku').style.border = '';
        document.getElementById('prod').style.border = '';
        document.getElementById('dex').style.border = '';

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

        if (dex <= today) {
            alert("The expiration date must be in the future.");
            document.getElementById('dex').style.border = '2px solid red';
            isValid = false;
        }

        return isValid;
    }
</script>

</body>
</html>
