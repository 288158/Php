<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
</head>
<body>
<form action="/add" method="post">
    用户名:<input type="text" id="name" name="name"><span id="info"></span><br>
    密码:<input type="text" id="password" name="password"><br>
    邮箱:<input type="email" id="email" name="email"><br>
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="submit" value="注册">
</form>
</body>
</html>
