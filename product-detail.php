<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/Product.php");
    include_once(__DIR__ . "/classes/Review.php");
    session_start();

    $id = $_GET['id'];
    $product = Product::getById($id);

    
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

<main class="container" style="margin: 2rem; max-width: 1200px;">

    <a href="product-listing.php" style="text-decoration:none; color:#666; margin-bottom:1rem; display:inline-block;">&larr; Back to overview</a>

    <div class="product-detail-wrapper" style="display: flex; gap: 4rem; margin-bottom: 4rem; flex-wrap: wrap;">

        <div style="flex: 1; min-width: 300px; max-width: 500px;">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" 
                 style="width: 100%; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        </div>

        <div style="flex: 1; min-width: 300px;">
            
            <p style="color:#888; font-size: 0.9rem; margin-bottom:0.5rem;">Shop / <?php echo htmlspecialchars($product['name']); ?></p>
            <h1 style="font-family: 'Italiana', serif; font-size: 3rem; margin-top: 0; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($product['name']); ?></h1>
            
            <p style="font-size: 1.5rem; color: #222; font-weight: bold; margin-bottom: 2rem;">
                $<?php echo number_format($product['price'], 2); ?>
            </p>

            <p style="line-height: 1.6; color: #444; margin-bottom: 2rem;">
                <?php echo htmlspecialchars($product['description']); ?>
            </p>

            <form method="post" action="cart.php" style="margin-bottom: 3rem;">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <button type="submit" class="btn" style="padding: 1rem 2rem; font-size: 1.1rem;">Add to Cart</button>
            </form>

            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 2rem;">

            <section class="reviews">
                <h3 style="font-family: 'Italiana', serif; margin-bottom: 1rem;">Customer Reviews</h3>
                
                <form method="post" action="" style="margin-bottom: 2rem;">
                    <textarea name="review_text" placeholder="Write a review..." required 
                              style="width: 100%; padding: 1rem; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; margin-bottom: 1rem;"></textarea>
                    <button type="submit" class="btn-small">Post Review</button>
                </form>

                <div class="review-list">
                     <div style="margin-bottom: 1.5rem;">
                        <p style="font-weight: bold; margin-bottom: 0.2rem;">Lola@gmail.com <span style="font-weight:normal; color:#999; font-size:0.8em; float:right;">08 Jan 2026</span></p>
                        <p style="color: #555;">I really liked these flowers!</p>
                     </div>
                </div>
            </section>

        </div>
    </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>