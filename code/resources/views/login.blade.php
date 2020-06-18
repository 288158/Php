<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<form action="loginCheck" method="post">
    用户名:<input type="text" id="name" name="name"><span id="info"></span><br>
    密码:<input type="text" id="password" name="password"><br>
    邮箱:<input type="email" id="email" name="email"><br>
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="button" onclick="register();" value="注册">
    <input type="submit" id="login" value="登录">
</form>
</body>
<script>
    function register() {
        location.href = "{{'register'}}";
    };
</script>
{{--<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')    //携带csrf_token，否则会返回错误500
        }
    });

    $(".btn-submit").click(function (e) {
        document.getElementById("response").innerHTML = "";
        e.preventDefault();
        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();
        $.ajax({
            type: 'POST',
            url: '/loginCheck',
            data: {name: name, password: password, email: email},
            success: function () {
                location.href = "{{'check_user'}}?name="+name+"&password="+password+"&email="+email;
            },
            error: data => {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);    //转json格式，或直接使用 data.responseJSON
                    $.each(errors, function (key, value) {
                        $('#response').addClass("alert alert-danger");
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                console.log(key + " " + value);
                                $('#response').show().append(value + "<br/>");

                            });
                        } else {
                            $('#response').show().append(value + "<br/>"); //this is my div with messages
                        }
                    });
                }
            }
        });
    });
</script>--}}
</html>
