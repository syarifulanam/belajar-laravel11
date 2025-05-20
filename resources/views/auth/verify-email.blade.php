<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Hi, your verication link already sent to your email.</h2>
    <br>
    <form action="/email/verification-notification" method="POST">
        @csrf
        <input type="submit" value="Resend Email Verification">
    </form>
</body>
</html>