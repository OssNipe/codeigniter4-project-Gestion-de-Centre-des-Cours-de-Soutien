<!-- app/Views/student/add_student.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>

    <h1>Add Course</h1>

    <!-- Flash message for success -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div style="color: green;">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Form for adding a student -->
    <form action="/course/store" method="POST"enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <label for="fullname">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required><br>

        <label for="price">Course Price:</label>
        <input type="number" id="price" name="price" required><br>

        <button type="submit">Add Course</button>
    </form>

</body>
</html>
