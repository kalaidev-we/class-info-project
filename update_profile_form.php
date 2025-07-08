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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Student Profile</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="update_profile.php" enctype="multipart/form-data" class="row g-3">

                <!-- Personal Information -->
                <h5>Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($user['dob'] ?? '') ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" value="<?= htmlspecialchars($user['father_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control" value="<?= htmlspecialchars($user['mother_name'] ?? '') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">CGPA</label>
                    <input type="text" name="cgpa" class="form-control" value="<?= htmlspecialchars($user['cgpa'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">10th Mark</label>
                    <input type="number" name="mark_10" class="form-control" value="<?= htmlspecialchars($user['mark_10'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">12th Mark (Optional)</label>
                    <input type="number" name="mark_12" class="form-control" value="<?= htmlspecialchars($user['mark_12'] ?? '') ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Aadhar Number</label>
                    <input type="text" name="aadhar_no" class="form-control" value="<?= htmlspecialchars($user['aadhar_no'] ?? '') ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= ($user['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= ($user['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= ($user['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

                <!-- Contact Numbers -->
                <h5 class="mt-4">Contact Numbers</h5>
                <div class="col-md-4">
                    <label class="form-label">Student Phone</label>
                    <input type="text" name="student_phone" class="form-control" value="<?= htmlspecialchars($user['student_phone'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Father's Phone</label>
                    <input type="text" name="father_phone" class="form-control" value="<?= htmlspecialchars($user['father_phone'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mother's Phone</label>
                    <input type="text" name="mother_phone" class="form-control" value="<?= htmlspecialchars($user['mother_phone'] ?? '') ?>" required>
                </div>

                <!-- Occupation & Income -->
                <h5 class="mt-4">Family Details</h5>
                <div class="col-md-6">
                    <label class="form-label">Father's Occupation</label>
                    <input type="text" name="father_occupation" class="form-control" value="<?= htmlspecialchars($user['father_occupation'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mother's Occupation</label>
                    <input type="text" name="mother_occupation" class="form-control" value="<?= htmlspecialchars($user['mother_occupation'] ?? '') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Father's Salary</label>
                    <input type="text" name="father_salary" class="form-control" value="<?= htmlspecialchars($user['father_salary'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mother's Salary</label>
                    <input type="text" name="mother_salary" class="form-control" value="<?= htmlspecialchars($user['mother_salary'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Annual Income</label>
                    <input type="text" name="annual_income" class="form-control" value="<?= htmlspecialchars($user['annual_income'] ?? '') ?>" required>
                </div>

                <!-- Files Section -->
                <h5 class="mt-4">Uploads</h5>
                <div class="col-md-6">
                    <label class="form-label">Student Photo</label><br>
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?= $user['photo'] ?>" width="100" class="img-thumbnail mb-2"><br>
                    <?php endif; ?>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6">
                    <label class="form-label">10th Marksheet</label><br>
                    <?php if (!empty($user['marksheet_10'])): ?>
                        <a href="<?= $user['marksheet_10'] ?>" target="_blank">View Uploaded</a><br>
                    <?php endif; ?>
                    <input type="file" name="marksheet_10" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">12th Marksheet</label><br>
                    <?php if (!empty($user['marksheet_12'])): ?>
                        <a href="<?= $user['marksheet_12'] ?>" target="_blank">View Uploaded</a><br>
                    <?php endif; ?>
                    <input type="file" name="marksheet_12" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Father's Photo</label><br>
                    <?php if (!empty($user['father_photo'])): ?>
                        <img src="<?= $user['father_photo'] ?>" width="100" class="img-thumbnail mb-2"><br>
                    <?php endif; ?>
                    <input type="file" name="father_photo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mother's Photo</label><br>
                    <?php if (!empty($user['mother_photo'])): ?>
                        <img src="<?= $user['mother_photo'] ?>" width="100" class="img-thumbnail mb-2"><br>
                    <?php endif; ?>
                    <input type="file" name="mother_photo" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Community Certificate</label><br>
                    <?php if (!empty($user['community_certificate'])): ?>
                        <a href="<?= $user['community_certificate'] ?>" target="_blank">View Uploaded</a><br>
                    <?php endif; ?>
                    <input type="file" name="community_certificate" class="form-control">
                </div>

                <!-- Submit -->
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-success w-100">Save Profile</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="dashboard.php" class="btn btn-outline-secondary">← Back to Dashboard</a>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
