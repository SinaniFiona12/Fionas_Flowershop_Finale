<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION['user'];

    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT SUM(total_price) as total_spent FROM orders WHERE user_email = :email");
    $statement->bindValue(":email", $_SESSION['user']['email']);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $startBudget = 1000;
    $totalSpent = $result['total_spent'] ?? 0; // Als er niks is uitgegeven, is het 0
    $currentCurrency = $startBudget - $totalSpent;
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
  <div style="background: #f9f9f9; padding: 10px; border-radius: 8px; margin-bottom: 1.5rem; display: inline-block;">
        <span style="color: #666;">Current currency:</span> 
        <span style="font-weight: bold; color: #222; font-size: 1.1rem;">$<?php echo number_format($currentCurrency, 2); ?></span>
    </div>

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