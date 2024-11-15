<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            font-size: 16px;
            margin: 10px 0 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .flash-message {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Styling the error message */
        .flash-message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Add Course</h1>

        <!-- Flash message for success -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="flash-message">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Form for adding a student -->
        <form action="/course/store" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required><br>

            <label for="price">Course Price (DH):</label>
            <input type="number" id="price" name="price" required><br>

            <button type="submit">Add Course</button>
        </form>
    </div>

</body>
</html>
