<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sidebar</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            color: #fff;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            background-color: #444;
            margin-bottom: 10px;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            color: #fff;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .sidebar a.active {
            background-color: #007bff;
        }

        .sidebar .toggle-btn {
            display: none;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                text-align: center;
                padding: 10px;
            }

            .sidebar a span {
                display: none;
            }

            .sidebar .toggle-btn {
                display: block;
                cursor: pointer;
                margin: 10px;
            }

            .main-content {
                margin-left: 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>My App</h2>
        <a href="<?= site_url('student/create') ?>" class="active">Create student</a>
        <a href="<?= site_url('students/manage') ?>">Students</a>
        <a href="<?= site_url('course/create') ?>">Create course</a>
        <a href="<?= site_url('courses/manage') ?>">Courses</a>
        <a href="<?= site_url('student/renew') ?>">renew</a>
        <a href="<?= site_url('dashboard') ?>">dashboard</a>
        <a href="<?= site_url('revenue') ?>">revenu Reports</a>
        <a href="<?= site_url('report/membership') ?>">Membership Reports</a>
        <a href="<?= site_url('settings') ?>">Settings</a>
    </div>
</body>
</html>
