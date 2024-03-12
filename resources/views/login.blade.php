<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cool Tech | Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<div class="fixed-top-left">
    <x-home-button/>
</div>
<div class="centre">
    <div class="vertical">
        <h1>Cool Tech | User Login</h1>
        <form class="vertical" action="/login" method="post">
            {{ csrf_field() }}
            <div class="horizontal middle">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="horizontal middle">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="horizontal middle">
                <input type="submit" name="login-button" id="login-button" class="submit-button" value="Log-in">
            </div>
        </form>
        <div class="horizontal middle"><a href="/register">Register</a><span>|</span><a>Forgot my password</a></div>
    </div>
</div>
</body>
</html>
