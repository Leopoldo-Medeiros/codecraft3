<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery</title>
</head>
<body>
    <p>Hello,</p>
    <p>You have requested to reset your password. Click the link below to proceed:</p>
    <a href="{{ url('/password-reset?token=' . $token) }}">Reset Password</a>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>