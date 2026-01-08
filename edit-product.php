<?php
session_start();
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: product-listing.php?admin=true");
    exit();
}

$id = $_GET['id'];
$product = Product::getById($id);

if (!$product) {
    die("Product not found");
}

if (!empty($_POST)) {
    Product::update(
        $id,
        $_POST['product-name'],
        $_POST['description'],
        $_POST['category'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['color'],
        "images/" . $_POST['image']
    );

    header("Location: product-listing.php?admin=true&updated=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="form-styles.css">
<link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
</head>
<body>

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="page-content">
<div class="form-card wide">
<h2>Edit Product</h2>

<form method="post" class="admin-form">

<div class="form-group">
<label>Product Name</label>
<input type="text" name="product-name" value="<?= htmlspecialchars($product['name']); ?>" required>
</div>

<div class="form-group">
<label>Description</label>
<textarea name="description" rows="5"><?= htmlspecialchars($product['description']); ?></textarea>
</div>

<div class="form-row">
<div class="form-group">
<label>Category</label>
<select name="category">
<option value="flowers" <?= $product['category']=='flowers'?'selected':''; ?>>Flowers</option>
<option value="occasions" <?= $product['category']=='occasions'?'selected':''; ?>>Occasions</option>
<option value="vases" <?= $product['category']=='vases'?'selected':''; ?>>Vases</option>
<option value="tools" <?= $product['category']=='tools'?'selected':''; ?>>Tools</option>
</select>
</div>

<div class="form-group">
<label>Price</label>
<input type="number" step="0.01" name="price" value="<?= $product['price']; ?>" required>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label>Stock</label>
<input type="number" name="stock" value="<?= $product['stock']; ?>">
</div>

<div class="form-group">
<label>Color</label>
<input type="text" name="color" value="<?= htmlspecialchars($product['color']); ?>">
</div>
</div>

<div class="form-group">
<label>Image filename</label>
<input type="text" name="image" value="<?= basename($product['image']); ?>">
</div>

<button class="btn">Save changes</button>
</form>
</div>
</main>
</body>
</html>
