<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Membership Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        h2, h3 {
            color: #333;
            text-align: center;
        }

        .form-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-container input[type="date"] {
            width: calc(50% - 10px);
            padding: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            padding: 10px 20px;
            color: #fff;
            background-color: #28a745;
            border: none;
            
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .expired {
            color: red;
        }

        .new-student {
            color: green;
        }

        .total-row {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .grand-total-row {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .baba{
            display: flex;
            justify-content: center;
            margin-left: 10%;
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
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
    <form action="<?= site_url('revenue/generate') ?>" method="POST">
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
        <div class="baba">
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
    <?php 
    $grandTotal = 0; // Initialize the grand total variable
    foreach ($students as $student) : 
        $courseCount = count($student['courses']); 
        $totalAmountPaid = 0; // Initialize total amount paid for the student
    ?>
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
                <td><?= esc($course['amount_paid']) ?></td>

                <!-- Add the course amount to the total for the student -->
                <?php $totalAmountPaid += $course['amount_paid']; ?>
            </tr>
        <?php endforeach; ?>

        <!-- Display total amount paid for the student in the last row -->
        <tr class="total-row">
            <td colspan="4" style="text-align: right;"><strong>Total Paid:</strong></td>
            <td><strong><?= esc($totalAmountPaid) ?> DH</strong></td>
        </tr>

        <?php 
        $grandTotal += $totalAmountPaid; // Add student's total amount to grand total
        endforeach; 
        ?>

    <!-- Display grand total at the end of the table -->
    <tr class="grand-total-row">
        <td colspan="4" style="text-align: right;"><strong>Grand Total:</strong></td>
        <td><strong><?= esc($grandTotal) ?> DH</strong></td>
    </tr>
</tbody>
        </table>
        </div>
        <!-- Print Button -->
        <button class="print-button" onclick="printReport()">Print Report</button>
    </div>
<?php endif; ?>

</body>
</html>
