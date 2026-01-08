<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Profile | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="form-styles.css" />
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
      <a class="brand" href="index.php">Fiona's Flowershop</a>
      <div class="header-right">
          <a href="logout.php" class="btn-small" style="background: #eee;">Logout</a>
      </div>
  </div>
</header>

<main class="page-content login-bg">
  <div class="form-card wide">
    <h2>Welcome back, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>
    <p style="margin-bottom: 2rem;">You are logged in as <strong><?php echo $user['role']; ?></strong>.</p>

    <?php if ($user['role'] === 'admin'): ?>
        <div class="form-row">
            <a href="add-product.php" class="btn" style="text-align:center;">Add Product</a>
            <a href="product-listing.php?admin=true" class="btn" style="text-align:center;">Manage Products</a>
        </div>
    
    <?php else: ?>
        <div class="form-row">
            <a href="orders.php" class="btn" style="text-align:center;">Previous Orders</a>
            <a href="change-password.php" class="btn" style="text-align:center;">Personal Information</a>
        </div>
    <?php endif; ?>

  </div>
</main>
<footer class="site-footer"><p>© 2025 Fiona’s Flowershop</p></footer>
</body>
</html>