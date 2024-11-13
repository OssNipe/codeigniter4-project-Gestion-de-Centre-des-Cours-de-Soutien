<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Enrollment</title>
    <style>
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    

</head>
<body>

<div class="form-container">
    <h2>Enroll <?= esc($student['fullname']) ?> in a New Course</h2>

    <form action="<?= site_url('enrollment/storeEnrollment') ?>" method="POST">
    <?= csrf_field(); ?>

    <!-- Add student_id (hidden field or passed in URL) -->
    <input type="hidden" name="student_id" value="<?= esc($student['id']) ?>">

    <!-- Select course -->
    <label for="course_id">Course:</label>
    <select name="course_id" id="course_id" required>
        <?php foreach ($courses as $course): ?>
            <option value="<?= esc($course['id']) ?>" data-price="<?= esc($course['price']) ?>">
                <?= esc($course['course_name']) ?> - <?= esc($course['price']) ?> DH
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="duration">Duration (in months):</label>
    <input type="number" name="duration" id="duration" min="1" required><br>

    <label for="amount_paid">Amount Paid (in DH):</label>
    <input type="text" name="amount_paid" id="amount_paid" readonly><br>
           
    <button type="submit">Enroll</button>
</form>

</div>

</body>
<script>
    document.getElementById('course_id').addEventListener('change', calculateAmount);
    document.getElementById('duration').addEventListener('input', calculateAmount);

    function calculateAmount() {
        // Get selected course price
        const courseSelect = document.getElementById('course_id');
        const selectedOption = courseSelect.options[courseSelect.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price'));

        // Get duration
        const duration = parseInt(document.getElementById('duration').value);

        // Calculate amount paid
        if (!isNaN(price) && !isNaN(duration) && duration > 0) {
            const amountPaid = price * duration;
            document.getElementById('amount_paid').value = amountPaid.toFixed(2);
        }
    }
</script>
</html>
