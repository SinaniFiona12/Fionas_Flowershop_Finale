<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once(__DIR__ . "/classes/User.php"); 
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    if (empty($_SESSION['cart'])) {
        header("Location: cart.php");
        exit();
    }

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['qty'];
    }

    try {
        $user = new User();
        $email = $_SESSION['user']['email'];

        
        $user->pay($email, $total);

        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO orders (user_email, total_price) VALUES (:email, :total)");
        $statement->bindValue(":email", $email);
        $statement->bindValue(":total", $total);
        $statement->execute();

        
        $_SESSION['user']['currency'] -= $total;

        unset($_SESSION['cart']);
        header("Location: orders.php?success=1");
        exit();

    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: cart.php?error=" . urlencode($error));
        exit();
    }
?>