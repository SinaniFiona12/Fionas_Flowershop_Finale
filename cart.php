<?php
    session_start();
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/Product.php");

    
    if (isset($_POST['product_id'])) {
        $id = $_POST['product_id'];
        $product = Product::getById($id);

        if ($product) {
            
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty']++;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'qty' => 1
                ];
            }

            if (isset($_POST['return_url'])) {
                header("Location: " . $_POST['return_url']);
                exit();
            }
            
        }
    }

    
    if (isset($_POST['remove_id'])) {
        $removeId = $_POST['remove_id'];
        unset($_SESSION['cart'][$removeId]);
    }

    
    $total = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $total += $item['price'] * $item['qty'];
        }
    }

    $orderPlaced = false;
    if (isset($_POST['checkout']) && $total > 0) {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }
        
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO orders (user_email, total_price) VALUES (:email, :total)");
        $statement->bindValue(":email", $_SESSION['user']['email']);
        $statement->bindValue(":total", $total);
        $result = $statement->execute();

        if ($result) {
            unset($_SESSION['cart']); 
            $orderPlaced = true;      
            $total = 0;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Cart | Fiona's Flowershop</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="shop-styles.css" /> 
  <link rel="stylesheet" href="cart-styles.css" />
</head>
<body>

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="container cart-page">
<?php if(isset($_GET['error'])): ?>
      <div style="background: #ffe7e9; color: red; padding: 1rem; margin-bottom: 1rem; border-radius: 8px;">
          <?php echo htmlspecialchars($_GET['error']); ?>
      </div>
  <?php endif; ?>
  <h1>Your Shopping Cart</h1>
  <div class="cart-layout">
    
    <div class="cart-items">
      <?php if(!empty($_SESSION['cart'])): ?>
          <?php foreach($_SESSION['cart'] as $item): ?>
          <div class="cart-item">
            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image" style="width:90px; height:90px; object-fit: cover; border-radius: 8px;">
            
            <div class="cart-item-details">
              <h3><?php echo htmlspecialchars($item['name']); ?></h3>
              <p class="cart-item-price">$<?php echo $item['price']; ?></p>
              <div class="cart-item-actions">
                  <p>Qty: <?php echo $item['qty']; ?></p>
                  <form method="post" style="display:inline;">
                        <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
              </div>
            </div>
            <p class="cart-item-total">$<?php echo $item['price'] * $item['qty']; ?></p>
          </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p>Je mandje is leeg.</p>
      <?php endif; ?>
      
      <a href="product-listing.php" class="btn-small continue-shopping">← Continue Shopping</a>
    </div>

    <aside class="cart-summary">
      <h3>Order Summary</h3>
      
      <div class="summary-line">
        <p>Subtotal</p>
        <p>$<?php echo $total; ?></p>
      </div>
      <div class="summary-line">
        <p>Shipping</p>
        <p>Calculated at Checkout</p>
      </div>
      
      <div class="summary-total summary-line">
        <h4>Order Total</h4>
        <h4>$<?php echo $total; ?></h4>
      </div>
      
      <form method="post">
            <button type="submit" name="checkout" class="btn checkout-btn" <?php if($total <= 0) echo 'disabled style="opacity:0.5; cursor:not-allowed;"'; ?>>
                Proceed to Checkout
            </button>
      </form>
    </aside>

  </div>
</main>

<footer class="site-footer">
  <div class="container">
    <p>© 2025 Fiona’s Flowershop</p>
  </div>
</footer>

</body>
</html>