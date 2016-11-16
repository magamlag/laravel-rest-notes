<html>
    <head>
        <title>Section 2 | GITHUB</title>
    </head>
    <body>
        <form action="{{route('github.postlogin')}}" method = "POST">
            {{csrf_field()}}
            <b>Login : </b><br>
            <input type="text" name = "login" value = "LaravelTester">
            <br>
            <b>Password : </b><br>
            <input type="password" name = "password" value = "123123a">
            <br>
            <input type="submit" value = "log in">
        </form>
    </body>
</html>