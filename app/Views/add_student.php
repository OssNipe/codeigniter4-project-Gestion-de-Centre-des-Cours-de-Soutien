<!-- app/Views/student/add_student.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
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
<body>

    <h1>Add Student</h1>

    <!-- Flash message for success -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div style="color: green;">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Form for adding a student -->
    <form action="/student/store" method="POST"enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>


        <label for="photo">Profile Photo:</label>
        <input type="file" id="photo" name="photo"><br>

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

        <p id="total-amount">Total Amount: 0 DH</p>

        <button type="submit">Add Student</button>
    </form>

</body>
</html>
