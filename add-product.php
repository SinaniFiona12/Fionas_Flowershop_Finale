
<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/Product.php");

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }

    if (!empty($_POST)) {
        try {
            $product = new Product();
            $product->setName($_POST['product-name']);
            $product->setDescription($_POST['description']);
            $product->setCategory($_POST['category']);
            $product->setPrice($_POST['price']);
            $product->setStock($_POST['stock']);
            $product->setColor($_POST['color']);
            
            $product->setImage("images/" . $_POST['image']); 
            
            $product->save();
            $success = "Product toegevoegd!";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Product | Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="form-styles.css" />
</head>
<body>


<?php include_once(__DIR__ . "/nav.inc.php"); ?>


<main class="container page-content wide">
  <h2>Add New Product</h2>
  <div class="form-card wide">
    <?php if(isset($success)): ?><p style="color:green"><?php echo $success; ?></p><?php endif; ?>
    <?php if(isset($error)): ?><p style="color:red"><?php echo $error; ?></p><?php endif; ?>
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

