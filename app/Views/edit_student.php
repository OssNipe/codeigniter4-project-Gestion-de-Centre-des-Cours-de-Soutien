
<div class="container">
    <h2>Edit Student</h2>

    <!-- Show success or error message -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message'); ?></div>
    <?php endif; ?>

    <!-- Edit form -->
    <form action="<?= site_url('student/update/' . $student['id']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="fullname">Full Name:</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= old('fullname', $student['fullname']); ?>" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?= old('dob', $student['dob']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $student['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= old('contact_number', $student['contact_number']); ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" required><?= old('address', $student['address']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <!-- Show the existing photo if available -->
            <?php if ($student['photo']): ?>
                <img src="<?= base_url('images/' . $student['photo']); ?>" alt="Student Photo" class="img-thumbnail" style="width: 150px;">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>

