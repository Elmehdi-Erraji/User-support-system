<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello,</p>

    <p>You are receiving this email because a password reset request was made for your account.</p>

    <p>Please click on the following link to reset your password:</p>

    <p><a href="{{ route('showResetForm', ['email' => $email, 'token' => $token]) }}">Reset Password</a></p>

    <p>If you did not request a password reset, no further action is required.</p>

    <p>Thank you!</p>
</body>
</html>