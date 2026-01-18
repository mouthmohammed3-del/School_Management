<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electronic School Library</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'includes/header.php'; ?>
    
    <!-- Include Products Data -->
    <?php include 'products.php'; ?>
    
    <!-- Main Content -->
    <main class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Search Input -->
                <div class="search-container mb-4">
                    <input type="text" id="search-input" class="form-control" 
                           placeholder="Search products by name or description..." 
                           aria-label="Search products">
                </div>
            </div>
        </div>
        
        <!-- Products Container -->
        <div class="row" id="products-container">
            <?php foreach($products as $product): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4 product-item" 
                 data-name="<?php echo strtolower($product['name']); ?>"
                 data-description="<?php echo strtolower($product['description']); ?>">
                <div class="product-card card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <img src="<?php echo $product['img']; ?>" 
                             class="card-img-top mb-3" 
                             alt="<?php echo htmlspecialchars($product['name']); ?> book cover">
                        <p class="card-text description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="price mb-3">
                            <span>$<?php echo $product['price']; ?></span>
                            <span class="checkmark ms-2" aria-hidden="true">✓</span>
                        </div>
                        <button class="btn btn-success buy-btn w-100 mb-2">Buy</button>
                        <div class="like-dislike-container d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-success like-btn">
                                <i class="far fa-heart"></i> Like
                            </button>
                            <button class="btn btn-outline-danger dislike-btn">
                                <i class="far fa-thumbs-down"></i> Dislike
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item mx-3">
                            <a href="https://github.com/mouthmohammed3-del" target="_blank" class="text-light">
                                <i class="fab fa-github fa-2x"></i>
                                <p class="mt-2">Mouth-Alyaari</p>
                            </a>
                        </li>
                        <li class="list-inline-item mx-3">
                            <a href="tel:778532787" class="text-light">
                                <i class="fas fa-phone fa-2x"></i>
                                <p class="mt-2">778532787</p>
                            </a>
                        </li>
                        <li class="list-inline-item mx-3">
                            <a href="https://facebook.com" target="_blank" class="text-light">
                                <i class="fab fa-facebook-f fa-2x"></i>
                                <p class="mt-2">my facebook</p>
                            </a>
                        </li>
                    </ul>
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Electronic School Library. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="js/main.js"></script>
    
    <!-- Pass PHP data to JavaScript -->
    <script>
        const products = <?php echo $products_json; ?>;
    </script>
</body>
</html>