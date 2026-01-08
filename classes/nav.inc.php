<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
?>

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
      <form class="header-search" action="product-listing.php" method="GET">
        <input type="search" name="search" placeholder="Search products..." required />
        <button type="submit">Search</button>
      </form>
      
      <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <a href="product-listing.php?admin=true" class="btn-dashboard" style="background:var(--pink); color:#222; font-weight:bold; padding:0.5rem 1rem; border-radius:8px; text-decoration:none;">Dashboard</a>
      <?php endif; ?>

      <?php if(isset($_SESSION['user'])): ?>
          <a href="profile.php"><img src="images/account.png" alt="Profile"></a>
      <?php else: ?>
          <a href="login.php"><img src="images/account.png" alt="Login"></a>
      <?php endif; ?>

      <a href="cart.php">
          <img src="images/cart.png" alt="Cart">
          <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
              <span style="background:red; color:white; border-radius:50%; padding:2px 6px; font-size:10px; vertical-align:top; margin-left:-10px;">
                  <?php echo count($_SESSION['cart']); ?>
              </span>
          <?php endif; ?>
      </a>
    </div>
  </div>
</header>