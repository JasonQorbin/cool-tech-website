<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Register new user</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="fixed-top-left">
    <x-home-button/>
</div>
<div class="centre">
    <div class="vertical">
        <h1>Cool Tech | Register new user</h1>
        <form class="vertical" action="/register" method="post">
            {{ csrf_field() }}
            <div class="horizontal middle">
                <label for="name">Name:</label>
                <input id="name" type="text" placeholder="Name" name="name" required>
            </div>
            <div class="horizontal middle">
                <label for="email">Email:</label>
                <input id="email" type="email" placeholder="Email" name="email" required>
            </div>
            <div class="horizontal middle">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Password" required>
            </div>
            <div class="horizontal middle">
                <label for="password">Retype Password</label>
                <input id="second-password" type="password" placeholder="Retype password" required>
            </div>
            <div class="horizontal middle">
                <input type="submit" name="login-button" id="login-button" class    ="submit-button" value="Create account">
            </div>
        </form>
        <div class="horizontal middle"><a href>Already have an account</a></div>
    </div>
</div>
</body>
</html>
