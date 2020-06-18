<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script>
        function del_friend(id) {
            //用户安全提示
            if (confirm("您确定要删除吗？")){
                location.href = "delete_friend?id="+id;
            }
        }

        window.onload = function () {
            //删除选中的记录
            document.getElementById("delSelect").onclick = function () {
                //表单提交
                if (confirm("您确定要删除选中条目吗？")) {
                    let flag = false;
                    //判断是否有选中条目
                    let cbs = document.getElementsByName("uid");
                    for (let i = 0; i < cbs.length; i++) {
                        if (cbs[i].checked){
                            flag = true;
                            break;
                        }
                    }
                    if (flag) {
                        document.getElementById("form").submit();
                    }
                }
            }

            //全选功能 使checked状态相同
            document.getElementById("firstCb").onclick = function () {
                let cbs = document.getElementsByName("uid");
                for (let i = 0; i < cbs.length; i++) {
                    cbs[i].checked = this.checked;
                }
            }
        }
    </script>
    <body>
    <div style="width: 650px; margin:auto; margin-top: 50px">
        <div style="float: left">
            <a href="add_list">添加</a>
            <a href="list_all">全部</a>
            <a href="list_do">进行中</a>
            <a href="list_end">已完成</a>
            <a href="del_list_end">删除已完成</a>
            <div style="float: left" class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    好友
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @foreach($friend as $val)
                        <li><a href="javascript:del_friend({{$val->id}});">{{$val->friend}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div style="float: right;margin: 5px">
            <a href="javascript:void(0);" id="delSelect">删除选中</a>
            <button type="submit" onclick="out();">返回</button>
        </div>
        <form id="form" action="delSelect" method="post">
            <table border="1" style="width: 600px">
                <thead>
                <tr>
                    <th><input type="checkbox" id="firstCb"></th>
                    <th>item</th>
                    <th>status</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $val)
                    <tr>
                        <th><input type="checkbox" name="uid" value="{{$val->id}}"></th>
                        <td>{{$val->item}}</td>
                        <td>{{$val->status}}</td>
                        <td>
                            <a href="update_list?id={{$val->id}}">修改</a>
                            <a href="delSelect?uid={{$val->id}}">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>

    <div style="width: 650px; margin:auto; margin-top: 50px">
        <div style="float: left">
            <form action="todo_all" method="post">
                <div >
                    <label for="exampleInputName1">姓名</label>
                    <input type="text" name="name" id="exampleInputName1" value="{{Session::get('s_name')}}">
                </div>
                <div >
                    <label for="exampleInputEmail">邮箱</label>
                    <input type="text" name="email" id="exampleInputEmail" value="{{Session::get('s_email')}}">
                </div>
                <button type="submit">查询</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
        </div>

        <table border="1" style="width: 600px">
            <thead>
            <tr>
                <th>名称</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if($user)
                @foreach($user as $val)
                    <tr>
                        <td>{{$val->name}}</td>
                        <td>{{$val->email}}</td>
                        <td>
                            <a href="add_friend?friend={{$val->name}}">添加</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    </body>
    <script>
        function out() {
            location.href = "{{'loginSuccess'}}";
        };
    </script>
    </html>
