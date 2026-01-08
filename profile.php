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

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="page-content login-bg">
  <div class="form-card wide" style="position: relative; padding-bottom: 5rem;"> <h2>Welcome back, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>
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

    <div style="position: absolute; bottom: 2rem; left: 2.5rem;">
        <a href="logout.php" class="btn" style="background: #FFE7E9; color: #222; padding: 0.6rem 1.2rem; font-size: 0.9rem;">
            Logout
        </a>
    </div>

  </div>
</main>
<footer class="site-footer"><p>© 2025 Fiona’s Flowershop</p></footer>
</body>
</html>