<!-- app/Views/student/add_student.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
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

        <button type="submit">Add Student</button>
    </form>

</body>
</html>
