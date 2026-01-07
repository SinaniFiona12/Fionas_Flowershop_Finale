<?php
$products = [
    ['id' => 1, 'name' => 'The Classic Rose Bouquet', 'category' => 'flowers', 'price' => 49.99, 'image' => 'images/rose_bouquet.png', 'color' => 'red'],
    ['id' => 2, 'name' => 'Spring Whisper Tulips', 'category' => 'flowers', 'price' => 24.99, 'image' => 'images/tulips.png', 'color' => 'pink'],
    ['id' => 3, 'name' => 'Sunny Sunflower Bundle', 'category' => 'flowers', 'price' => 15.00, 'image' => 'images/sunflowers.png', 'color' => 'yellow'],
    ['id' => 4, 'name' => 'Elegant White Lilies', 'category' => 'flowers', 'price' => 35.00, 'image' => 'images/lillies.png', 'color' => 'white'],
    ['id' => 5, 'name' => 'Wedding Dream Centerpiece', 'category' => 'occasions', 'price' => 85.00, 'image' => 'images/wedding.png', 'color' => 'white'],
    ['id' => 6, 'name' => 'Birthday Brights', 'category' => 'occasions', 'price' => 45.00, 'image' => 'images/birthday.png', 'color' => 'pink'],
    ['id' => 7, 'name' => 'Pure Sympathy Wreath', 'category' => 'occasions', 'price' => 60.00, 'image' => 'images/funeral.png', 'color' => 'white'],
    ['id' => 8, 'name' => 'Romantic Rose Box', 'category' => 'occasions', 'price' => 120.00, 'image' => 'images/Romantic_bouquet.png', 'color' => 'red'],
    ['id' => 9, 'name' => 'Rustic Clay Pot', 'category' => 'vases', 'price' => 34.50, 'image' => 'images/pot.png', 'color' => 'brown'],
    ['id' => 10, 'name' => 'Tall Glass Vase', 'category' => 'vases', 'price' => 18.00, 'image' => 'images/simplevase.png', 'color' => 'clear'],
    ['id' => 11, 'name' => 'Modern Geometric Vase', 'category' => 'vases', 'price' => 29.99, 'image' => 'images/geometricvase.png', 'color' => 'white'],
    ['id' => 12, 'name' => 'Vintage Ceramic Jug', 'category' => 'vases', 'price' => 42.00, 'image' => 'images/jug.png', 'color' => 'white'],
    ['id' => 13, 'name' => 'Golden Pruning Shears', 'category' => 'tools', 'price' => 19.99, 'image' => 'images/scisssors.png', 'color' => 'gold'],
    ['id' => 14, 'name' => 'Copper Watering Can', 'category' => 'tools', 'price' => 45.00, 'image' => 'images/kan.png', 'color' => 'copper'],
    ['id' => 15, 'name' => 'Pro Gardening Gloves', 'category' => 'tools', 'price' => 12.50, 'image' => 'images/gloves.png', 'color' => 'green'],
    ['id' => 16, 'name' => 'Florist Tape & Twine', 'category' => 'tools', 'price' => 8.00, 'image' => 'images/floristtape.png', 'color' => 'green'],
];

$selectedCategory = $_GET['category'] ?? []; 
$selectedColor    = $_GET['color'] ?? [];    
$selectedSort     = $_GET['sort'] ?? '';

if (!is_array($selectedCategory) && !empty($selectedCategory)) $selectedCategory = [$selectedCategory];
if (!is_array($selectedColor) && !empty($selectedColor))       $selectedColor = [$selectedColor];

$filteredProducts = $products;

if (!empty($selectedCategory)) {
    $filteredProducts = array_filter($filteredProducts, function($p) use ($selectedCategory) {
        return in_array($p['category'], $selectedCategory);
    });
}
if (!empty($selectedColor)) {
    $filteredProducts = array_filter($filteredProducts, function($p) use ($selectedColor) {
        return in_array($p['color'], $selectedColor);
    });
}

if ($selectedSort === 'price_asc') {
    usort($filteredProducts, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($selectedSort === 'price_desc') {
    usort($filteredProducts, fn($a, $b) => $b['price'] <=> $a['price']);
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