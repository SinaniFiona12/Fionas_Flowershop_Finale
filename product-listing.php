<?php
include_once(__DIR__ . "/classes/Product.php");
session_start();


if (isset($_GET['delete']) && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    Product::delete($_GET['delete']);
    header("Location: product-listing.php?admin=true&deleted=1");
    exit();
}


$categoryId = $_GET['category'] ?? null;
$isAdminMode = isset($_GET['admin']) && $_GET['admin'] == 'true';


if ($categoryId) {
    
    $products = Product::getByCategory($categoryId);
} else {
   
    $products = Product::getAll();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop All Products | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="shop-styles.css" /> 
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <div class="header-left">
      <a class="brand" href="index.php">Fiona's Flowershop</a>
      <nav class="main-nav">
        <ul>
          <li><a href="product-listing.php?category=flowers">Flowers</a></li>
          <li><a href="product-listing.php?category=occasions">Occasions</a></li>
          <li><a href="product-listing.php?category=vases">Vases</a></li>
          <li><a href="product-listing.php?category=tools">Tools</a></li>
        </ul>
      </nav>
    </div>
    <div class="header-right">
      <form class="header-search">
        <input type="search" placeholder="Search…" />
        <button type="submit">Search</button>
      </form>
      
      <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <a href="profile.php" style="font-weight:bold; color:var(--pink);">Dashboard</a>
      <?php endif; ?>

      <a href="login.php"><img src="images/account.png" alt="Account"></a>
      <a href="cart.php"><img src="images/cart.png" alt="Cart"></a>
    </div>
  </div>
</header>

<main class="container shop-layout">
  
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
      <h2>
          <?php echo $categoryId ? ucfirst($categoryId) : "All Products"; ?>
          <?php if($isAdminMode) echo " <span style='color:red; font-size:0.6em;'>(Admin Mode)</span>"; ?>
      </h2>
      
      <?php if(isset($_GET['deleted'])): ?>
        <p style="color:green; font-weight:bold;">Product deleted successfully.</p>
      <?php endif; ?>
  </div>

  <div class="shop-grid">
    
    <aside class="sidebar-filters">
        <h3>Categories</h3>
        <ul style="list-style:none; padding:0;">
            <li style="margin-bottom:0.5em;"><a href="product-listing.php" style="text-decoration:none; color:#222;">All Products</a></li>
            <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=flowers" style="text-decoration:none; color:#222;">Flowers</a></li>
            <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=occasions" style="text-decoration:none; color:#222;">Occasions</a></li>
            <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=vases" style="text-decoration:none; color:#222;">Vases</a></li>
            <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=tools" style="text-decoration:none; color:#222;">Tools</a></li>
        </ul>
    </aside>

    <div class="product-grid">
      <?php if (count($products) > 0): ?>
          <?php foreach ($products as $product): ?>

            <article class="product-card">
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                </a>
                <div class="product-info">
                    <h3><a href="product-detail.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <p class="product-category"><?php echo ucfirst($product['category']); ?></p>
                    <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                    
                    <?php if ($isAdminMode && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <div style="display:flex; gap:0.5rem; justify-content:center; margin-top:0.5rem;">
                            <a href="product-listing.php?delete=<?php echo $product['id']; ?>&admin=true" class="btn-small" style="background:red; color:white; border:none;" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </div>
                    <?php else: ?>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="btn-small">Add to Cart</button>
                        </form>
                    <?php endif; ?>

                </div>
            </article>

          <?php endforeach; ?>
      <?php else: ?>
          <p>No products found in this category.</p>
      <?php endif; ?>
    </div>
  </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>