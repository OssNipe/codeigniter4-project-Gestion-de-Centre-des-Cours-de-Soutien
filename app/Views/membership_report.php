<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Membership Report</title>
    <style>
        .form-container {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #f4f4f4;
        }

        .expired {
            color: red;
        }

        .new-student {
            color: green;
        }

        .print-button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #printable-section, #printable-section * {
                visibility: visible;
            }
            #printable-section {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
            .no-print {
                display: none;
            }
        }
    </style>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>
<body>

<h2>Student Membership Report</h2>

<!-- Date Filter Form -->
<div class="form-container">
    <form action="<?= site_url('report/generate') ?>" method="POST">
        <?= csrf_field(); ?>
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required>
        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required>
        <button type="submit">Generate Report</button>
    </form>
</div>

<?php if (isset($students)) : ?>
    <div id="printable-section">
        <h3>Report from <?= esc($fromDate) ?> to <?= esc($toDate) ?></h3>

        <!-- Report Table -->
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Expires On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <?php $courseCount = count($student['courses']); ?>
                    <?php foreach ($student['courses'] as $index => $course) : ?>
                        <tr>
                            <!-- Merge student info cells for multiple courses -->
                            <?php if ($index === 0) : ?>
                                <td rowspan="<?= $courseCount ?>"><?= esc($student['fullname']) ?></td>
                                <td rowspan="<?= $courseCount ?>"><?= esc($student['contact_number']) ?></td>
                                <td rowspan="<?= $courseCount ?>"><?= esc($student['email']) ?></td>
                            <?php endif; ?>

                            <!-- Display course details -->
                            <td><?= esc($course['course_name']) ?></td>
                            <td><?= esc($course['expiry_date']) ?></td>

                            <!-- Determine and display course status -->
                            <td>
                                <?php
                                    $currentDate = new DateTime();
                                    $expiryDate = new DateTime($course['expiry_date']);
                                    $statusText = '';
                                    
                                    if ($currentDate > $expiryDate) {
                                        $interval = $currentDate->diff($expiryDate);
                                        $statusText = '<span class="expired">Expired (' . $interval->days . ' days)</span>';
                                    } elseif (isset($course['is_new']) && $course['is_new']) {
                                        $statusText = '<span class="new-student">New Student</span>';
                                    } else {
                                        $statusText = 'Active';
                                    }
                                    
                                    echo $statusText;
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Print Button -->
        <button class="print-button" onclick="printReport()">Print Report</button>
    </div>
<?php endif; ?>

</body>
</html>
