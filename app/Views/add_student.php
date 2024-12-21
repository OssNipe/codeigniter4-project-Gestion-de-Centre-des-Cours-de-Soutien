<!-- app/Views/student/add_student.php -->
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background-color: #fff;
            padding: 30px;
            max-width: 500px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #007bff;
        }

        input[type="file"] {
            padding: 5px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: right;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
    <script>
        function calculateTotal() {
            const courseSelect = document.getElementById('course');
            const durationInput = document.getElementById('duration');
            const price = parseFloat(courseSelect.options[courseSelect.selectedIndex].dataset.price || 0);
            const duration = parseInt(durationInput.value || 0);
            const total = price * duration;
            document.getElementById('total-amount').textContent = 'Total Amount: ' + total.toFixed(2) + ' DH';
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Add Student</h1>

    <!-- Flash message for success -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="success-message">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Form for adding a student -->
    <form action="/student/store" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="photo">Profile Photo:</label>
        <input type="file" id="photo" name="photo">

        <label for="course">Select Course:</label>
        <select id="course" name="course_id" onchange="calculateTotal()" required>
            <option value="">-- Select a Course --</option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= $course['id'] ?>" data-price="<?= $course['price'] ?>">
                    <?= $course['course_name'] ?> - <?= $course['price'] ?> DH/month
                </option>
            <?php endforeach; ?>
        </select>

        <label for="duration">Duration (Months):</label>
        <input type="number" id="duration" name="duration" min="1" value="1" onchange="calculateTotal()" required>

        <p class="total-amount" id="total-amount">Total Amount: 0 DH</p>

        <button type="submit">Add Student</button>
    </form>
</div>

</body>
</html>
