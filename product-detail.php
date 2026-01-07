<?php
$products = [
    ['id' => 1, 'name' => 'The Classic Rose Bouquet', 'category' => 'flowers', 'price' => 49.99, 'image' => 'images/rose_bouquet.png', 'color' => 'red', 'description' => 'A timeless arrangement of velvety red roses, perfect for expressing deep love and passion. Hand-tied with fresh greenery.'],
    ['id' => 2, 'name' => 'Spring Whisper Tulips', 'category' => 'flowers', 'price' => 24.99, 'image' => 'images/tulips.png', 'color' => 'pink', 'description' => 'Capture the essence of spring with these delicate pink tulips. Freshly harvested to brighten any room.'],
    ['id' => 3, 'name' => 'Sunny Sunflower Bundle', 'category' => 'flowers', 'price' => 15.00, 'image' => 'images/sunflowers.png', 'color' => 'yellow', 'description' => 'Radiant sunflowers that bring instant joy. Perfect for a rustic vase on the kitchen table.'],
    ['id' => 4, 'name' => 'Elegant White Lilies', 'category' => 'flowers', 'price' => 35.00, 'image' => 'images/lillies.png', 'color' => 'white', 'description' => 'Sophisticated white lilies with a heavenly fragrance. A classic choice for elegant homes.'],
    ['id' => 5, 'name' => 'Wedding Dream Centerpiece', 'category' => 'occasions', 'price' => 85.00, 'image' => 'images/wedding.png', 'color' => 'white', 'description' => 'A luxurious centerpiece designed for your special day, featuring premium white blooms and lush foliage.'],
    ['id' => 6, 'name' => 'Birthday Brights', 'category' => 'occasions', 'price' => 45.00, 'image' => 'images/birthday.png', 'color' => 'pink', 'description' => 'A colorful mix of seasonal flowers to celebrate another trip around the sun!'],
    ['id' => 7, 'name' => 'Pure Sympathy Wreath', 'category' => 'occasions', 'price' => 60.00, 'image' => 'images/funeral.png', 'color' => 'white', 'description' => 'A tasteful and respectful wreath to offer condolences and show you care.'],
    ['id' => 8, 'name' => 'Romantic Rose Box', 'category' => 'occasions', 'price' => 120.00, 'image' => 'images/Romantic_bouquet.png', 'color' => 'red', 'description' => 'Our premium roses arranged in a stylish hatbox. The ultimate romantic gesture.'],
    ['id' => 9, 'name' => 'Rustic Clay Pot', 'category' => 'vases', 'price' => 34.50, 'image' => 'images/pot.png', 'color' => 'brown', 'description' => 'Hand-thrown clay pot with a natural, earthy finish. Ideal for dried flowers or robust plants.'],
    ['id' => 10, 'name' => 'Tall Glass Vase', 'category' => 'vases', 'price' => 18.00, 'image' => 'images/simplevase.png', 'color' => 'clear', 'description' => 'A simple, elegant cylinder vase that fits any bouquet style.'],
    ['id' => 11, 'name' => 'Modern Geometric Vase', 'category' => 'vases', 'price' => 29.99, 'image' => 'images/geometricvase.png', 'color' => 'white', 'description' => 'A striking geometric design that adds a modern touch to your interior.'],
    ['id' => 12, 'name' => 'Vintage Ceramic Jug', 'category' => 'vases', 'price' => 42.00, 'image' => 'images/jug.png', 'color' => 'white', 'description' => 'Charming vintage-style jug, perfect for a farmhouse look.'],
    ['id' => 13, 'name' => 'Golden Pruning Shears', 'category' => 'tools', 'price' => 19.99, 'image' => 'images/scisssors.png', 'color' => 'gold', 'description' => 'Sharp, durable shears with a gold finish. Essential for any flower enthusiast.'],
    ['id' => 14, 'name' => 'Copper Watering Can', 'category' => 'tools', 'price' => 45.00, 'image' => 'images/kan.png', 'color' => 'copper', 'description' => 'A functional watering can that looks beautiful enough to leave on display.'],
    ['id' => 15, 'name' => 'Pro Gardening Gloves', 'category' => 'tools', 'price' => 12.50, 'image' => 'images/gloves.png', 'color' => 'green', 'description' => 'Protect your hands with these comfortable, durable gloves.'],
    ['id' => 16, 'name' => 'Florist Tape & Twine', 'category' => 'tools', 'price' => 8.00, 'image' => 'images/floristtape.png', 'color' => 'green', 'description' => 'Professional grade tape and twine for arranging your own bouquets.'],
];

$productId = $_GET['id'] ?? null;
$product = null;

if ($productId) {
    foreach ($products as $p) {
        if ($p['id'] == $productId) {
            $product = $p;
            break;
        }
    }
}

if (!$product) {
    header("Location: product-listing.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Details | Fiona's Flowershop</title>
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

<main class="container detail-layout" style="padding: 4rem 0;">
<div class="detail-content">
      <div class="detail-image-wrapper">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
      </div>
      <div class="detail-text">
        <p class="breadcrumbs"><a href="product-listing.php">Shop</a> / <?php echo $product['name']; ?></p>
        <h1><?php echo $product['name']; ?></h1>
        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
        <p class="description"><?php echo $product['description']; ?></p>
        
        <button class="btn">Add to Cart</button>
      </div>
    </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>