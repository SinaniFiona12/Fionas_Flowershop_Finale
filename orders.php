<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");

    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }

    
    $conn = Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM orders WHERE user_email = :email ORDER BY date DESC");
    $statement->bindValue(":email", $_SESSION['user']['email']);
    $statement->execute();
    $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Orders | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="shop-styles.css" />
</head>
<body>

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="container page-content">
    <h2 style="font-family: 'Italiana', serif; margin-left: 2em;margin-bottom: 2rem;">My Previous Orders</h2>
    
    <div style="background: white; padding: 2rem; border-radius: 12px; border: 1px solid #eee;">
        <?php if (count($orders) > 0): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #eee;">
                        <th style="padding: 1rem;">Order ID</th>
                        <th style="padding: 1rem;">Date</th>
                        <th style="padding: 1rem;">Total Price</th>
                        <th style="padding: 1rem;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td style="padding: 1rem;">#<?php echo $order['id']; ?></td>
                        <td style="padding: 1rem; color: #666;"><?php echo date('d M Y, H:i', strtotime($order['date'])); ?></td>
                        <td style="padding: 1rem; font-weight: bold;">$<?php echo number_format($order['total_price'], 2); ?></td>
                        <td style="padding: 1rem;"><span style="background: #e6f4ea; color: #1e8e3e; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem; font-weight: bold;">Completed</span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You haven't placed any orders yet.</p>
            <a href="product-listing.php" class="btn-small">Start Shopping</a>
        <?php endif; ?>
    </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>