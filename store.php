<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .search-bar {
            margin: 20px auto;
            text-align: center;
        }

        .search-bar input, .search-bar select {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px;
            padding: 0;
        }

        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .details {
            padding: 10px;
            text-align: center;
        }

        .product-card .details h3 {
            font-size: 18px;
            margin: 0 0 10px;
        }

        .product-card .details p {
            margin: 5px 0;
            color: #555;
        }

        .add-to-cart-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            width: 100%;
        }

        .add-to-cart-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Products</h1>
    </header>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher par nom, producteur, ou date d'expiration">
        <select id="categoryFilter">
            <option value="">Toutes les catégories</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Dairy">Dairy</option>
            <option value="Grains">Grains</option>
            <option value="Others">Others</option>
        </select>
    </div>

    <div class="product-grid" id="productGrid">
        <?php
        try {
            $dsn = "mysql:host=localhost;dbname=ges-produit";
            $user = "root";
            $password = "";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch all products
            $stmt = $pdo->query("SELECT * FROM produit");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($products)) {
                foreach ($products as $product) {
                    echo '<div class="product-card" 
                            data-name="' . htmlspecialchars($product['namep']) . '" 
                            data-producer="' . htmlspecialchars($product['producteur']) . '" 
                            data-expiration="' . htmlspecialchars($product['date_exp']) . '" 
                            data-category="' . htmlspecialchars($product['category']) . '">';
                    
                    // Display the product image or a placeholder if not available
                    if (!empty($product['image_path']) && file_exists($product['image_path'])) {
                        echo '<img src="' . htmlspecialchars($product['image_path']) . '" alt="Image de produit">';
                    } else {
                        echo '<img src="placeholder.png" alt="Image non disponible">';
                    }

                    echo '<div class="details">';
                    echo '<h3>' . htmlspecialchars($product['namep']) . '</h3>';
                    echo '<p>Stock: ' . htmlspecialchars($product['stock']) . ' ' . htmlspecialchars($product['stocku']) . '</p>';
                    echo '<p>Producteur: ' . htmlspecialchars($product['producteur']) . '</p>';
                    echo '<p>Catégorie: ' . htmlspecialchars($product['category']) . '</p>';
                    echo '<p>Date d\'expiration: ' . htmlspecialchars($product['date_exp']) . '</p>';
                    echo '</div>';
                    echo '<button class="add-to-cart-btn">Add to Cart</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun produit trouvé.</p>';
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
    </div>

    <script>
        // Filter products by search input and category
        document.getElementById('searchInput').addEventListener('input', filterProducts);
        document.getElementById('categoryFilter').addEventListener('change', filterProducts);

        function filterProducts() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('categoryFilter').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const productName = product.getAttribute('data-name').toLowerCase();
                const productProducer = product.getAttribute('data-producer').toLowerCase();
                const productExpiration = product.getAttribute('data-expiration').toLowerCase();
                const productCategory = product.getAttribute('data-category').toLowerCase();

                // Check if product matches the search and selected category
                const matchesSearch = productName.includes(searchQuery) || productProducer.includes(searchQuery) || productExpiration.includes(searchQuery);
                const matchesCategory = selectedCategory === '' || productCategory === selectedCategory;

                product.style.display = (matchesSearch && matchesCategory) ? 'block' : 'none';
            });
        }
    </script>


<script> window.chtlConfig = { chatbotId: "2735997893" } </script>
<script async data-id="2735997893" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
</body>
</html>
