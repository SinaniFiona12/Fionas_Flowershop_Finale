<?php
    session_start();
    // Simpele berekening van het totaal
    $total = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $total += $item['price'] * $item['qty'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Cart | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="shop-styles.css" /> 
  <link rel="stylesheet" href="cart-styles.css" />
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
      <form class="header-search" action="product-listing.php" method="get">
        <input type="search" name="search" placeholder="Search…" />
        <button type="submit">Search</button>
      </form>
      <a href="login.php"><img src="images/account.png" alt="Account"></a>
      <a href="cart.php"><img src="images/cart.png" alt="Cart"></a>
    </div>

  </div>
</header>

<main class="container cart-page">
  <h1>Your Shopping Cart</h1>
  <div class="cart-layout">
    
    <div class="cart-items">
      <?php if(!empty($_SESSION['cart'])): ?>
          <?php foreach($_SESSION['cart'] as $item): ?>
          <div class="cart-item">
            <div class="cart-item-image-placeholder" style="width:90px; height:90px; background:#eee; border-radius:8px;"></div>
            
            <div class="cart-item-details">
              <h3><?php echo htmlspecialchars($item['name']); ?></h3>
              <p class="cart-item-price">$<?php echo $item['price']; ?></p>
              <div class="cart-item-actions">
                  <p>Qty: <?php echo $item['qty']; ?></p>
                  <button class="btn-remove">Remove</button>
              </div>
            </div>
            <p class="cart-item-total">$<?php echo $item['price'] * $item['qty']; ?></p>
          </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p>Je mandje is leeg.</p>
      <?php endif; ?>
      
      <a href="product-listing.php" class="btn-small continue-shopping">← Continue Shopping</a>
    </div>

    <aside class="cart-summary">
      <h3>Order Summary</h3>
      
      <div class="summary-line">
        <p>Subtotal</p>
        <p>$<?php echo $total; ?></p>
      </div>
      <div class="summary-line">
        <p>Shipping</p>
        <p>Calculated at Checkout</p>
      </div>
      
      <div class="summary-total summary-line">
        <h4>Order Total</h4>
        <h4>$<?php echo $total; ?></h4>
      </div>
      
      <button class="btn checkout-btn">Proceed to Checkout</button>
    </aside>

  </div>
</main>

<footer class="site-footer">
  <div class="container">
    <p>© 2025 Fiona’s Flowershop</p>
  </div>
</footer>

</body>
</html>