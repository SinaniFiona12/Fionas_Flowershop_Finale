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
      <a href="login.php"><img src="images/account.png" alt="Account"></a>
      <a href="cart.php"><img src="images/cart.png" alt="Cart"></a>
    </div>
  </div>
</header>

<main class="container shop-layout">
  <h2>All Products</h2>
  
  <div class="shop-grid">
    
  <aside class="sidebar-filters">
      <form action="product-listing.php" method="GET">
        <h3>Filter & Sort</h3>
        
        <div class="filter-group">
            <h4>Category</h4>
            <label><input type="checkbox" name="category[]" value="flowers"> Flowers</label>
            <label><input type="checkbox" name="category[]" value="vases"> Vases</label>
            <label><input type="checkbox" name="category[]" value="tools"> Tools</label>
            <label><input type="checkbox" name="category[]" value="occasions"> Occasions</label>
        </div>

        <div class="filter-group">
            <h4>Color</h4>
            <label><input type="checkbox" name="color[]" value="pink"> Pink</label>
            <label><input type="checkbox" name="color[]" value="white"> White</label>
            <label><input type="checkbox" name="color[]" value="red"> Red</label>
        </div>

        <div class="filter-group">
            <h4>Sort By</h4>
            <select name="sort" onchange="this.form.submit()">
                <option value="">Default</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
            </select>
        </div>

        <button type="submit" class="btn-small" style="width:100%; margin-top:10px;">Apply Filters</button>
        <a href="product-listing.php" style="display:block; text-align:center; margin-top:10px; font-size: 0.9em; color:#555;">Clear filters</a>
      </form>
    </aside>

    <div class="product-grid">
        <p>Producten komen hier...</p>
    </div>

  </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>