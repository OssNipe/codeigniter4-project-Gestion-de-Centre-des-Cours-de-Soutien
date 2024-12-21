<!-- In app/Views/enrollment/renew.php -->
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Course Enrollment</title>
</head>
<body>

    <h1>Renew Courses for <?= esc($student['fullname']) ?></h1>

    <?php if (session()->getFlashdata('message')) : ?>
        <div style="color: green;">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h3>Current Enrollments</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Duration</th>
                <th>Expiry Date</th>
                <th>Renew</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enrollments as $enrollment): ?>
                <tr>
                    <td><?= esc($enrollment['course_name']); ?></td>
                    <td><?= esc($enrollment['duration']); ?> months</td>
                    <td><?= esc($enrollment['expiry_date']); ?></td>
                    <td>
                        <form action="<?= site_url('enrollment/renew/' . esc($student['id'])); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="enrollment_id" value="<?= esc($enrollment['id']); ?>" />
                            <input type="number" name="renew_duration" min="1" placeholder="Months" required />
                            <button type="submit">Renew</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
