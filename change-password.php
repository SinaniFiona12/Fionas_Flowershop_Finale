<?php
    include_once(__DIR__ . "/classes/User.php");
    session_start();
    if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

    if (!empty($_POST)) {
        try {
            if ($_POST['new_password'] !== $_POST['confirm_password']) {
                throw new Exception("Wachtwoorden komen niet overeen.");
            }
            if (strlen($_POST['new_password']) < 6) {
                throw new Exception("Wachtwoord moet minimaal 6 tekens zijn.");
            }

            $user = new User();
            $user->setEmail($_SESSION['user']['email']);
            $user->changePassword($_POST['new_password']);
            
            $success = "Wachtwoord succesvol gewijzigd!";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Change Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="form-styles.css" />
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="index.php">Fiona's Flowershop</a>
        <a href="profile.php" class="btn-small">Back to Profile</a>
    </div>
</header>
<main class="page-content login-bg">
  <div class="form-card">
    <h2>Change Password</h2>
    <?php if(isset($error)): ?><p style="color:red"><?php echo $error; ?></p><?php endif; ?>
    <?php if(isset($success)): ?><p style="color:green"><?php echo $success; ?></p><?php endif; ?>
    
    <form class="auth-form" method="post">
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" required>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Update Password</button>
    </form>
  </div>
</main>
<footer class="site-footer"><p>© 2025 Fiona’s Flowershop</p></footer>
</body>
</html>