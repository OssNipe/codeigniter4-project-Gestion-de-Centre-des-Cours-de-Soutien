<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Settings</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }

        /* Container Styling for Form */
        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 30px;
            margin-top: 20px;
        }

        /* Form Header */
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Flash message styling */
        .alert {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form Group styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            outline-color: #007bff;
        }

        /* Button Styling */
        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Logo Preview Styling */
        .logo-preview {
            margin-top: 20px;
            text-align: center;
        }

        .logo-preview img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .btn {
                font-size: 14px;
            }

            .logo-preview img {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>System Settings</h2>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <!-- Form to update system settings -->
    <form action="<?= site_url('settings/update') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- System Name Input -->
        <div class="form-group">
            <label for="system_name">System Name</label>
            <input type="text" name="system_name" id="system_name" value="<?= esc($settings['system_name']) ?>" required>
        </div>

        <!-- Logo Upload Input -->
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo">
        </div>

        <!-- Current Logo Preview -->
        <?php if (!empty($settings['logo'])): ?>
            <div class="logo-preview">
                <label>Current Logo:</label><br>
                <img src="<?= base_url($settings['logo']) ?>" alt="Logo">
            </div>
        <?php endif; ?>

        <!-- Submit Button -->
        <button type="submit" class="btn">Update Settings</button>
    </form>
</div>

</body>
</html>
