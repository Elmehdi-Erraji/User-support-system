<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our platform!</title>
</head>
<body>
    <h1>Welcome to our platform, {{ $user->name }}!</h1>
    <p>Your login credentials are as follows:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Please log in using these credentials and reset your password for security purposes.</p>
    <p>You can log in <a href="{{ route('login') }}">here</a>.</p>
    <p>Thank you,</p>
    <p>The Platform Team</p>
</body>
</html>
