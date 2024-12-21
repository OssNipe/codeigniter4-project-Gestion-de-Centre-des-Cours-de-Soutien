<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Groups</title>
</head>
<body>
    <h1>User Groups Management</h1>

    <?php if (isset($message)): ?>
        <p style="color: green;"><?= esc($message) ?></p>
    <?php endif; ?>

    <h2>User Details</h2>
    <p><strong>ID:</strong> <?= esc($user->id) ?></p>
    <p><strong>Username:</strong> <?= esc($user->username) ?></p>
    <p><strong>Email:</strong> <?= esc($user->email) ?></p>

    <h2>Groups Added</h2>
    <ul>
        <?php foreach ($groups as $group): ?>
            <li><?= esc($group) ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="/">Go Back</a>
</body>
</html>
