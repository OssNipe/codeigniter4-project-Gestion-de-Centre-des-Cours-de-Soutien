<!-- app/Views/renew.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Renew Courses</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .status-active {
            color: green;
        }
        .status-expired {
            color: red;
        }
    </style>
</head>
<body>

    <h1>Manage Renewals</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Courses</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($students)) : ?>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?= esc($student['fullname']) ?></td>
                    <td><?= esc($student['email']) ?></td>
                    <td><?= esc($student['contact_number']) ?></td>
                    <td>
                        <ul>
                            <?php foreach ($student['courses'] as $course) : ?>
                                <li>
                                    <?= esc($course['course_name']) ?> - 
                                    Expires on <?= esc($course['expiry_date']) ?>
                                    (<?= $course['status'] === 'Active' ? '<span class="status-active">Active</span>' : '<span class="status-expired">Expired</span>' ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                                <td>
                                   
                                    <a href="<?= site_url('enrollment/add/' . esc($student['id'])) ?>" class="btn btn-primary">Add Course</a>

                                   
                                </td>
                    <td>
                            <a href="<?= site_url('enrollment/renew/' . $student['id']) ?>"
                               class="renew-button">
                                Renew
                            </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="6">No students found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
