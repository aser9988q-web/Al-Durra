<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header('Location: admin_test.php');
            exit;
        }
    }
    ?>
    <html>
    <head><title>Login</title></head>
    <body>
        <h1>Admin Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_test.php');
    exit;
}
?>
<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <p>User: <?php echo $_SESSION['admin_username']; ?></p>
    <a href="?logout=1">Logout</a>
</body>
</html>
