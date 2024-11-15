<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .profile-container {
            background-color: #fff;
            max-width: 600px;
            width: 100%;
            margin: 20px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 15px;
            font-size: 24px;
            color: #444;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        .print-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 2px solid #eee;
        }

        /* Student Card Section */
        .student-card {
            padding: 20px;
            border: 1px dashed #007bff;
            border-radius: 10px;
            margin-top: 20px;
            background-color: #f9f9f9;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: white;
            }

            .profile-container {
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
            }

            .print-button {
                display: none;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                padding: 20px;
                margin: 10px;
            }

            .profile-photo {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Student Profile</h2>
        
        <!-- Display student photo -->
        <?php if (!empty($student['photo'])): ?>
            <img src="<?= base_url('images/' . esc($student['photo'])) ?>" alt="Student Photo" class="profile-photo">
        <?php else: ?>
            <img src="<?= base_url('images/default.png') ?>" alt="Default Photo" class="profile-photo">
        <?php endif; ?>

        <h3><?= esc($student['fullname']) ?></h3>
        <p><strong>Email:</strong> <?= esc($student['email']) ?></p>
        <p><strong>Date of Birth:</strong> <?= esc($student['dob']) ?></p>
        <p><strong>Contact:</strong> <?= esc($student['contact_number']) ?></p>
        <p><strong>Address:</strong> <?= esc($student['address']) ?></p>

        <!-- Print Button -->
        <a href="<?= site_url('student/printCard/' . esc($student['id'])); ?>" target="_blank" class="print-button">Print Profile</a>

        <hr>

        <!-- Student Card Section for Printing -->
        <div class="student-card">
            <h3>Student ID Card</h3>
            <p><strong>Full Name:</strong> <?= esc($student['fullname']) ?></p>
            <p><strong>Email:</strong> <?= esc($student['email']) ?></p>
            <p><strong>Contact:</strong> <?= esc($student['contact_number']) ?></p>
        </div>
    </div>
</body>
</html>
