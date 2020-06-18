<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Test2</title>
    </head>
    </head>
    <body>
    <div style="width: 600px">
        <center><h3>添加List</h3></center>
        <form action="update_list_op?id={{$data->id}}" method="post">
            <div class="form-group">
                <label for="item" >item：</label>
                <input type="text" id="item" name="item" value="{{$data->item}}">
            </div>

            <div>
                <label for="status">Status：</label>
                <select name="status" id="status" class="form-control">
                    @if($data->status == '进行中')
                        <option value="进行中" selected>进行中</option>
                        <option value="已完成">已完成</option>
                    @endif
                    @if($data->status == '已完成')
                        <option value="进行中">进行中</option>
                        <option value="已完成" selected>已完成</option>
                    @endif
                </select>
            </div>

            <div>
                <input type="submit" value="提交" style="margin-left: 250px">
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
    </body>
    </html>

