<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiona's Flowershop</title>

  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
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
      <a href="login.php"><img src="images/account.png" alt="Account"></a>
      <a href="cart.php"><img src="images/cart.png" alt="Cart"></a>
    </div>

  </div>
</header>

<section class="container">
  <div class="hero">
    <img src="images/decorative1.jpg" alt="Flowers"/>
    <div class="hero-text">
      <h1>Fresh flowers, crafted with love</h1>
      <p>Beautiful, seasonal arrangements just for you.</p>
      <a href="product-listing.php" class="btn">See All</a>
    </div>
  </div>
</section>


</body>
</html>