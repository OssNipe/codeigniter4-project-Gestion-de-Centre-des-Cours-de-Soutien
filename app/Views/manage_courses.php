<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Flash message styling */
        .flash-message {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .flash-message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f1f1f1;
            color: #555;
        }

        td {
            background-color: #fff;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        td a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Manage Courses</h1>

        <!-- Flash message for success -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="flash-message">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Table to display all courses -->
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($courses)) : ?>
                    <?php foreach ($courses as $course) : ?>
                        <tr>
                            <td><?= esc($course['course_name']); ?></td>
                            <td><?= esc($course['price']); ?> DH</td>
                            <td>
                                <a href="<?= site_url('course/edit/' . esc($course['id'])); ?>">Edit</a> | 
                                <a href="<?= site_url('course/delete/' . esc($course['id'])); ?>" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No courses found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</body>
</html>
