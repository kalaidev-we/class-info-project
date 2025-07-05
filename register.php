<?php
require 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if Roll No already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE roll_no = ?");
    $stmt->execute([$roll_no]);

    if ($stmt->rowCount() > 0) {
        $message = "Roll number already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, roll_no, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $roll_no, $password])) {
            header("Location: login.php");
            exit();
        } else {
            $message = "Something went wrong!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        overflow: hidden;
        background: #000; /* fallback for Vanta background */
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
        z-index: 1;
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

<div id="vanta-canvas" style="width: 100vw; height: 100vh; position: fixed; top:0; left:0; z-index: 0;"></div>

<div class="login-container">
    <?php if (!empty($message)): ?>
        <div class="error-message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" action="">
    <h2>Sign Up</h2>
    <input type="text" name="name" placeholder="Full Name" required autocomplete="name"><br>
    <input type="text" name="roll_no" placeholder="Roll Number" required autocomplete="username"><br>
    <input type="password" name="password" placeholder="Create Password" required autocomplete="new-password"><br>
    <button type="submit">Register</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
</form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r122/three.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.clouds.min.js"></script>
<script>
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
    });
</script>

</body>
</html>
