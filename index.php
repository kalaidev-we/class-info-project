<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome | User Auth System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            text-align: center;
            padding-top: 100px;
        }

        h1 {
            font-size: 2.5rem;
        }

        a {
            display: inline-block;
            margin: 20px;
            padding: 12px 30px;
            background-color: #fff;
            color: #2575fc;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s ease;
        }

        a:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h1>Welcome to the PHP User Login System</h1>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>!</p>
        <a href="dashboard.php">Go to Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Sign Up</a>
    <?php endif; ?>
</body>
</html>
