<html>
<head>
    <title>GITHUB Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ elixir('css/github.css') }}">
</head>
<body>
<div class="pen-title">
    <h1>Github Login Form</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
    <div class="toggle"></div>
    <div class="form">
        <h2>Login to your account</h2>
        <form action="{{route('github.postlogin')}}" method="POST" class="login-form">
            {{csrf_field()}}
            <b>Login : </b><br>
            <input type="text" name="login" value="<?php env('GITHUB_USER'); ?>">
            <br>
            <b>Password : </b><br>
            <input type="password" name="password" value="<?php env('GITHUB_PASSWORD'); ?>">
            <br>
            <input type="submit" value="log in">
        </form>
    </div>
</div>
</body>
</html>