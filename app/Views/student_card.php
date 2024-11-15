
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Membership Card</title>
    <style>
        body {
            background: #222;
            padding: 2rem;
            font-family: helvetica;
        }

        .card {
            background: rgb(192, 178, 195);
            background: linear-gradient(36deg, rgba(192, 178, 195, 1) 0%, rgba(253, 243, 255, 1) 36%, rgba(246, 235, 248, 1) 64%, rgba(202, 187, 205, 1) 100%);
            border-radius: 10px;
            margin: auto;
            width: 500px;
            height: 280px;
            box-shadow: 2px 5px 15px 5px #00000030;
            display: flex;
            flex-flow: column;
            transition: all 1s;
        }

        .card:hover {
            box-shadow: 10px 10px 15px 5px #00000030;
        }

        img {
            width: 5rem;
            height: 4rem;
        }

        .title {
            display: flex;
            justify-content: space-between;
            flex-flow: row-reverse;
            padding: 0.5rem 1.5rem 0.5rem 1.5rem;
            text-transform: uppercase;
            font-size: 12px;
            color: #00000090;
        }

        .emboss {
            padding: 1rem 1.5rem 0 1.5rem;
            font-size: 18px;
            color: black;
            font-family: courier;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .emboss2 {
            padding: 1rem 1.5rem 0 10rem;
            font-size: 11px;
            color: black;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hologram {
 
            width: 6.5rem; /* Adjust the width as needed */
            height: 6.5rem; /* Adjust the height as needed */
            background-size: 400%;
            float: right;
            /* border-radius: 10px; */
            margin-left: auto;
            margin: -5rem 1.5rem 0 auto;
            /* animation: Gradient 15s ease infinite; */
        }

        .photo {
        width: 5rem; /* Adjust the width as needed */
        height: 5rem; /* Adjust the height as needed */
        border-radius: 50%;
        overflow: hidden;
        margin: 1rem; /* Adjust margin as needed */
        float: right;
    }

    .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

        @keyframes Gradient {
            0% {
                background-position: 30% 0%;
            }
            50% {
                background-position: 71% 100%;
            }
            100% {
                background-position: 30% 0%;
            }
        }

        
    </style>
</head>
<script>
        window.onload = function() {
            window.print(); // Trigger the print dialog automatically
        }
    </script>
<body>
    <div class="card">
        <span class="title">Membership card
        <!-- <img src="https://i0.wp.com/revisewise.ie/wp-content/uploads/2019/07/Your-Logo-here.png?ssl=1" /> -->
   
        <?php if (!empty($logo)) : ?>
    <img src="<?= base_url($logo) ?>" alt="Logo" class="logo">
<?php endif; ?>        
    </span>
        <span class="emboss"><b><?= esc($system_name) ?></b></span>
        <span class="emboss"><b><?= esc($student['id']) ?></b></span>
        <span class="emboss"><?= esc($student['fullname']) ?></span>
        <div>
        <span class="emboss"><?= esc($student['email']) ?> </span>

        </div>
        <div>
            <span class="emboss"><b>Membership: membership</b></span>
            <span class='logo'><img src="<?= base_url('images/' . esc($student['photo'])) ?>" alt="logo
            "></span>
        </div>
        
        <div>
        <hr><small>
       <!--  <span class="emboss2">Valid till :</span>-->
        </small>
    </div>
    <?php if (!empty($courses)) : ?>
    <h3>Enrolled Courses</h3>
    <table>
        <tr>
            <th>Course Name</th>
            <th>Amount Paid</th>
            <th>Expiry Date</th>
        </tr>
        <?php foreach ($courses as $course) : ?>
        <tr>
            <td><?= esc($course['course_name']) ?></td>
            <td><?= esc($course['amount_paid']) ?> DH</td>
            <td><?= esc($course['expiry_date']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No courses enrolled.</p>
<?php endif; ?>
    </div>

   
</body>
<!-- Visit codeastro.com for more projects -->
</html>
