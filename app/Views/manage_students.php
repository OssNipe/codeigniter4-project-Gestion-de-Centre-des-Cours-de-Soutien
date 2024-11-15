<!-- app/Views/manage_members.php -->
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            max-width: 1200px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 4px;
        }

        .actions a {
            text-decoration: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-view {
            background-color: #007bff;
        }

        .actions a:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            table th, table td {
                font-size: 14px;
                padding: 10px;
            }

            .actions a {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Manage Students</h1>

    <!-- Display Success Message if available -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="success-message">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Table to display all students -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)) : ?>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= esc($student['id']); ?></td>
                        <td><?= esc($student['fullname']); ?></td>
                        <td><?= esc($student['dob']); ?></td>
                        <td><?= esc($student['email']); ?></td>
                        <td><?= esc($student['contact_number']); ?></td>
                        <td><?= esc($student['address']); ?></td>
                        <td>
                            <?php if ($student['photo']) : ?>
                                <img src="<?= base_url('images/' . $student['photo']) ?>" alt="Student Image" width="80" height="80">
                            <?php else : ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="<?= site_url('student/edit/' . esc($student['id'])); ?>" class="btn-edit">Edit</a>
                            <a href="<?= site_url('student/delete/' . esc($student['id'])); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                            <a href="<?= site_url('student/profile/' . esc($student['id'])); ?>" class="btn-view">View Profile</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" style="text-align:center;">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
