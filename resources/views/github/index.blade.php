<html>
    <head>
        <title>GITHUB Login Form</title>
        <link rel="stylesheet" href="{{ elixir('css/github.css') }}">
    </head>
    <body>
    <div class="login-page">
        <div class="form">
        <form action="{{route('github.postlogin')}}" method = "POST" class="login-form">
            {{csrf_field()}}
            <b>Login : </b><br>
            <input type="text" name = "login" value = "<?php env('GITHUB_USER'); ?>">
            <br>
            <b>Password : </b><br>
            <input type="password" name = "password" value = "<?php env('GITHUB_PASSWORD'); ?>">
            <br>
            <input type="submit" value = "log in">
        </form>
        </div>
    </div>
    </body>
</html>