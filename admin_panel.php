<?php
require 'config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Redirect if the user is not an admin
if ($user['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Get only student records
$stmt = $conn->prepare("SELECT * FROM users WHERE role = 'student' ORDER BY roll_no ASC");
$stmt->execute();
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 30px;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        img {
            max-width: 60px;
            height: auto;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
     <script>
        function searchTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#studentTable tbody tr");

            rows.forEach(row => {
                const rollNo = row.querySelector("td:nth-child(1)")?.innerText.toLowerCase();
                const name = row.querySelector("td:nth-child(10)")?.innerText.toLowerCase();
                if (rollNo.includes(input) || name.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>

<h2>Admin Panel - Student Records</h2>
<div class="greeting">Welcome back, <strong><?= htmlspecialchars($user['name']) ?></strong></div>
<div class="search-box">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by Roll No or Name...">
</div>
<table>
    <thead>
        <tr>
            <th>Roll No</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>CGPA</th>
            <th>10th</th>
            <th>12th</th>
            <th>Aadhar</th>
            <th>Father</th>
            <th>Mother</th>
            <th>Father Photo</th>
            <th>Mother Photo</th>
            <th>Community Cert</th>
            <th>10th Marksheet</th>
            <th>12th Marksheet</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Annual Income</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['roll_no']) ?></td>
            <td><img src="<?= $row['photo'] ?>" alt="Photo"></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['student_phone']) ?></td>
            <td><?= htmlspecialchars($row['dob']) ?></td>
            <td><?= htmlspecialchars($row['cgpa']) ?></td>
            <td><?= htmlspecialchars($row['mark_10']) ?></td>
            <td><?= $row['mark_12'] ?: '-' ?></td>
            <td><?= htmlspecialchars($row['aadhar_no']) ?></td>
            <td><?= htmlspecialchars($row['father_name']) ?></td>
            <td><?= htmlspecialchars($row['mother_name']) ?></td>
            <td>
                <?= $row['father_photo'] ? "<img src='{$row['father_photo']}' alt='Father'>" : '-' ?>
            </td>
            <td>
                <?= $row['mother_photo'] ? "<img src='{$row['mother_photo']}' alt='Mother'>" : '-' ?>
            </td>
            <td>
                <?= $row['community_certificate'] ? "<a href='{$row['community_certificate']}' target='_blank'>View</a>" : '-' ?>
            </td>
            <td>
                <?= $row['marksheet_10'] ? "<a href='{$row['marksheet_10']}' target='_blank'>View</a>" : '-' ?>
            </td>
            <td>
                <?= $row['marksheet_12'] ? "<a href='{$row['marksheet_12']}' target='_blank'>View</a>" : '-' ?>
            </td>
            <td><?= nl2br(htmlspecialchars($row['address'])) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td>₹<?= number_format($row['annual_income']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
