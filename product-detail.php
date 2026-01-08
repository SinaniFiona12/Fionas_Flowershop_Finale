<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/Product.php");
    include_once(__DIR__ . "/classes/Review.php");
    

    
    $productId = $_GET['id'] ?? null;
    $product = null;

    
    if ($productId) {
        $product = Product::getById($productId);
    }

    
    if (!$product) {
        header("Location: product-listing.php");
        exit;
    }

    
    if(isset($_POST['review_text']) && isset($_SESSION['user'])) {
        try {
            $review = new Review();
            $review->setProductId($productId);
            $review->setUserEmail($_SESSION['user']['email']); 
            $review->setText($_POST['review_text']);
            $review->save();
            
            
            header("Location: product-detail.php?id=" . $productId);
            exit();
        } catch(Exception $e) {
            $reviewError = $e->getMessage();
        }
    }

    
    $reviews = Review::getAllForProduct($productId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($product['name']); ?> | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="shop-styles.css" />
</head>
<body>

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="container detail-layout" style="padding: 4rem 0;">
    <div class="detail-content">
      <div class="detail-image-wrapper">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
      </div>
      
      <div class="detail-text">
        <p class="breadcrumbs"><a href="product-listing.php">Shop</a> / <?php echo htmlspecialchars($product['name']); ?></p>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
        <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
        
        <form method="post" action="cart.php" style="margin-bottom: 2rem;">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button class="btn">Add to Cart</button>
        </form>

        <div class="reviews-section" style="margin-top: 3rem; border-top: 1px solid #eee; padding-top: 2rem;">
            <h3 style="font-family: 'Italiana', serif; margin-bottom: 1rem;">Customer Reviews</h3>
            
            <?php if(isset($reviewError)): ?>
                <p style="color:red;"><?php echo $reviewError; ?></p>
            <?php endif; ?>

            <?php if(isset($_SESSION['user'])): ?>
                <form method="post" style="margin-bottom: 2rem;">
                    <div class="form-group">
                        <textarea name="review_text" rows="3" placeholder="Write a review about this product..." style="width:100%; padding:0.8rem; border:1px solid #ddd; border-radius:8px; font-family:inherit;"></textarea>
                    </div>
                    <button type="submit" class="btn-small" style="margin-top:0.5rem;">Post Review</button>
                </form>
            <?php else: ?>
                <div style="background: #fcfaf7; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    <p style="margin:0;">Please <a href="login.php" style="color:var(--pink); font-weight:bold; text-decoration: underline;">log in</a> to leave a review.</p>
                </div>
            <?php endif; ?>

            <div class="reviews-list">
                <?php if(!empty($reviews)): ?>
                    <?php foreach($reviews as $r): ?>
                        <div class="review-item" style="padding-bottom: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #f0f0f0;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.3rem;">
                                <strong style="color:#222;"><?php echo htmlspecialchars($r['user_email']); ?></strong>
                                <small style="color:#999;"><?php echo date('d M Y', strtotime($r['date'])); ?></small>
                            </div>
                            <p style="margin:0; color:#555; line-height: 1.5;"><?php echo htmlspecialchars($r['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:#777; font-style: italic;">No reviews yet. Be the first to share your thoughts!</p>
                <?php endif; ?>
            </div>
        </div>

      </div>
    </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>