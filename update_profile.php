<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$roll_no = $user['roll_no'];

// Function to reuse for all file uploads
function handleFileUpload($field, $prefix, $existingPath) {
    if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
        $filename = time() . "_{$prefix}_" . basename($_FILES[$field]['name']);
        $targetPath = "uploads/" . $filename;
        move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath);
        return $targetPath;
    }
    return $existingPath;
}

// Inputs
$email = $_POST['email'];
$father = $_POST['father_name'];
$mother = $_POST['mother_name'];
$dob = $_POST['dob'];
$cgpa = $_POST['cgpa'];
$mark10 = $_POST['mark_10'];
$mark12 = $_POST['mark_12'] ?: null;
$aadhar = $_POST['aadhar_no'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$student_phone = $_POST['student_phone'];
$father_phone = $_POST['father_phone'];
$mother_phone = $_POST['mother_phone'];
$father_occupation = $_POST['father_occupation'];
$mother_occupation = $_POST['mother_occupation'];
$father_salary = $_POST['father_salary'];
$mother_salary = $_POST['mother_salary'];
$annual_income = $_POST['annual_income'];

// File fields
$photo_path = handleFileUpload('photo', 'profile', $user['photo']);
$marksheet10_path = handleFileUpload('marksheet_10', '10th', $user['marksheet_10']);
$marksheet12_path = handleFileUpload('marksheet_12', '12th', $user['marksheet_12']);
$father_photo_path = handleFileUpload('father_photo', 'father', $user['father_photo']);
$mother_photo_path = handleFileUpload('mother_photo', 'mother', $user['mother_photo']);
$community_cert_path = handleFileUpload('community_certificate', 'community', $user['community_certificate']);

// Update the database
$stmt = $conn->prepare("UPDATE users SET 
    email=?, father_name=?, mother_name=?, dob=?, cgpa=?, mark_10=?, mark_12=?, aadhar_no=?,
    photo=?, marksheet_10=?, marksheet_12=?,
    gender=?, address=?, student_phone=?, father_phone=?, mother_phone=?,
    father_occupation=?, mother_occupation=?, father_salary=?, mother_salary=?, annual_income=?,
    father_photo=?, mother_photo=?, community_certificate=?
    WHERE roll_no=?");

$stmt->execute([
    $email, $father, $mother, $dob, $cgpa, $mark10, $mark12, $aadhar,
    $photo_path, $marksheet10_path, $marksheet12_path,
    $gender, $address, $student_phone, $father_phone, $mother_phone,
    $father_occupation, $mother_occupation, $father_salary, $mother_salary, $annual_income,
    $father_photo_path, $mother_photo_path, $community_cert_path,
    $roll_no
]);

// Refresh session
$stmt = $conn->prepare("SELECT * FROM users WHERE roll_no = ?");
$stmt->execute([$roll_no]);
$_SESSION['user'] = $stmt->fetch();

header("Location: dashboard.php");
exit();
