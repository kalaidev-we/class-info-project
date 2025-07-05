<?php
require 'config.php';
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
    <title>Update Profile</title>
</head>
<body>
<h2>Update Student Profile</h2>

<form method="POST" action="update_profile.php" enctype="multipart/form-data">
    <!-- Personal Info -->
    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required><br>
    <input type="text" name="father_name" placeholder="Father's Name" value="<?= htmlspecialchars($user['father_name'] ?? '') ?>" required><br>
    <input type="text" name="mother_name" placeholder="Mother's Name" value="<?= htmlspecialchars($user['mother_name'] ?? '') ?>" required><br>
    <input type="date" name="dob" value="<?= htmlspecialchars($user['dob'] ?? '') ?>" required><br>
    <input type="text" name="cgpa" placeholder="CGPA" value="<?= htmlspecialchars($user['cgpa'] ?? '') ?>" required><br>
    <input type="number" name="mark_10" placeholder="10th Mark" value="<?= htmlspecialchars($user['mark_10'] ?? '') ?>" required><br>
    <input type="number" name="mark_12" placeholder="12th Mark (optional)" value="<?= htmlspecialchars($user['mark_12'] ?? '') ?>"><br>
    <input type="text" name="aadhar_no" placeholder="Aadhar Card No" value="<?= htmlspecialchars($user['aadhar_no'] ?? '') ?>" required><br>

    <!-- File Uploads -->
    <?php if (!empty($user['photo'])): ?>
        <label>Current Profile Photo:</label><br>
        <img src="<?= $user['photo'] ?>" width="100"><br>
    <?php endif; ?>
    <input type="file" name="photo" accept="image/*"><br>

    <?php if (!empty($user['marksheet_10'])): ?>
        <a href="<?= $user['marksheet_10'] ?>" target="_blank">View 10th Marksheet</a><br>
    <?php endif; ?>
    <input type="file" name="marksheet_10"><br>

    <?php if (!empty($user['marksheet_12'])): ?>
        <a href="<?= $user['marksheet_12'] ?>" target="_blank">View 12th Marksheet</a><br>
    <?php endif; ?>
    <input type="file" name="marksheet_12"><br>

    <!-- More Details -->
    <input type="text" name="student_phone" placeholder="Student Phone" value="<?= htmlspecialchars($user['student_phone'] ?? '') ?>" required><br>
    <input type="text" name="father_phone" placeholder="Father's Phone" value="<?= htmlspecialchars($user['father_phone'] ?? '') ?>" required><br>
    <input type="text" name="mother_phone" placeholder="Mother's Phone" value="<?= htmlspecialchars($user['mother_phone'] ?? '') ?>" required><br>

    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male" <?= ($user['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= ($user['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= ($user['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
    </select><br>

    <textarea name="address" placeholder="Address" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea><br>

    <input type="text" name="father_occupation" placeholder="Father's Occupation" value="<?= htmlspecialchars($user['father_occupation'] ?? '') ?>" required><br>
    <input type="text" name="mother_occupation" placeholder="Mother's Occupation" value="<?= htmlspecialchars($user['mother_occupation'] ?? '') ?>" required><br>
    <input type="text" name="father_salary" placeholder="Father's Salary" value="<?= htmlspecialchars($user['father_salary'] ?? '') ?>" required><br>
    <input type="text" name="mother_salary" placeholder="Mother's Salary" value="<?= htmlspecialchars($user['mother_salary'] ?? '') ?>" required><br>
    <input type="text" name="annual_income" placeholder="Annual Income" value="<?= htmlspecialchars($user['annual_income'] ?? '') ?>" required><br>

    <!-- More Files -->
    <?php if (!empty($user['father_photo'])): ?>
        <img src="<?= $user['father_photo'] ?>" width="80"><br>
    <?php endif; ?>
    <input type="file" name="father_photo" accept="image/*"><br>

    <?php if (!empty($user['mother_photo'])): ?>
        <img src="<?= $user['mother_photo'] ?>" width="80"><br>
    <?php endif; ?>
    <input type="file" name="mother_photo" accept="image/*"><br>

    <?php if (!empty($user['community_certificate'])): ?>
        <a href="<?= $user['community_certificate'] ?>" target="_blank">View Community Certificate</a><br>
    <?php endif; ?>
    <input type="file" name="community_certificate"><br>

    <button type="submit">Save Profile</button>
</form>

<a href="dashboard.php">← Back to Dashboard</a>
</body>
</html>
