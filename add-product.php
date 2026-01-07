<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Product | Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="form-styles.css" />
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
      <a class="brand" href="index.php">Fiona's Admin</a>
      <nav class="main-nav"><ul><li><a href="product-listing.php">View Products</a></li></ul></nav>
  </div>
</header>
<main class="container page-content wide">
  <h2>Add New Product</h2>
  <div class="form-card wide">
    <form class="admin-form" method="post" enctype="multipart/form-data">
      <div class="form-group"><label>Product Name</label><input type="text" name="product-name" required></div>
      <div class="form-group"><label>Description</label><textarea name="description" rows="5" required></textarea></div>
      <div class="form-row">
        <div class="form-group"><label>Category</label>
          <select name="category" required>
            <option value="flowers">Flowers</option>
            <option value="occasions">Occasions</option>
            <option value="vases">Vases</option>
            <option value="tools">Tools</option>
          </select>
        </div>
        <div class="form-group"><label>Price ($)</label><input type="number" name="price" step="0.01" required></div>
      </div>
      <div class="form-row">
        <div class="form-group"><label>Stock</label><input type="number" name="stock" required></div>
        <div class="form-group"><label>Color</label><input type="text" name="color"></div>
      </div>
      <div class="form-group"><label>Image Filename</label><input type="text" name="image" placeholder="bv. rose.png" required></div>
      <button type="submit" class="btn">Add Product</button>
    </form>
  </div>
</main>
<footer class="site-footer"><p>© 2025 Fiona’s Flowershop Admin</p></footer>
</body>
</html>