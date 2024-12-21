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
        <a href="<?= site_url('student/create') ?>" class="<?= uri_string() == 'student/create' ? 'active' : '' ?>">Create student</a>
        <a href="<?= site_url('students/manage') ?>" class="<?= uri_string() == 'students/manage' ? 'active' : '' ?>">Students</a>
        <a href="<?= site_url('course/create') ?>" class="<?= uri_string() == 'course/create' ? 'active' : '' ?>">Create course</a>
        <a href="<?= site_url('courses/manage') ?>" class="<?= uri_string() == 'courses/manage' ? 'active' : '' ?>">Courses</a>
        <a href="<?= site_url('student/renew') ?>" class="<?= uri_string() == 'student/renew' ? 'active' : '' ?>">Renew</a>
        <a href="<?= site_url('dashboard') ?>" class="<?= uri_string() == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= site_url('revenue') ?>" class="<?= uri_string() == 'revenue' ? 'active' : '' ?>">Revenue Reports</a>
        <a href="<?= site_url('report/membership') ?>" class="<?= uri_string() == 'report/membership' ? 'active' : '' ?>">Membership Reports</a>
        <a href="<?= site_url('announcements/manage') ?>" class="<?= uri_string() == 'announcements/manage' ? 'active' : '' ?>">Announcements</a>
        <a href="<?= site_url('settings') ?>" class="<?= uri_string() == 'settings' ? 'active' : '' ?>">Settings</a>
        <a href="<?= site_url('logout') ?>" class="<?= uri_string() == 'logout' ? 'active' : '' ?> logout-btn">Logout</a>
    </div>
</body>
</html>
