<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = trim($_POST['roll_no']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE roll_no = ?");
    $stmt->execute([$roll_no]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;

        // 🎯 Role-based redirection
        if ($user['role'] === 'admin') {
            header("Location: admin_panel.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid Roll No or Password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>login</title>
    <style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        overflow: hidden;
    }

    .login-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.85);
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 300px;
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .login-container button {
        padding: 10px 20px;
        border: none;
        background-color: #5785a7;
        color: white;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-container button:hover {
        background-color: #466e8e;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
    }
</style>

</head>
<body>

<div id="vanta-canvas" style="width: 100vw; height: 100vh;"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r122/three.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.clouds.min.js"></script>

<script type="text/javascript">
    VANTA.CLOUDS({
        el: "#vanta-canvas",
        mouseControls: true,
        touchControls: true,
        minHeight: 200.00,
        minWidth: 200.00,
        skyColor: 0x5785a7,
        cloudColor: 0xbbbbbb,
        cloudShadowColor: 0x183550,
        sunColor: 0x9d9d2a,
        sunlightColor: 0xd46262,
    })

</script>

<div class="s-page-1">
    <div class="s-section-1">
        <div class="s-section">
            <div class="login-container">
                <h2>Login</h2>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?= $error ?></p>
                <?php endif; ?>
                <form method="POST" action="">
                <label for="roll_no">Roll No:</label>
                <input type="text" name="roll_no" id="roll_no" required><br><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br><br>

                <button type="submit">Login</button>

                <br><br>

                <!-- 🔽 Sign Up Button -->
                <p>Don't have an account? <a href="register.php" style="color: blue;">Sign Up</a></p>
            </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
