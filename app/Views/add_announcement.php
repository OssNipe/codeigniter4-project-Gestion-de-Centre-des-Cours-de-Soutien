<!-- app/Views/student/add_student.php -->
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        /* Basic Reset */
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
            max-width: 500px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #007bff;
        }

        input[type="file"] {
            padding: 5px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
            text-align: right;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
   
</head>
<body>

<div class="container">
    <h1>Add Anouncement</h1>

    <!-- Flash message for success -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="success-message">
            <?= session()->getFlashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- Form for adding a student -->
    <form action="/announcement/store" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <label for="title">title:</label>
        <input type="text" id="title" name="title" required>

       
        <label for="description"> description:</label>
        <input type="text" id="description" name="description" required>

        
        <label for="image">image :</label>
        <input type="file" id="image" name="image">



        <button type="submit">Add Announcement</button>
    </form>
</div>

</body>
</html>
