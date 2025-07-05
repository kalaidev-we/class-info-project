<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6fa;
        }
        .header {
            background-color: #0d3c78;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }
        .profile-left {
            flex: 1;
            min-width: 300px;
            padding: 40px;
            background: #ffffff;
            text-align: center;
            border-right: 1px solid #e5e5e5;
        }
        .profile-left img {
            border-radius: 50%;
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid #0d3c78;
        }
        .profile-left h2 {
            margin: 15px 0 5px;
        }
        .profile-left p {
            font-size: 14px;
            color: #666;
        }
        .profile-right {
            flex: 2;
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }
        .profile-item {
            background-color: #f7f9fc;
            padding: 15px 20px;
            border-left: 4px solid #0d3c78;
            border-radius: 8px;
        }
        .profile-item strong {
            display: block;
            color: #333;
            font-size: 14px;
        }
        .profile-item span {
            font-size: 15px;
            color: #555;
        }
        .full-width {
            grid-column: 1 / 3;
        }
        .photo-mini {
            margin-top: 10px;
            width: 100px;
            border-radius: 8px;
        }
        .btn-container {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background: #0d3c78;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s ease;
        }
        .btn:hover {
            background: #094291;
        }
        a {
            color: #0d3c78;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>ECAMPUS</h1>
    <div>K</div>
</div>

<div class="dashboard-container">
    <div class="profile-left">
        <img src="<?= htmlspecialchars($user['photo']) ?>" alt="Profile">
        <h2><?= htmlspecialchars($user['name']) ?></h2>
        <p>DIPLOMA INFORMATION TECHNOLOGY</p>
    </div>

    <div class="profile-right">
        <div class="profile-item"><strong>Roll No</strong><span><?= $user['roll_no'] ?></span></div>
        <div class="profile-item"><strong>Batch</strong><span>2023</span></div>
        <div class="profile-item"><strong>Email</strong><span><?= $user['email'] ?></span></div>
        <div class="profile-item"><strong>Phone</strong><span><?= $user['student_phone'] ?></span></div>
        <div class="profile-item"><strong>Emergency Contact</strong><span><?= $user['father_phone'] ?></span></div>
        <div class="profile-item"><strong>Semester</strong><span>5</span></div>
        <div class="profile-item"><strong>Father</strong><span><?= $user['father_name'] ?></span></div>
        <div class="profile-item"><strong>Mother</strong><span><?= $user['mother_name'] ?></span></div>
        <div class="profile-item"><strong>DOB</strong><span><?= $user['dob'] ?></span></div>
        <div class="profile-item"><strong>Gender</strong><span><?= $user['gender'] ?></span></div>
        <div class="profile-item"><strong>CGPA</strong><span><?= $user['cgpa'] ?></span></div>
        <div class="profile-item"><strong>10th Mark</strong><span><?= $user['mark_10'] ?></span></div>
        <div class="profile-item"><strong>12th Mark</strong><span><?= $user['mark_12'] ?: 'Not Provided' ?></span></div>
        <div class="profile-item"><strong>Aadhar</strong><span><?= $user['aadhar_no'] ?></span></div>
        <div class="profile-item"><strong>Father's Occupation</strong><span><?= $user['father_occupation'] ?></span></div>
        <div class="profile-item"><strong>Mother's Occupation</strong><span><?= $user['mother_occupation'] ?></span></div>
        <div class="profile-item"><strong>Father's Salary</strong><span>₹<?= $user['father_salary'] ?></span></div>
        <div class="profile-item"><strong>Mother's Salary</strong><span>₹<?= $user['mother_salary'] ?></span></div>
        <div class="profile-item"><strong>Annual Income</strong><span>₹<?= $user['annual_income'] ?></span></div>
        <div class="profile-item full-width"><strong>Address</strong><span><?= nl2br(htmlspecialchars($user['address'])) ?></span></div>

        <?php if ($user['father_photo']): ?>
            <div class="profile-item"><strong>Father's Photo</strong><br>
                <img src="<?= $user['father_photo'] ?>" class="photo-mini">
            </div>
        <?php endif; ?>

        <?php if ($user['mother_photo']): ?>
            <div class="profile-item"><strong>Mother's Photo</strong><br>
                <img src="<?= $user['mother_photo'] ?>" class="photo-mini">
            </div>
        <?php endif; ?>

        <?php if ($user['community_certificate']): ?>
            <div class="profile-item full-width">
                <strong>Community Certificate</strong><br>
                <a href="<?= $user['community_certificate'] ?>" target="_blank">View Document</a>
            </div>
        <?php endif; ?>

        <?php if ($user['marksheet_10']): ?>
            <div class="profile-item"><strong>10th Marksheet</strong><br>
                <a href="<?= $user['marksheet_10'] ?>" target="_blank">View Document</a>
            </div>
        <?php endif; ?>

        <?php if ($user['marksheet_12']): ?>
            <div class="profile-item"><strong>12th Marksheet</strong><br>
                <a href="<?= $user['marksheet_12'] ?>" target="_blank">View Document</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="btn-container">
    <a href="update_profile_form.php" class="btn">Update Profile</a>
    <a href="logout.php" class="btn">Logout</a>
</div>

</body>
</html>
