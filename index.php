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

<section class="categories container">
  <div class="category-card" id="flowers">
    <h2>Flowers</h2>
    <div class="image-category-wrapper">
        <img class="image-category" src="images/bouquet.svg" alt="flower bouquet">
    </div>
    <p>Seasonal bouquets & single stems.</p>
    <a class="btn-small" href="product-listing.php?category=flowers">Browse</a>
  </div>

  <div class="category-card" id="occasions">
    <h2>Occasions</h2>
    <div class="image-category-wrapper">
        <img class="image-category" src="images/wedding.svg" alt="wedding photo">
    </div>
    <p>Birthday, anniversary, weddings & more.</p>
    <a class="btn-small" href="product-listing.php?category=occasions">Browse</a>
  </div>

  <div class="category-card" id="vases">
    <h2>Vases</h2>
    <div class="image-category-wrapper">
        <img class="image-category" src="images/vase.svg" alt="vases">
    </div>
    <p>Hand-picked vases for every bouquet.</p>
    <a class="btn-small" href="product-listing.php?category=vases">Browse</a>
  </div>
  
  <article id="tools" class="category-card">
    <h2>Tools</h2>
    <div class="image-category-wrapper">
        <img class="image-category" src="images/tools.svg" alt="tools">
    </div>
    <p>Pruners, tape, foam & packaging supplies.</p>
    <a class="btn-small" href="product-listing.php?category=tools">Browse</a>
  </article>
</section>

<section class="about container" id="about">
  <div class="about-content">
    <div class="about-text">
      <h2>Rooted in love, grown local.</h2>
      <p>
        <strong>Fiona’s Flowershop</strong> began as a small garden project and blossomed 
        into a passion for connecting people through nature.
      </p>
      <p>
        We are proud to be 100% foam-free and dedicated to <strong>sustainable sourcing</strong>. 
        We work directly with local growers to bring you blooms that are fresher 
        and support our community.
      </p>
    </div>
  </div> 
</section>

<footer class="site-footer">
  <div class="container">
    <p>© 2025 Fiona’s Flowershop</p>
  </div>
</footer>

</body>
</html>