<?php
    session_start();
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");
    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setFullname($_POST['name']);
            $user->setEmail($_POST['email']);
            
            if ($_POST['password'] !== $_POST['confirm-password']) {
                throw new Exception("Wachtwoorden komen niet overeen.");
            }
            
            $user->setPassword($_POST['password']);
            
            if ($user->register()) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            
                $_SESSION['user'] = [
                    'email' => $user->getEmail(),
                    'fullname' => $user->getFullname(),
                    'role' => 'user', 
                    'currency' => 1000 
                ];
            
               
                header("Location: profile.php");
                exit();
            }

            header("Location: login.php");
            exit();

        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Fiona's Flowershop</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="form-styles.css" />
</head>
<body>

<?php include_once(__DIR__ . "/nav.inc.php"); ?>

<main class="page-content login-bg">
  <div class="form-card">
    <h2>Create Your Account</h2>
    
    <?php if (isset($error)): ?>
        <div style="background-color: #ffe7e9; color: #cc3333; padding: 10px; border-radius: 8px; margin-bottom: 1em;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form class="auth-form" action="" method="post">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required placeholder="Fiona Sinani">
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn" style="width: 100%;">Register</button>
    </form>
    <p class="form-link">
      Already have an account? <a href="login.php">Login here</a>
    </p>
  </div>
</main>

<footer class="site-footer">
  <div class="container"><p>© 2025 Fiona’s Flowershop</p></div>
</footer>

</body>
</html>