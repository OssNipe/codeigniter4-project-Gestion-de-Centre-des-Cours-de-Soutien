<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Settings</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .logo-preview {
            margin-top: 15px;
        }
        .logo-preview img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>System Settings</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('settings/update') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="system_name">System Name</label>
            <input type="text" name="system_name" id="system_name" value="<?= esc($settings['system_name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo">
        </div>

        <?php if (!empty($settings['logo'])): ?>
            <div class="logo-preview">
                <label>Current Logo:</label><br>
                <img src="<?= base_url($settings['logo']) ?>" alt="Logo">
         </div>
        <?php endif; ?>

        <button type="submit" class="btn">Update Settings</button>
    </form>
</div>

</body>
</html>
