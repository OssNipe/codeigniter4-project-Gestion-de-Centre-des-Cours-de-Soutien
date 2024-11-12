
<div class="container">
    <h2>Edit Course</h2>

    <!-- Show success or error message -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message'); ?></div>
    <?php endif; ?>

    <!-- Edit form -->
    <form action="<?= site_url('course/update/' . $course['id']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="course_name">Full Name:</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="<?= old('course_name', $course['course_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Date of Birth:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= old('price', $course['price']); ?>" required>
        </div>

        

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>

