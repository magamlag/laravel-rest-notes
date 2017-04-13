<html>
    <head>
        <title>Section 2 | GITHUB</title>
    </head>
    <body>
        <form action="{{route('github.postlogin')}}" method = "POST">
            {{csrf_field()}}
            <b>Login : </b><br>
            <input type="text" name = "login" value = "<?php env('GITHUB_USER'); ?>">
            <br>
            <b>Password : </b><br>
            <input type="password" name = "password" value = "<?php env('GITHUB_PASSWORD'); ?>">
            <br>
            <input type="submit" value = "log in">
        </form>
    </body>
</html>