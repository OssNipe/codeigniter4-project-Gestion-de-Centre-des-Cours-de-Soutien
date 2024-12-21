<?php include 'sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background-color: #f5f5f5;
            padding: 20px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin: 0;
        }
        .card p {
            font-size: 1.2em;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        <div class="card">
            <h3>Total Students</h3>
            <p><?= esc($totalStudents) ?></p>
        </div>

        <div class="card">
            <h3>Total Courses</h3>
            <p><?= esc($totalCourses) ?></p>
        </div>

        <div class="card">
            <h3>Memberships Expiring Soon</h3>
            <p><?= esc($expiringMemberships) ?></p>
        </div>

        <div class="card">
            <h3>Total Revenue</h3>
            <p><?= number_format($totalRevenue, 2) ?> DH</p>
        </div>

        <div class="card">
            <h3>New Members (Last 30 days)</h3>
            <p><?= esc($newMembers) ?></p>
        </div>

        <div class="card">
            <h3>Expired Memberships</h3>
            <p><?= esc($expiredMemberships) ?></p>
        </div>
    </div>
</body>
</html>
