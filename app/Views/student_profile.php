<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <style>
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
    }

    .student-card {
        margin-top: 20px;
        padding: 20px;
        border: 1px dashed #000;
    }

    .print-button {
        margin-top: 20px;
    }

    /* Print-specific styles */
   
</style>

</head>
<body>
    <div class="profile-container">
        <h2>Student Profile</h2>
        
        <!-- Display student photo -->
        <img src="<?= base_url('images/' . esc($student['photo'])) ?>" alt="Student Photo" class="profile-photo">

        <h3><?= esc($student['fullname']) ?></h3>
        <p><strong>Email:</strong> <?= esc($student['email']) ?></p>
        <p><strong>Date of Birth:</strong> <?= esc($student['dob']) ?></p>
        <p><strong>Contact:</strong> <?= esc($student['contact_number']) ?></p>
        <p><strong>Address:</strong> <?= esc($student['address']) ?></p>




        <a href="<?= site_url('student/printCard/' . esc($student['id'])); ?>" target="_blank" class="print-button">Print Profile</a>

        <hr>

        <!-- Student Card Section for Printing -->
       
    </div>
</body>
</html>
