<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>
<body>
    <h1>This is a public page</h1>
    <ul>
        <li><a class="btn btn-dark" href="<?= site_url('/auth/register'); ?>">To Register Page</a></li>
        <li><a class="btn btn-dark" href="<?= site_url('/auth/login'); ?>">To Login Page</a></li>
        <li><a class="btn btn-dark" href="<?= site_url('/admin'); ?>">To Admin Page</a></li>
    </ul>
</body>
</html>