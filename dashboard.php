<?php
require 'config.php';
session_start();

$user = $_SESSION['user'] ?? null;

if (!$user || !isset($user['roll_no'])) {
    echo "<p>You are not logged in. <a href='login.php'>Login</a></p>";
    exit();
}

$roll_no = $user['roll_no'];

// Using PDO-style query to fetch student data
$stmt = $conn->prepare("SELECT * FROM student_records WHERE roll_no = :roll_no");
$stmt->execute([':roll_no' => $roll_no]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    echo "<p>No record found.</p>";
    exit();
}

function displayRow($label, $value) {
    echo "<tr><td><strong>$label</strong></td><td>" . htmlspecialchars($value) . "</td></tr>";
}

function displayFile($label, $path) {
    if ($path) {
        $filename = basename($path);
        echo "<tr><td><strong>$label</strong></td><td>
            <a href='$path' target='_blank'>$filename</a><br>
            <img src='$path' alt='$label' style='height:80px; margin-top:5px; border-radius:5px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);'>
        </td></tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 960px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            overflow: hidden;
            padding: 30px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h3 {
            margin: 0;
            background: #0d3c78;
            color: white;
            padding: 12px 20px;
            border-radius: 6px 6px 0 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        td {
            padding: 12px 16px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }
        .buttons a {
            text-decoration: none;
            padding: 12px 24px;
            font-weight: bold;
            border-radius: 8px;
            background: linear-gradient(to right, #0d3c78, #2c5aa0);
            color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        .buttons a:hover {
            background: linear-gradient(to right, #1e5799, #2980b9);
            transform: translateY(-2px);
        }
        img {
            max-height: 100px;
            border-radius: 8px;
        }
        @media (max-width: 600px) {
            .buttons {
                flex-direction: column;
                gap: 15px;
            }
            td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($student['name']) ?> (<?= htmlspecialchars($student['roll_no']) ?>)</h2>

    <!-- Personal Details -->
    <div class="section">
        <h3>Personal Details</h3>
        <table>
            <?php
            displayRow("Name", $student['name']);
            displayRow("Roll No", $student['roll_no']);
            displayRow("Aadhaar", $student['aadhaar']);
            displayRow("Email", $student['email']);
            displayRow("DOB", $student['dob']);
            displayRow("Religion", $student['religion']);
            displayRow("Community", $student['community']);
            displayRow("Blood Group", $student['blood_group']);
            displayRow("Differently Abled", $student['abled']);
            displayRow("Father's Name", $student['father_name']);
            displayRow("Mother's Name", $student['mother_name']);
            displayFile("Student Photo", $student['student_photo']);
            displayFile("Father Photo", $student['father_photo']);
            displayFile("Mother Photo", $student['mother_photo']);
            ?>
        </table>
    </div>

    <!-- Contact Information -->
    <div class="section">
        <h3>Contact Information</h3>
        <table>
            <?php
            displayRow("Address", $student['address']);
            displayRow("PIN", $student['pin']);
            displayRow("Change of Address", $student['address_change']);
            displayRow("Student Mobile", $student['student_mobile']);
            displayRow("Father Mobile", $student['father_mobile']);
            displayRow("Mother Mobile", $student['mother_mobile']);
            ?>
        </table>
    </div>

    <!-- Bank Details -->
    <div class="section">
        <h3>Bank Details</h3>
        <table>
            <?php
            displayRow("Bank A/C", $student['bank_ac']);
            displayRow("Bank Name", $student['bank_name']);
            displayRow("IFSC Code", $student['ifsc']);
            ?>
        </table>
    </div>

    <!-- Study Details -->
    <div class="section">
        <h3>Study Details</h3>
        <table>
            <?php
            displayRow("Branch", $student['branch']);
            displayRow("EMIS ID", $student['emis_id']);
            displayRow("UMIS ID", $student['umis_id']);
            displayFile("10th Marksheet", $student['marksheet_10']);
            displayFile("12th Marksheet", $student['marksheet_12']);
            ?>
        </table>
    </div>

    <!-- Navigation Buttons -->
    <div class="buttons">
        <a href="academic_dashboard.php">📘 Academic Dashboard</a>
        <a href="update_profile_form.php">✏️ Update Profile</a>
        <a href="logout.php">🔒 Logout</a>
    </div>
</div>

</body>
</html>
