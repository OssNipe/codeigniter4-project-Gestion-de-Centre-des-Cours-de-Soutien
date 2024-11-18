<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
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
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="email"], input[type="date"], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        input[type="file"] {
            border: none;
            background-color: #f1f1f1;
            padding: 8px;
            cursor: pointer;
        }

        img.img-thumbnail {
            margin-top: 10px;
            border-radius: 8px;
            display: block;
            max-width: 150px;
            height: auto;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Announcement</h2>

    <!-- Show success or error message -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message'); ?></div>
    <?php endif; ?>

    <!-- Edit form -->
    <form action="<?= site_url('announcement/update/' . $announcement['id']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= old('title', $announcement['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">description:</label>
            <input type="text" id="description" name="description" value="<?= old('description', $announcement['description']); ?>" required>
        </div>

       
        <div class="form-group">
            <label for="image">image:</label>
            <input type="file" id="image" name="image">
            <?php if ($announcement['image']): ?>
                <img src="<?= base_url('images/' . $announcement['image']); ?>" alt="announcement image" class="img-thumbnail">
            <?php endif; ?>
        </div>

        <button type="submit">Update Announcement</button>
    </form>
</div>
</body>
</html>
