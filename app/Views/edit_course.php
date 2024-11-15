<?php include 'sidebar.php'; ?>

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
            <label for="course_name">Course Name:</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="<?= old('course_name', $course['course_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Course Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= old('price', $course['price']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>

<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .container {
        width: 100%;
        max-width: 600px;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .container {
            width: 90%;
            padding: 20px;
        }

        h2 {
            font-size: 20px;
        }
    }
</style>
