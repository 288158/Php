<DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>
<body>
<div style="width: 700px;margin: auto;margin-top: 50px">
    <button onclick="insert();">添加</button>
    <button onclick="out();">注销</button>
    <table border="1">
        <thead>
        <tr>
            <th>list</th>
            <th>work</th>
            <th>status</th>
            <th>leader</th>
            <th>share</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $val)
            <tr>
                <th><a href="todo?id={{$val->id}}">查看</a></th>
                <td>{{$val->work}}</td>
                <td>{{$val->status}}</td>
                <th>{{$val->name}}</th>
                @if(Session::get('name') == $val->name)
                    <td>{{$val->share}}</td>
                    <td>
                        <a href="update_home?id={{$val->id}}">修改</a>
                        <a href="delete_home?id={{$val->id}}">删除</a>
                    </td>
                @endif
                @if(Session::get('name') != $val->name)
                    <td>{{$val->share}}</td>
                    <td>
                        <a href="accept_home?id={{$val->id}}">接受</a>
                        <a href="un_accept_home?id={{$val->id}}">不接受</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
</body>
<script>
    function out() {
        location.href = "{{'out'}}";
    };
    function insert() {
        location.href = "{{'insert'}}";
    };
</script>
</html>
