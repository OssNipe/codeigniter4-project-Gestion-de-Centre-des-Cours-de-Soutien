<!-- app/Views/manage_members.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
</head>
<body>
    <h1>Manage Members</h1>

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
                <th>ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)) : ?>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= esc($student['id']); ?></td>
                        <td><?= esc($student['fullname']); ?></td>
                        <td><?= esc($student['dob']); ?></td>
                        <td><?= esc($student['email']); ?></td>
                        <td><?= esc($student['contact_number']); ?></td>
                        <td><?= esc($student['address']); ?></td>
                        <td>
                            <?php if ($student['photo']) : ?>
                                <img src="<?= base_url('images/' . $student['photo']) ?>" alt="Student Image" width="100" height="100">
                            <?php else : ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Add actions like Edit, Delete here -->
                            <a href="<?= site_url('student/edit/' . esc($student['id'])); ?>">Edit</a> | 
                            <a href="<?= site_url('student/delete/' . esc($student['id'])); ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
