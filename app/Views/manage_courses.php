<!-- app/Views/manage_members.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
</head>
<body>
    <h1>Manage Courses</h1>

    <!-- Display Success Message if available -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div style="color: green;">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Table to display all students -->
    <table border="1" cellpadding="10">
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
                        <td><?= esc($course['price']); ?></td>
                        
                       
                        <td>
                            <!-- Add actions like Edit, Delete here -->
                            <a href="<?= site_url('course/edit/' . esc($course['id'])); ?>">Edit</a> | 
                            <a href="<?= site_url('course/delete/' . esc($course['id'])); ?>" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8">No courses found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
