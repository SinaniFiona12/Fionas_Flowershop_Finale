<?php
session_start();
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/Product.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['delete']) && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    Product::delete($_GET['delete']);
    header("Location: product-listing.php?admin=true&deleted=1");
    exit();
}


$categoryId = $_GET['category'] ?? null;
$searchTerm = $_GET['search'] ?? null;
$priceFilter = $_GET['price'] ?? null;

$isAdminMode = (isset($_GET['admin']) && $_GET['admin'] == 'true') || (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin' && isset($_GET['admin']));


$conn = Db::getConnection(); 


$query = "SELECT * FROM products WHERE 1=1";
$params = [];


if (!empty($searchTerm)) {
    $query .= " AND name LIKE :search";
    $params[':search'] = "%" . $searchTerm . "%";
}

if (!empty($categoryId)) {
    $query .= " AND category = :category";
    $params[':category'] = $categoryId;
}

if (!empty($priceFilter)) {
    $query .= " AND price <= :price";
    $params[':price'] = $priceFilter;
}


if (isset($_GET['colors']) && is_array($_GET['colors'])) {
 
    $colorPlaceholders = [];
    foreach ($_GET['colors'] as $key => $color) {
        $placeholder = ":color" . $key;
        $colorPlaceholders[] = $placeholder;
        $params[$placeholder] = $color;
    }
    $query .= " AND color IN (" . implode(', ', $colorPlaceholders) . ")";
}


$sortOrder = $_GET['sort'] ?? 'newest';
switch ($sortOrder) {
    case 'price-asc':
        $query .= " ORDER BY price ASC";
        break;
    case 'price-desc':
        $query .= " ORDER BY price DESC";
        break;
    case 'newest':
    default:
    $query .= " ORDER BY `date` DESC";
        break;
}

$statement = $conn->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

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

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="container shop-layout">
  
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
      <h2>
          <?php echo $categoryId ? ucfirst($categoryId) : "All Products"; ?>
          <?php if($isAdminMode && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') echo " <span style='color:red; font-size:0.6em;'>(Admin Mode)</span>"; ?>
      </h2>
      
      <?php if(isset($_GET['deleted'])): ?>
        <p style="color:green; font-weight:bold;">Product deleted successfully.</p>
      <?php endif; ?>
  </div>

  <div class="shop-grid">
    
    <aside class="sidebar-filters">
    <h3>Categories</h3>
    <ul style="list-style:none; padding:0; margin-bottom: 2rem;">
        <li style="margin-bottom:0.5em;"><a href="product-listing.php" style="text-decoration:none; color:#222;">All Products</a></li>
        <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=flowers" style="text-decoration:none; color:#222;">Flowers</a></li>
        <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=occasions" style="text-decoration:none; color:#222;">Occasions</a></li>
        <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=vases" style="text-decoration:none; color:#222;">Vases</a></li>
        <li style="margin-bottom:0.5em;"><a href="product-listing.php?category=tools" style="text-decoration:none; color:#222;">Tools</a></li>
    </ul>

    <form action="product-listing.php" method="GET">
        
        <?php if($categoryId): ?><input type="hidden" name="category" value="<?php echo htmlspecialchars($categoryId); ?>"><?php endif; ?>
        <?php if($searchTerm): ?><input type="hidden" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>"><?php endif; ?>

        <h3>Color</h3>
        <div style="margin-bottom: 2rem;">
            <label style="display:block; margin-bottom:0.5rem;">
                <input type="checkbox" name="colors[]" value="pink" <?php if(isset($_GET['colors']) && in_array('pink', $_GET['colors'])) echo 'checked'; ?>> Pink
            </label>
            <label style="display:block; margin-bottom:0.5rem;">
                <input type="checkbox" name="colors[]" value="white" <?php if(isset($_GET['colors']) && in_array('white', $_GET['colors'])) echo 'checked'; ?>> White
            </label>
            <label style="display:block; margin-bottom:0.5rem;">
                <input type="checkbox" name="colors[]" value="red" <?php if(isset($_GET['colors']) && in_array('red', $_GET['colors'])) echo 'checked'; ?>> Red
            </label>
        </div>

        <h3>Max Price</h3>
        <div style="margin-bottom: 2rem;">
            <input type="number" name="price" placeholder="50" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;" value="<?php echo htmlspecialchars($_GET['price'] ?? ''); ?>">
        </div>

        <h3>Sort By</h3>
        <div style="margin-bottom: 2rem;">
            <select name="sort" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
                <option value="newest" <?php if(($sortOrder ?? '') == 'newest') echo 'selected'; ?>>Newest</option>
                <option value="price-asc" <?php if(($sortOrder ?? '') == 'price-asc') echo 'selected'; ?>>Price: Low to High</option>
                <option value="price-desc" <?php if(($sortOrder ?? '') == 'price-desc') echo 'selected'; ?>>Price: High to Low</option>
            </select>
        </div>

        <button type="submit" class="btn" style="width:100%;">Apply Filters</button>
    </form>
</aside>

    <div class="product-grid">
      <?php if (count($products) > 0): ?>
          <?php foreach ($products as $product): ?>

            <article class="product-card" id="product-<?php echo $product['id']; ?>">
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                </a>
                <div class="product-info">
                    <h3><a href="product-detail.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <p class="product-category"><?php echo ucfirst($product['category']); ?></p>
                    <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                    
                    <?php if ($isAdminMode && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <div style="display:flex; gap:0.5rem; justify-content:center; margin-top:0.5rem;">
                            <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn-small" style="background:#ddd; color:#222; border:none; text-decoration:none; padding: 0.3rem 0.8rem; font-size: 0.8rem;">Edit</a>
                            
                            <a href="product-listing.php?delete=<?php echo $product['id']; ?>&admin=true" class="btn-small" style="background:red; color:white; border:none; text-decoration:none; padding: 0.3rem 0.8rem; font-size: 0.8rem;" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </div>
                    <?php else: ?>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    
                            <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>#product-<?php echo $product['id']; ?>">
    
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