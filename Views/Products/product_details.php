<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title><?= htmlspecialchars($product['product_name']) ?> - Product Details</title>  
    <link rel="stylesheet" href="../Assets/css/product_details.css">  
</head>  
<body>  
    <div class="container">  
        <div class="header">  
            <h1><?= htmlspecialchars($product['product_name']) ?></h1>  
            <p class="price"><?= number_format($product['price'], 2) ?>$</p>  
        </div>  
        
        <div class="product-images">  
            <img src="../../Assets/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" class="main-image">  
            <!-- Additional images can enhance the product view -->  
            <div class="additional-images">  
                <?php foreach ($product['additional_images'] as $image): ?>  
                    <img src="../../Assets/images/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product['product_name']) ?> - Additional View" class="additional-image">  
                <?php endforeach; ?>  
            </div>  
        </div>  

        <div class="product-details">  
            <h2>Description</h2>  
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>  
            
            <h3>Specifications</h3>  
            <ul>  
                <li>Type: <?= htmlspecialchars($product['type']) ?></li>  
                <li>Color: <?= htmlspecialchars($product['color']) ?></li>  
                <li>Dimensions: <?= htmlspecialchars($product['dimensions']) ?></li>  
                <li>Weight: <?= htmlspecialchars($product['weight']) ?> kg</li>  
                <li>Date Added: <?= date("d/m/Y", strtotime($product['date'])) ?></li>  
            </ul>  
        </div>  

        <div class="reviews">  
            <h3>User Reviews</h3>  
            <?php if (!empty($reviews)): ?>  
                <?php foreach ($reviews as $review): ?>  
                    <div class="review">  
                        <p><strong><?= htmlspecialchars($review['user_name']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?></p>  
                    </div>  
                <?php endforeach; ?>  
            <?php else: ?>  
                <p>No reviews yet.</p>  
            <?php endif; ?>  
        </div>  

        <div class="add-to-cart">  
            <form action="/cart/add" method="POST">  
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">  
                <button type="submit" class="add-to-cart-button">Add to Cart</button>  
            </form>  
        </div>  

        <a href="/products" class="back-link">Back to Product List</a>  
    </div>  
</body>  
</html>  