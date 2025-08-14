<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <h1>Hello {{ $user['name'] }} </h1>
    <p>Your account has been successfully created on MIS App, you can login using below credentials.</p>
    <p> Email: {{ $user['email'] }} <br> Password: {{ $user['password'] }} </p>
</body>
</html>
